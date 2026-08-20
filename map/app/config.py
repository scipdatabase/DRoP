from pathlib import Path

# Project root
BASE_DIR = Path(__file__).resolve().parent.parent

# Data directory
DATA_DIR = BASE_DIR / "data"

# CSV files
RESEARCH_CSV = DATA_DIR / "research_locations.csv"
STUDY_CSV = DATA_DIR / "study_locations.csv"

# Map settings
MAP_CENTER = [23.5121, 80.3288]
MAP_ZOOM = 5

# Google Terrain
GOOGLE_TERRAIN_URL = (
    "https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}"
)

GOOGLE_SUBDOMAINS = [
    "mt0",
    "mt1",
    "mt2",
    "mt3"
]