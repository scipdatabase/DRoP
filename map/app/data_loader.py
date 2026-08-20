from pathlib import Path
import pandas as pd

DATA_DIR = Path("data")

def load_data():

    research_df = pd.read_csv(
        DATA_DIR / "research_locations.csv"
    )

    study_df = pd.read_csv(
        DATA_DIR / "study_locations.csv"
    )

    research_numeric_cols = [
        "latitude",
        "longitude",
        "avg_annual_rainfall_mm",
        "estimated_drr_incidence_percent"
    ]

    study_numeric_cols = [
        "year",
        "latitude",
        "longitude",
        "avg_annual_rainfall_mm",
        "mean_temp_c",
        "drought_index",
        "soil_moisture_index",
        "estimated_drr_incidence_percent",
        "macrophomina_risk_score",
        "pulse_yield_t_ha"
    ]

    for col in research_numeric_cols:
        research_df[col] = pd.to_numeric(
            research_df[col],
            errors="coerce"
        )

    for col in study_numeric_cols:
        study_df[col] = pd.to_numeric(
            study_df[col],
            errors="coerce"
        )

    return research_df, study_df