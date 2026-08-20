<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM genomics_pathogen";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Genomics</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
        .table-bordered {
            border: 2px solid #192087 !important;
        }

        #literatureTable thead th {
            background-color: #2980b9;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_filter input {
            width: 250px;
            border: 2px solid #2980b9 !important;
            background: #f1f5ff;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 15px;
        }

        .genomics-card-text {
            text-align: justify;
            line-height: 1.6rem;
            font-size: 1.1rem;
        }

        /* Modal Overlays and Cards Setup */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .custom-modal-overlay.active {
            opacity: 1;
        }

        .custom-modal-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 90%;
            max-width: 750px;
            background: #fff;
            display: none;
            z-index: 1050;
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .custom-modal-card.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container-fluid pt-5 mb-5">

        <div class="row px-3">

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header bg-success bg-opacity-10 py-2">
                        <h2 class="display-6 text-center mb-0"><b>Plant genomics</b></h2>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="lead genomics-card-text">
                            The chickpea (<em>Cicer arietinum L.</em>) genome has been sequenced for cultivated types, small-seeded desi and large-seeded kabuli and is publicly accessible through several key genomic resources. The reference genome of the kabuli-type chickpea (genotype CDC Frontier; <a href="https://doi.org/10.1038/s41586-021-04066-1" target="_blank">Varshney et al., 2013</a>) is available via the ICRISAT Chickpea Genome Resource (<a href="https://cegresources.icrisat.org/cicerseq/" target="_blank">https://cegresources.icrisat.org/cicerseq/</a>), the National Center for Biotechnology Information (NCBI; <a href="https://www.ncbi.nlm.nih.gov/datasets/genome/GCF_000331145.2/" target="_blank">https://www.ncbi.nlm.nih.gov/datasets/genome/GCF_000331145.2/</a>), the Pulse Crop Database (PCD; <a href="https://www.pulsedb.org/genome_CDCFrontier" target="_blank">https://www.pulsedb.org/genome_CDCFrontier</a>), Phytozome (<a href="https://phytozome-next.jgi.doe.gov/info/Carietinum_v1_0" target="_blank">https://phytozome-next.jgi.doe.gov/info/Carietinum_v1_0</a>), and the Legume Information System (LIS; <a href="https://www.legumeinfo.org/genomics/cicer/" target="_blank">https://www.legumeinfo.org/genomics/cicer/</a>). The desi-type chickpea genome (genotype ICC4958) was initially sequenced by <a href="https://doi.org/10.1111/tpj.12173" target="_blank">Jain et al. (2013)</a>, with an improved draft assembly subsequently reported by <a href="https://doi.org/10.1038/srep12806" target="_blank">Parween et al. (2015)</a>. These datasets are available on the Chickpea Genome Analysis Project (<a href="https://nipgr.ac.in/CGAP3/home.php" target="_blank">https://nipgr.ac.in/CGAP3/home.php</a>). At the population scale, <a href="https://doi.org/10.1038/s41586-021-04066-1" target="_blank">Varshney et al. (2021)</a> developed a comprehensive chickpea pan-genome and genetic variation map based on whole-genome sequencing of 3,366 accessions, including desi, kabuli, and wild progenitor lines, and made it accessible through the ICRISAT Chickpea Genome Resource (<a href="https://cegresources.icrisat.org/cicerseq/" target="_blank">https://cegresources.icrisat.org/cicerseq/</a>).
                        </p>
                        <button type="button" id="openPopupBtn" class="btn btn-link text-success fw-bold p-0 mt-1 text-decoration-none">
                            Read More <i class="fas fa-arrow-right ms-1 small"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header bg-success bg-opacity-10 py-2">
                        <h2 class="display-6 text-center mb-0"><b>Pathogen genomics</b></h2>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                                Whole-genome sequencing datasets for Macrophomina species, including <em>M. phaseolina</em>, <em>Macrophomina sp. BRIP 63780</em>, <em>Macrophomina sp. 242773</em>, <em>M. pseudophaseolina</em>, <em>M. euphorbiicola</em>, and <em>M. tecta</em>, have been generated from diverse host species and geographic locations worldwide. Genomic resources for <em>M. phaseolina</em> are accessible through the NCBI taxonomy browser (<a href="https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=35725" target="_blank">https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=35725</a>), JGI MycoCosm (<a href="https://mycocosm.jgi.doe.gov/mycocosm/home/releases" target="_blank">https://mycocosm.jgi.doe.gov/mycocosm/home/releases</a>) and EnsemblFungi (<a href="https://fungi.ensembl.org/Macrophomina_phaseolina_ms6_gca_000302655/Info/Index" target="_blank">https://fungi.ensembl.org/Macrophomina_phaseolina_ms6_gca_000302655/Info/Index</a>).
                            </p>
                            <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                                <a href="https://doi.org/10.1186/s12864-019-6168-1" target="_blank">Burkhardt et al., 2019</a> reported genome sequences and assemblies for two reference isolates: <em>M. phaseolina</em> strain Mp11-12 from strawberry (BioProject: PRJNA428521) and strain Al-1 from alfalfa (BioProject: PRJNA432410). Subsequently, (<a href="https://doi.org/10.1093/molbev/msac109" target="_blank">Gluck-Thaler et al., 2022</a>) performed genome assemblies for twelve strains — mp007, mp021, mp040, mp042, mp050, mp053, mp070, mp102, mp117, mp124, mp194, and mp247 — isolated from soil samples collected from six soybean fields in Paraguay (2014–2015) and six in Ohio, USA (2013–2014), under BioProject PRJNA687837. Recently, (<a href="https://doi.org/10.1094/MPMI-03-25-0032-R" target="_blank">Pennerman et al., 2025</a>) generated a large-scale population genomics dataset comprising 463 Macrophomina isolates obtained from 23 countries and 91 plant hosts and soil, with original field-collection dates ranging from 1927 to 2021 (BioProject: PRJNA953043). Mirchandani and Kumar (unpublished) performed whole-genome sequencing of <em>M. phaseolina</em> isolates infecting chickpea across multiple agroclimatic regions of India, including Jaipur, Chikkabalapur, Dharwad, Andhra Pradesh, and Akola, and curated the data under BioProject PRJNA1198842 at the strain level. Although the taxonomic identity of the pathogen has historically been confused with <em>Rhizoctonia bataticola</em> (Taub.) Butler, due to morphological similarities and the rare occurrence of sporulation in planta, which often led to its misidentification.
                            </p>
                            <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                                Collectively, these datasets are systematically annotated, and each entry is linked to its assembly name, assembly accession, BioSample, and SRA run accession, allowing users to directly retrieve genome assemblies and raw sequencing reads for their own downstream analyses across the broad host range and global distribution of <em>Macrophomina</em> species.
                            </p>
                        </div>
                        <div class="bg-light p-3 rounded mt-3">
                            <p class="lead mb-0 text-center" style="font-size: 17px;">
                                <strong>Kingdom:</strong> Fungi | <strong>Phylum:</strong> Ascomycota | <strong>Family:</strong> Botryosphaeriaceae<br>
                                <strong>Genus:</strong> Macrophomina | <strong>Species:</strong> <em>M. phaseolina</em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-3 mt-2">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap g-3">
                        <h3 class="h4 mb-0 text-dark">
                            <i class="fa-solid fa-database me-2"></i><b>Genomics data</b>
                        </h3>

                        <a href="download_data/genomics_pathogen.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold transition-hover">
                            <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                        </a>
                    </div>

                    <div id="modalOverlay" class="custom-modal-overlay"></div>
                    <div id="popup" class="custom-modal-card shadow-lg rounded-4 border p-3">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="fw-bold text-success mb-0"><i class="fas fa-book-open me-2"></i>Plant Genomics</h5>
                            <span id="closeBtn" style="cursor: pointer; font-size: 1.5rem; color: #888;">&times;</span>
                        </div>

                        <div id="tableContainer" style="max-height: 65vh; overflow-y: auto; padding-right: 5px;">
                            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                                The chickpea (<em>Cicer arietinum L.</em>) genome has been sequenced for cultivated types, small-seeded desi and large-seeded kabuli and is publicly accessible through several key genomic resources. The reference genome of the kabuli-type chickpea (genotype CDC Frontier; <a href="https://doi.org/10.1038/s41586-021-04066-1" target="_blank">Varshney et al., 2013</a>) is available via the ICRISAT Chickpea Genome Resource (<a href="https://cegresources.icrisat.org/cicerseq/" target="_blank">https://cegresources.icrisat.org/cicerseq/</a>), the National Center for Biotechnology Information (NCBI; <a href="https://www.ncbi.nlm.nih.gov/datasets/genome/GCF_000331145.2/" target="_blank">https://www.ncbi.nlm.nih.gov/datasets/genome/GCF_000331145.2/</a>), the Pulse Crop Database (PCD; <a href="https://www.pulsedb.org/genome_CDCFrontier" target="_blank">https://www.pulsedb.org/genome_CDCFrontier</a>), Phytozome (<a href="https://phytozome-next.jgi.doe.gov/info/Carietinum_v1_0" target="_blank">https://phytozome-next.jgi.doe.gov/info/Carietinum_v1_0</a>), and the Legume Information System (LIS; <a href="https://www.legumeinfo.org/genomics/cicer/" target="_blank">https://www.legumeinfo.org/genomics/cicer/</a>). The desi-type chickpea genome (genotype ICC4958) was initially sequenced by <a href="https://doi.org/10.1111/tpj.12173" target="_blank">Jain et al. (2013)</a>, with an improved draft assembly subsequently reported by <a href="https://doi.org/10.1038/srep12806" target="_blank">Parween et al. (2015)</a>. These datasets are available on the Chickpea Genome Analysis Project (<a href="https://nipgr.ac.in/CGAP3/home.php" target="_blank">https://nipgr.ac.in/CGAP3/home.php</a>). At the population scale, <a href="https://doi.org/10.1038/s41586-021-04066-1" target="_blank">Varshney et al. (2021)</a> developed a comprehensive chickpea pan-genome and genetic variation map based on whole-genome sequencing of 3,366 accessions, including desi, kabuli, and wild progenitor lines, and made it accessible through the ICRISAT Chickpea Genome Resource (<a href="https://cegresources.icrisat.org/cicerseq/" target="_blank">https://cegresources.icrisat.org/cicerseq/</a>).
                            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                                Advances in plant genomics and high-throughput phenotyping have enabled the application of diverse genetic mapping approaches to dissect the genetic architecture of complex traits, such as dry root rot (DRR) resistance in chickpea (<a href="https://doi.org/10.3389/fgene.2022.945787" target="_blank">Agarwal et al. 2022</a>).
                            </p>
                            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                                To identify genomic regions associated with DRR, (<a href="https://doi.org/10.1007/s10681-021-02854-4" target="_blank">Karadi et al., 2021</a>) identified a minor QTL on CaLG08 for DRR resistance using 182 recombinant inbred lines developed from a cross between a susceptible line, BG 212, and a moderately resistant breeding line, ICCV 08305. (<a href="https://doi.org/10.1111/pbr.12448" target="_blank">Talekar et al., 2017</a>) used a mapping population of 129 F2:3 progeny derived from the cross L550 × PG06102, which showed monogenic inheritance of DRR resistance and identified two simple sequence repeat markers associated with DRR resistance in chickpea. GWAS were performed using a chickpea reference core germplasm collection consisting of 305 genotypes, including 254 landraces, 38 improved varieties, and 13 breeding lines. A total of 13 marker-trait associations (MTAs) were identified under DRR stress, while 14 stress-responsive candidate genes were identified under combined stress (Ranjan et al., unpublished).
                            </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" style="width: 100%; border-collapse: collapse; margin-top: 15px; font-family: sans-serif; font-size: 0.95rem;">
                                    <caption style="caption-side: top; font-weight: bold; margin-bottom: 10px; color: #333; text-align: left;">
                                        Table: Genetic regions, markers and candidate quantitative trait loci or genes associated with dry root rot resistance in chickpea
                                    </caption>
                                    <thead style="background-color: #f2f2f2; text-align: left;">
                                        <tr>
                                            <th style="border: 1px solid #ddd; padding: 10px;">QTL/Gene name</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">Chromosome no.</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">Position (cM or bp)</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">p-value/ LOD /R<sup>2</sup> score</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">Marker names</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">Mapping population</th>
                                            <th style="border: 1px solid #ddd; padding: 10px;">References</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">qDRR-8</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">CaLG8</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">67cM</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">3.34</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">Left marker - Ca8_3970986<br>Right marker - Ca8_3904895</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">BG 212 × ICCV 08305</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Karadi et al., 2021</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">ICCM0120b</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">CaLG5</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">8.64</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">ICCM0120b</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">L550 × PG06102</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Talekar et al., 2017</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">ICCM0299</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">CaLG5</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">4.58</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">ICCM0299</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">L550 × PG06102</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Talekar et al., 2017</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">DRR1 gene</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">CaLG5</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">7.75 cM (ICCM0120b) - 22.48 cM (ICCM0299)</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">L550 × PG06102</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Talekar et al., 2017</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">13 Marker-trait associations (MTAs)</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">Multiple chromosomes</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">305 genotypes</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Ranjan et al., unpublished</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-weight: 500;">Candidate genes (14 stress-responsive genes)</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">Multiple chromosomes</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">-</td>
                                            <td style="border: 1px solid #ddd; padding: 10px;">305 genotypes</td>
                                            <td style="border: 1px solid #ddd; padding: 10px; font-style: italic;">Ranjan et al., unpublished</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p style="font-size: 0.85rem; color: #666; margin-top: 8px; font-family: sans-serif;">
                                    <strong>Abbreviations:</strong> QTL: quantitative trait locus; DRR: dry root rot; cM: centimorgan; bp: base pair; LOD: logarithm of Odds; R<sup>2</sup>: coefficient of determination
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter genome data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-striped table-hover table-bordered table-sm align-middle w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Assembly name</th>
                                        <th>Assembly accession</th>
                                        <th>Pathogen name</th>
                                        <th>Strain name</th>
                                        <th>BioProject</th>
                                        <th>BioSample</th>
                                        <th>Host name</th>
                                        <th>Location</th>
                                        <th>SRA accession</th>
                                        <th>Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['Assembly_name'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/assembly/<?php echo urlencode($row['Assembly_accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['Assembly_name']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['Assembly_accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/assembly/<?php echo urlencode($row['Assembly_accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['Assembly_accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td><em><?php echo htmlspecialchars($row['Pathogen_name'] ?: 'N/A'); ?></em></td>
                                                <td><?php echo htmlspecialchars($row['Strain_name'] ?: 'N/A'); ?></td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['BioProject_accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/bioproject/<?php echo urlencode($row['BioProject_accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['BioProject_accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['BioSample_accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/biosample/<?php echo urlencode($row['BioSample_accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['BioSample_accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td><em><?php echo htmlspecialchars($row['Host_name'] ?: 'N/A'); ?></em></td>
                                                <td><?php echo htmlspecialchars($row['Location'] ?: 'N/A'); ?></td>

                                                <td class="text-center">
                                                    <?php if ($row['NCBI_SRA_accession']): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/sra/<?= urlencode($row['NCBI_SRA_accession']); ?>" target="_blank">
                                                            <?= htmlspecialchars($row['NCBI_SRA_accession']); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $links = [
                                                        'Pennerman et al., 2025' => 'https://doi.org/10.1094/MPMI-03-25-0032-R',
                                                        'Burkhardt et al., 2019' => 'https://doi.org/10.1186/s12864-019-6168-1',
                                                        'Gluck-Thaler et al., 2022' => 'https://doi.org/10.1093/molbev/msac109'

                                                    ];
                                                    $ref = trim($row['Reference'] ?? '');

                                                    if (isset($links[$ref])) {
                                                        echo '<a href="' . $links[$ref] . '" target="_blank">' . htmlspecialchars($ref) . '</a>';
                                                    } else {
                                                        echo htmlspecialchars($ref ?: 'N/A');
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='11' class='text-center py-5 text-muted'>No pathogen data found in the repository.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4 px-3">
            <div class="col-lg-12">
                <div class="ui-left-bordered-title-card bg-white p-4 shadow-sm border-start border-4 border-success">
                    <div class="ui-left-bordered-title mb-3">
                        <h5 class="fw-bold">How to cite:</h5>
                    </div>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.7;">
                        Pennerman K.K., Goldman P., Dilla-Ermita C. J. et al. Population Genomics of <em>Macrophomina spp.</em> Reveals Cryptic Host Specialization and Evidence for Meiotic Recombination.
                        <strong>Molecular Plant Microbe Interaction(2025)</strong> 38, 6.;
                        DOI: <a href="https://doi.org/10.1094/MPMI-03-25-0032-R" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1094/MPMI-03-25-0032-R</a>
                    </p>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.7;">
                        Burkhardt A.K., Childs K.L., Wang J., Ramon M.L., Martin F.N. Assembly, annotation, and comparison of <em>Macrophomina phaseolina</em> isolates from strawberry and other hosts.
                        <strong>BMC Genomics(2019)</strong> 4;20(1):802.;
                        DOI: <a href="https://doi.org/10.1186/s12864-019-6168-1" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1186/s12864-019-6168-1</a>
                    </p>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.7;">
                        Gluck-Thaler E., Ralston T., Konkel Z., Ocampos C.G., Ganeshan V.D., Dorrance A.E., Niblack T.L., Wood C.W., Slot J.C., Lopez-Nicora H.D., Vogan A.A, Giant Starship Elements Mobilize Accessory Genes in Fungal Genomes.
                        <strong>Molecular Biology and Evolution (2022)</strong> Volume 39; Issue 5: msac109.;
                        DOI: <a href="https://doi.org/10.1093/molbev/msac109" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1093/molbev/msac109</a>
                    </p>
                    <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('Pennerman K.K, Goldman P., Dilla-Ermita C. J. et al. Population Genomics of Macrophomina spp. Reveals Cryptic Host Specialization and Evidence for Meiotic Recombination.; DOI: https://doi.org/10.1093/molbev/msac109'); alert('Citation copied!');"></i>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#literatureTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                order: [
                    [0, "asc"]
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Bioprojects, genotypes, or locations..."
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialization of Scroll Progress Indicator
            const scrollProgress = document.getElementById('scroll-progress');
            const scrollableBody = document.querySelector('.scrollable-body');

            if (scrollableBody && scrollProgress) {
                scrollableBody.addEventListener('scroll', () => {
                    const totalScroll = scrollableBody.scrollHeight - scrollableBody.clientHeight;
                    const scrollPercentage = (scrollableBody.scrollTop / totalScroll) * 100;
                    scrollProgress.style.width = scrollPercentage + '%';
                });
            }

            // Modal Interactivity Handlers
            const openBtn = document.getElementById('openPopupBtn');
            const closeBtn = document.getElementById('closeBtn');
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('modalOverlay');

            const openBox = () => {
                if (popup && overlay) {
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                    setTimeout(() => {
                        popup.classList.add('active');
                        overlay.classList.add('active');
                    }, 10);
                }
            };

            const closeBox = () => {
                if (popup && overlay) {
                    popup.classList.remove('active');
                    overlay.classList.remove('active');
                    setTimeout(() => {
                        popup.style.display = 'none';
                        overlay.style.display = 'none';
                    }, 300);
                }
            };

            if (openBtn) openBtn.addEventListener('click', openBox);
            if (closeBtn) closeBtn.addEventListener('click', closeBox);
            if (overlay) overlay.addEventListener('click', closeBox);

            // Escape Key Trigger context
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && popup && popup.classList.contains('active')) {
                    closeBox();
                }
            });

            // Initialize Animations
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true
                });
            }
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>
