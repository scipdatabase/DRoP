from fastapi import FastAPI
from fastapi.responses import HTMLResponse
from fastapi.responses import JSONResponse
from fastapi.responses import FileResponse

from app.map_service import build_map
from app.data_loader import load_data

app = FastAPI(
    title="DRR Geospatial Stress map"
)

@app.get("/favicon.ico", include_in_schema=False)
async def favicon():
    return FileResponse("/opt/lampp/htdocs/DROP/favicon.ico")

@app.get("/", response_class=HTMLResponse)
async def map_view():
    map_obj = build_map()
    html = map_obj.get_root().render()

    html = html.replace(
        "</head>",
        '<link rel="icon" type="image/x-icon" href="/map/favicon.ico"></head>'
    )

    return HTMLResponse(content=html)

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
