import pandas as pd
import plotly.graph_objects as go
import numpy as np

# 1. Load the localized experimental datasets
# Adjust the file names/paths below as necessary
df_chickpea = pd.read_csv(r"PRJNA888832.xlsx-RNA-seqdataset_2_ICC4958.csv", skiprows=1)
df_parth_2dai = pd.read_csv(r"PRJNA888832.xlsx-RNA-seqdataset_3_Ph-1_2DAI.csv", skiprows=1)
df_parth_4dai = pd.read_csv(r"PRJNA888832.xlsx-RNA-seqdataset4_Ph-1_4DAI.csv", skiprows=1)

# 2. Standardize column selections and rename them to match your interface conditions
df_chickpea = df_chickpea[['ID', 'log2FoldChange']].rename(columns={'log2FoldChange': 'Chickpea (2 DAI)'})
df_parth_2dai = df_parth_2dai[['ID', 'log2FoldChange']].rename(columns={'log2FoldChange': 'Parthenium (2 DAI)'})
df_parth_4dai = df_parth_4dai[['ID', 'log2FoldChange']].rename(columns={'log2FoldChange': 'Parthenium (4 DAI)'})

# 3. Outer-merge the individual data frames to create a master differential matrix
master_df = pd.merge(df_chickpea, df_parth_2dai, on='ID', how='outer')
master_df = pd.merge(master_df, df_parth_4dai, on='ID', how='outer')

# Drop features lacking substantial variance or complete tracking across steps (Fill missing with 0 for visualization background)
master_df.fillna(0, inplace=True)

# 4. Filter top dynamically changing genes for scannability (e.g., top 50 variance)
# In real applications, filter by your UI trend choices ('all', 'up', 'down')
master_df['variance'] = master_df.iloc[:, 1:].var(axis=1)
top_genes = master_df.sort_values(by='variance', ascending=False).head(50)

# Extract plot variables
genes = top_genes['ID'].tolist()
conditions = ['Chickpea (2 DAI)', 'Parthenium (2 DAI)', 'Parthenium (4 DAI)']
z_matrix = top_genes[conditions].values.tolist()

# 5. Render Interactive Plotly Chart (Mirroring your UI config parameters)
fig = go.Figure(data=go.Heatmap(
    z=z_matrix,
    x=conditions,
    y=genes,
    colorscale='RdBu',
    reversescale=True,
    colorbar=dict(title='Log2FC'),
    hovertemplate='Gene: %{y}<br>Condition: %{x}<br>Log2FC: %{z}<extra></extra>'
))

fig.update_layout(
    title='Expression Profile Matrix: PRJNA888832',
    xaxis_title='Experimental Sources / Conditions',
    yaxis_title='Gene Identifiers (Top Variance)',
    margin=dict(l=150, r=50, b=50, t=80),
    height=800
)

# Display or save matrix asset
fig.show()
# fig.write_html("heatmap_output.html") # Uncomment to export code structure into PHP wrapper include target