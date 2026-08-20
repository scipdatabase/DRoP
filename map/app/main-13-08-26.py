from fastapi import FastAPI
from fastapi.responses import HTMLResponse
from fastapi.responses import JSONResponse

from app.map_service import build_map
from app.data_loader import load_data

app = FastAPI(
    title="DRR Geospatial Stress map"
)

@app.get("/", response_class=HTMLResponse)
async def map_view():
    map_obj = build_map()
    return map_obj.get_root().render()

@app.get("/api/research")
async def research_data():
    research_df, _ = load_data()
    return JSONResponse(
        research_df.fillna("").to_dict("records")
    )

@app.get("/api/study")
async def study_data():
    _, study_df = load_data()
    return JSONResponse(
        study_df.fillna("").to_dict("records")
    )

@app.get("/health")
async def health():
    return {
        "status": "ok"
    }