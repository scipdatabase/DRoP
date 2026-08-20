from fastapi import FastAPI, HTTPException, Query
from fastapi.responses import HTMLResponse
from pathlib import Path
from urllib.parse import unquote
import fitz
import html
import re

app = FastAPI(
    title="DROP Protocol PDF Viewer",
    version="1.0"
)

# ---------------------------------------------------------
# CONFIGURATION
# ---------------------------------------------------------

PDF_DIRECTORY = Path(
    "/opt/lampp/htdocs/DROP/documents/Protocols"
).resolve()


# ---------------------------------------------------------
# SECURITY
# ---------------------------------------------------------

def get_safe_pdf_path(filename: str) -> Path:
    """
    Make sure the requested file stays inside PDF_DIRECTORY.
    Prevents ../ path traversal.
    """

    filename = unquote(filename)

    # Never allow directories
    if "/" in filename or "\\" in filename:
        raise HTTPException(
            status_code=400,
            detail="Invalid PDF filename."
        )

    # Only allow PDF files
    if not filename.lower().endswith(".pdf"):
        raise HTTPException(
            status_code=400,
            detail="Only PDF files are allowed."
        )

    pdf_path = (PDF_DIRECTORY / filename).resolve()

    # Security check
    try:
        pdf_path.relative_to(PDF_DIRECTORY)
    except ValueError:
        raise HTTPException(
            status_code=403,
            detail="Access denied."
        )

    if not pdf_path.exists():
        raise HTTPException(
            status_code=404,
            detail="PDF file not found."
        )

    if not pdf_path.is_file():
        raise HTTPException(
            status_code=404,
            detail="Invalid PDF file."
        )

    return pdf_path


# ---------------------------------------------------------
# TITLE CLEANING
# ---------------------------------------------------------

def clean_title(filename: str) -> str:
    """
    Convert a filename into a readable title.
    """

    title = Path(filename).stem

    # Replace underscores with spaces
    title = title.replace("_", " ")

    # Remove repeated spaces
    title = re.sub(r"\s+", " ", title)

    return title.strip()


# ---------------------------------------------------------
# HTML PAGE
# ---------------------------------------------------------

def create_html_document(
    title: str,
    pages_html: list,
    page_count: int
) -> str:

    safe_title = html.escape(title)

    content = "\n".join(pages_html)

    return f"""<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>{safe_title}</title>

<style>

* {{
    box-sizing: border-box;
}}

body {{
    margin: 0;
    padding: 0;

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background: #f1f5f9;

    color: #1e293b;
}}


/* --------------------------------------------------
   HEADER
-------------------------------------------------- */

.protocol-header {{

    background: #ffffff;

    border-bottom: 1px solid #e2e8f0;

    padding: 25px 30px;

    position: sticky;

    top: 0;

    z-index: 1000;

    box-shadow:
        0 2px 10px rgba(0,0,0,0.05);
}}

.protocol-header-inner {{

    max-width: 1200px;

    margin: auto;

}}

.protocol-title {{

    margin: 0;

    font-size: 28px;

    line-height: 1.4;

    color: #0f172a;

}}

.protocol-info {{

    margin-top: 8px;

    color: #64748b;

    font-size: 14px;

}}


/* --------------------------------------------------
   PAGE CONTAINER
-------------------------------------------------- */

.protocol-container {{

    width: 100%;

    max-width: 1200px;

    margin: 30px auto;

    padding: 0 20px;

}}


/* --------------------------------------------------
   PDF PAGE
-------------------------------------------------- */

.pdf-page {{

    background: white;

    margin: 0 auto 30px auto;

    padding: 30px;

    border-radius: 8px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.08);

    overflow-x: auto;

}}

.pdf-page-number {{

    text-align: center;

    font-size: 13px;

    color: #64748b;

    padding-bottom: 15px;

    border-bottom: 1px solid #e2e8f0;

    margin-bottom: 20px;

}}


/* --------------------------------------------------
   EXTRACTED PDF HTML
-------------------------------------------------- */

.pdf-content {{

    overflow-x: auto;

}}

.pdf-content img {{

    max-width: 100%;

    height: auto;

}}

.pdf-content table {{

    max-width: 100%;

    overflow-x: auto;

}}

.pdf-content p {{

    line-height: 1.7;

}}


/* --------------------------------------------------
   BACK BUTTON
-------------------------------------------------- */

.back-button {{

    display: inline-block;

    margin-bottom: 20px;

    padding: 10px 18px;

    background: #0d9488;

    color: white;

    text-decoration: none;

    border-radius: 8px;

    font-size: 14px;

}}

.back-button:hover {{

    background: #0f766e;

}}


/* --------------------------------------------------
   MOBILE
-------------------------------------------------- */

@media (max-width: 768px) {{

    .protocol-header {{

        padding: 18px;

    }}

    .protocol-title {{

        font-size: 21px;

    }}

    .protocol-container {{

        padding: 0 10px;

        margin-top: 15px;

    }}

    .pdf-page {{

        padding: 15px;

        border-radius: 5px;

    }}

}}

</style>

</head>


<body>


<header class="protocol-header">

    <div class="protocol-header-inner">

        <h1 class="protocol-title">
            {safe_title}
        </h1>

        <div class="protocol-info">

            {page_count} page
            {"s" if page_count != 1 else ""}

        </div>

    </div>

</header>


<div class="protocol-container">

    <a
        href="/DROP/protocol.php"
        class="back-button"
    >
        ← Back to Protocols
    </a>

    {content}

</div>


</body>

</html>
"""


# ---------------------------------------------------------
# MAIN PDF → HTML ENDPOINT
# ---------------------------------------------------------

@app.get(
    "/protocol-view",
    response_class=HTMLResponse
)
def protocol_view(
    file: str = Query(...)
):

    pdf_path = get_safe_pdf_path(file)

    try:

        document = fitz.open(pdf_path)

    except Exception as e:

        raise HTTPException(
            status_code=500,
            detail=f"Unable to open PDF: {str(e)}"
        )


    pages_html = []

    page_count = len(document)

    title = clean_title(pdf_path.name)


    try:

        for page_number, page in enumerate(
            document,
            start=1
        ):

            # PyMuPDF converts the PDF page into HTML
            extracted_html = page.get_text(
                "html"
            )

            page_html = f"""

            <section class="pdf-page">

                <div class="pdf-page-number">

                    Page {page_number}
                    of
                    {page_count}

                </div>

                <div class="pdf-content">

                    {extracted_html}

                </div>

            </section>

            """

            pages_html.append(page_html)


    finally:

        document.close()


    final_html = create_html_document(
        title=title,
        pages_html=pages_html,
        page_count=page_count
    )


    return HTMLResponse(
        content=final_html,
        status_code=200
    )


# ---------------------------------------------------------
# TEST ENDPOINT
# ---------------------------------------------------------

@app.get("/")
def root():

    return {
        "status": "running",
        "service": "DROP Protocol PDF Viewer",
        "pdf_directory": str(PDF_DIRECTORY)
    }
