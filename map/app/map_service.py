from folium.plugins import GroupedLayerControl
from branca.element import Element
import folium
import pandas as pd

from app.data_loader import load_data

def build_map():

    research_df, study_df = load_data()

    # =========================================================
    # CREATE MAP
    # =========================================================

    india_map = folium.Map(
        location=[23.5121, 80.3288],
        zoom_start=5,
        tiles=None
    )

    # =========================================================
    # GOOGLE TERRAIN LAYER
    # =========================================================

    folium.TileLayer(
        tiles="https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
        attr="Google Terrain",
        name="Google Terrain",
        max_zoom=15,
        min_zoom=4,
        subdomains=["mt0", "mt1", "mt2", "mt3"]
    ).add_to(india_map)

    # =========================================================
    # FEATURE GROUPS
    # =========================================================

    research_group = folium.FeatureGroup(
        name="🌱 Research Institutions",
        show=True
    )

    disease_group = folium.FeatureGroup(
        name="🦠 Environmental influence on DRR",
        show=False
    )

    # =========================================================
    # CLEAN NUMERIC COLUMNS
    # =========================================================

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

    # =========================================================
    # RESEARCH LOCATION MARKERS
    # =========================================================

    for _, row in research_df.iterrows():

        lat = row["latitude"]
        lon = row["longitude"]

        popup_html = f"""
        <div style="font-family:Arial;width:280px;">

            <h3><b>{row['research_location']}</b></h3>

            <h4><b>Institution:</b> {row['institution']}<br>
            <b>Province:</b> {row['province']}<br>
            <b>Country:</b> {row['country']}</h4>
            <hr>

            <b>Average Rainfall:</b>
            {row['avg_annual_rainfall_mm']} mm<br>

            <b>Estimated DRR Incidence:</b>
            {row['estimated_drr_incidence_percent']}%<br>

            <b>Risk Class:</b>
            {row['risk_class']}<br>

            <b>Agro Climatic Zone:</b>
            {row['agro_climatic_zone']}<br>

        </div>
        """

        icon_html = """
        <div style="position:relative;width:35px;height:55px;">

            <div style="
                position:absolute;
                width:35px;
                height:35px;
                background:#2ecc71;
                border:1px solid white;
                border-radius:50% 50% 50% 0;
                transform:rotate(-45deg);
                top:0;
                left:0;
                box-shadow:0 0 4px rgba(0,0,0,0.6);
            "></div>

            <div style="
                position:absolute;
                top:4px;
                left:5px;
                color:white;
                font-size:14px;
                transform:rotate(45deg);
            ">
                <i class="fa fa-seedling"></i>
            </div>

        </div>
        """

        folium.Marker(
            location=[lat, lon],

            popup=folium.Popup(
                popup_html,
                max_width=320
            ),

            tooltip=row["research_location"],

            icon=folium.DivIcon(
                html=icon_html,
                icon_size=(35, 55),
                icon_anchor=(17, 55)
            )

        ).add_to(research_group)

    # =========================================================
    # CREATE SITE-WISE DISEASE TABLES
    # =========================================================

    site_year_tables = {}

    for site_id, group in study_df.groupby("site_id"):

        group = group.sort_values("year")

        disease_table = """
        <table style="
            width:100%;
            border-collapse:collapse;
            font-size:12px;
            text-align:center;
        ">

        <tr style="background:#F4D03F;font-weight:bold;">
            <th style="border:1px solid #ccc;padding:4px;">Year</th>
            <th style="border:1px solid #ccc;padding:4px;">DRR %</th>
            <th style="border:1px solid #ccc;padding:4px;">Risk Score</th>
            <th style="border:1px solid #ccc;padding:4px;">Risk Class</th>
        </tr>
        """

        for _, r in group.iterrows():
            disease_table += f"""
            <tr>
                <td style="border:1px solid #ccc;padding:4px;">
                    {int(r['year'])}
                </td>
                <td style="border:1px solid #ccc;padding:4px;">
                    {r['estimated_drr_incidence_percent']}
                </td>
                <td style="border:1px solid #ccc;padding:4px;">
                    {r['macrophomina_risk_score']}
                </td>
                <td style="border:1px solid #ccc;padding:4px;">
                    {r['risk_class']}
                </td>
            </tr>
            """
        disease_table += "</table>"
        site_year_tables[site_id] = disease_table

    # =========================================================
    # STUDY LOCATION MARKERS
    # =========================================================

    #added_rainfall_locations = set()
    added_disease_sites = set()

    for _, row in study_df.iterrows():

        lat = row["latitude"]
        lon = row["longitude"]

        location_name = row["research_location"]
        site_id = row["site_id"]

        # =====================================================
        # DISEASE POPUP
        # =====================================================

        disease_popup_html = f"""
        <div style="font-family:Arial;width:450px;">

            <h3><b>{location_name}</b></h3>
            <h4><b>Institution:</b> {row['institution']}<br>
            <b>State:</b> {row['state']}
            <hr>
            Climate Information</h4>
            <b>Annual Rainfall:</b>
            {row['avg_annual_rainfall_mm']} mm<br>
            <b>Mean Temperature:</b>
            {row['mean_temp_c']} °C<br>
            <b>Drought Index:</b>
            {row['drought_index']}<br>
            <b>Soil Moisture Index:</b>
            {row['soil_moisture_index']}<br>
            <b>Soil Type:</b>
            {row['soil_type']}<br>
            <b>Agro Climatic Zone:</b>
            {row['agro_climatic_zone']}<br>
            <hr>
            <h4>Year-wise Disease Information</h4>
            {site_year_tables[site_id]}

        </div>
        """
        # =====================================================
        # DISEASE MARKER
        # =====================================================

        if site_id not in added_disease_sites:

            disease_icon = """
            <div style="position:relative;width:35px;height:55px;">

                <div style="
                    position:absolute;
                    width:35px;
                    height:35px;
                    background:#B35517;
                    border:1px solid white;
                    border-radius:50% 50% 50% 0;
                    transform:rotate(-45deg);
                    top:0;
                    left:0;
                    box-shadow:0 0 4px rgba(0,0,0,0.6);
                "></div>

                <div style="
                    position:absolute;
                    top:4px;
                    left:5px;
                    color:white;
                    font-size:14px;
                    transform:rotate(45deg);
                ">
                    <i class="fa fa-bacteria"></i>
                </div>

            </div>
            """

            folium.Marker(
                location=[lat, lon],

                popup=folium.Popup(
                    disease_popup_html,
                    max_width=500
                ),

                tooltip=f"{location_name}",

                icon=folium.DivIcon(
                    html=disease_icon,
                    icon_size=(35, 55),
                    icon_anchor=(17, 55)
                )

            ).add_to(disease_group)

            added_disease_sites.add(site_id)

    # =========================================================
    # ADD GROUPS TO MAP
    # =========================================================

    research_group.add_to(india_map)
    disease_group.add_to(india_map)

    # =========================================================
    # GROUPED LAYER CONTROL
    # =========================================================

    GroupedLayerControl(
        groups={
            "Disease occurrence map": [
                research_group,
                disease_group
            ]
        },

        exclusive_groups=["Disease occurrence map"],
        collapsed=False

    ).add_to(india_map)

    # =========================================================
    # CUSTOM CSS
    # =========================================================

    style = """
    <style>

    .leaflet-control-layers {
        background-color: #D6EAF8 !important;
        border-radius: 8px;
        padding: 10px;
        box-shadow:
            0 0 12px rgba(0,0,0,0.4);
    }

    .leaflet-control-layers-expanded {
        background-color: #D6EAF8 !important;
    }

    .leaflet-control-layers label {
        color: #2c3e50;
        font-weight: 500;
    }

    .leaflet-popup-content-wrapper {
        background-color: #EAF6FF !important;
        color: #2c3e50;
        border-radius: 8px;
    }

    .leaflet-popup-tip {
        background-color: #EAF6FF !important;
    }

    .leaflet-tooltip {
        background-color: #2C3E50 !important;
        color: white !important;
        border-radius: 6px;
        padding: 6px 10px;
        border: none;
        box-shadow:
            0 2px 8px rgba(0,0,0,0.3);
    }

    table {
        background:white;
    }

    th {
        background:#F4D03F;
    }

    td, th {
        border:1px solid #ccc;
        padding:4px;
    }

    hr {
    border: none;
    height: 3px;
    background-color: #3498db; /* Blue line */
    }

    </style>
    """

    india_map.get_root().html.add_child(
        Element(style)
    )
   
    return india_map