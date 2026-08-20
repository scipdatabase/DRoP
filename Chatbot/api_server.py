"""
DRR Portal Chatbot — API Server
================================
Loads the pre-built ChromaDB vector store (built once in the notebook,
no PDF files needed here) and exposes a single HTTP endpoint, /ask,
that the PHP portal calls to get chatbot answers.

Run this once and leave it running (e.g. as a systemd service or with
pm2/supervisor) alongside your PHP/Apache server. It listens on
localhost:8001 by default — only the PHP server needs to reach it,
not the public internet.

Start with:
    uvicorn api_server:app --host 127.0.0.1 --port 8002

Folder layout expected (adjust CHROMA_DB_PATH below if different):
    DRR_root_rot_chatbox/
      chroma_db/          <- the persistent vector store built by the notebook
      api_server.py        <- this file
      .env                  <- contains GROQ_API_KEY=...
"""

import os
from contextlib import asynccontextmanager

from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from dotenv import load_dotenv

load_dotenv()

# ── Configuration ──────────────────────────────────────────────────────────
CHROMA_DB_PATH = os.getenv("CHROMA_DB_PATH", "/opt/lampp/htdocs/DROP/Chatbot/chroma_db")
COLLECTION_NAME = "drop_knowledge_base"
GROQ_MODEL = "openai/gpt-oss-120b"
GROQ_API_KEY = os.getenv("GROQ_API_KEY")

SYSTEM_PROMPT = """You are an expert scientific assistant specializing in Dry Root Rot (DRR)
of chickpea, caused by Rhizoctonia bataticola (Macrophomina phaseolina).
You have access to information from the DROP (Dry Root Rot Portal) research database,
as well as a library of peer-reviewed scientific literature (PDFs) on the disease.
Answer scientifically and clearly. Base answers only on the provided context.
When useful, mention which source (web page or paper) the information came from."""

# ── Globals populated at startup ──────────────────────────────────────────
state = {}


@asynccontextmanager
async def lifespan(app: FastAPI):
    # Startup: load embedder + vector DB once, reused across all requests
    import chromadb
    from sentence_transformers import SentenceTransformer

    if not GROQ_API_KEY:
        raise RuntimeError(
            "GROQ_API_KEY not set. Create a .env file next to this script with:\n"
            "GROQ_API_KEY=your_key_here"
        )

    if not os.path.isdir(CHROMA_DB_PATH):
        raise RuntimeError(
            f"Vector DB not found at {CHROMA_DB_PATH}. "
            "Build it first by running the notebook's main pipeline cell, "
            "then copy the resulting chroma_db/ folder next to this script."
        )

    print(f"Loading embedder...")
    state["embedder"] = SentenceTransformer("sentence-transformers/all-MiniLM-L6-v2")

    print(f"Loading vector DB from {CHROMA_DB_PATH}...")
    client_db = chromadb.PersistentClient(path=CHROMA_DB_PATH)
    state["collection"] = client_db.get_collection(COLLECTION_NAME)
    print(f"Loaded {state['collection'].count()} chunks. Ready.")

    yield
    state.clear()


app = FastAPI(title="DRR Portal Chatbot API", lifespan=lifespan)

# Allow the PHP portal's domain to call this API from browser JS if needed.
# Restrict to your actual portal origin in production.
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # TODO: replace with your portal's actual origin, e.g. "http://172.16.31.87"
    allow_methods=["POST", "GET"],
    allow_headers=["*"],
)


class AskRequest(BaseModel):
    question: str
    top_k: int = 5


class AskResponse(BaseModel):
    question: str
    answer: str
    sources: list[str]


@app.get("/health")
def health():
    return {"status": "ok", "chunks_loaded": state["collection"].count()}


@app.post("/ask", response_model=AskResponse)
def ask(req: AskRequest):
    if not req.question.strip():
        raise HTTPException(status_code=400, detail="question must not be empty")

    from groq import Groq

    embedder = state["embedder"]
    col = state["collection"]

    q_emb = embedder.encode([req.question])[0].tolist()
    results = col.query(query_embeddings=[q_emb], n_results=req.top_k, include=["documents", "metadatas"])
    retrieved_docs = results["documents"][0]
    retrieved_meta = results["metadatas"][0]

    def label(meta):
        return f"PDF: {meta['source']}" if meta.get("source_type") == "pdf" else f"Web: {meta['source'].split('/')[-1]}"

    context = "\n\n---\n\n".join(
        f"[Source: {label(retrieved_meta[i])}]\n{doc}" for i, doc in enumerate(retrieved_docs)
    )

    groq_client = Groq(api_key=GROQ_API_KEY)
    response = groq_client.chat.completions.create(
        model=GROQ_MODEL,
        max_tokens=512,
        messages=[
            {"role": "system", "content": SYSTEM_PROMPT},
            {"role": "user", "content": f"Context:\n{context}\n\nQuestion: {req.question}"},
        ],
    )
    answer = response.choices[0].message.content
    sources_used = sorted({label(m) for m in retrieved_meta})

    return AskResponse(question=req.question, answer=answer, sources=sources_used)
