# DRoP – Dry Root Rot Portal

**DRoP (Dry Root Rot Portal)** is a web-based scientific knowledge repository dedicated to **Dry Root Rot (DRR) of chickpea (*Cicer arietinum*)**, primarily caused by the necrotrophic fungal pathogen *Macrophomina phaseolina*.

DRoP brings together curated scientific information, experimental resources, datasets, computational tools, and AI-based applications related to DRR. The portal is designed to support researchers, plant pathologists, breeders, students, and other users working on Dry Root Rot disease.

## Key Features

DRoP provides an integrated platform for accessing and exploring diverse DRR-related resources.

### Disease Information

* Disease description and epidemiology
* Host–pathogen interactions
* Environmental and edaphic factors associated with DRR
* *Macrophomina phaseolina* information
* Pathogen strains and isolates
* NCBI-linked BioProject, BioSample, SRA, and genome records
* Disease management strategies
* Experimental protocols
* Disease screening approaches
* Sustainable management practices
* Antifungal protein analysis

### AI and Computational Tools

* AI-powered scientific chatbot
* ANN-based disease prediction
* CNN/vision-based disease analysis
* Image-based disease diagnosis
* Web-based analytical tools and applications

### Research Resources

* Scientific literature
* Datasets
* Experimental protocols
* Images and videos
* DRR screening facility
* Multi-omics resources

### Multi-omics Resources

* Genomics
* Transcriptomics
* Metagenomics
* Proteomics
* Metabolomics

### Germplasm Resources

* Resistant and susceptible genotypes
* Phenotypic information
* Molecular marker information
* Integrated omics resources

### Interactive Visualization and Tools

* Interactive disease hotspot maps
* Data visualization
* Search and filtering tools
* PDF protocol viewer
* Data submission facilities for researchers

---

## Technology Stack

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap
* jQuery
* Font Awesome

### Backend

* PHP
* Python
* FastAPI
* R / Plumber

### Databases

* **MySQL** – structured portal data
* **ChromaDB** – vector database for AI knowledge retrieval

### Artificial Intelligence and Machine Learning

* Python
* TensorFlow
* Keras
* PyTorch
* Convolutional Neural Networks (CNN)
* Vision Transformers (ViT)
* Artificial Neural Networks (ANN)
* ChromaDB-based retrieval
* Groq API for conversational AI

### Web and Deployment

* Apache
* XAMPP – local development
* Linux/CentOS – production deployment
* Python virtual environments
* Conda environments

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/scipdatabase/DRoP.git
cd DRoP
```

### 2. Configure the Web Server

For local development using XAMPP, place the project inside the Apache web root.

On Windows:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\DROP
```

Start the following services from the XAMPP Control Panel:

* Apache
* MySQL

The portal can then be accessed through:

**http://localhost/DROP/**

---

## Database Configuration

DRoP uses MySQL for storing structured portal data.

Import the required database schema and tables into MySQL using:

* phpMyAdmin, or
* the MySQL command-line interface.

Database credentials and other environment-specific configuration should **not** be committed to the Git repository.

---

## AI and FastAPI Services

Several DRoP functionalities are supported through Python/FastAPI services.

These may include:

* AI Chatbot API
* Image-based disease prediction API
* ANN prediction API
* Map/data services
* Other machine-learning services

A typical FastAPI service can be started using:

```bash
python app.py
```

or:

```bash
uvicorn app:app --host 0.0.0.0 --port 8000
```

The exact command depends on the implementation of each service.

### ChromaDB

DRoP uses **ChromaDB** as a vector database for AI-based knowledge retrieval.

The ChromaDB collection contains processed DRR-related knowledge that the conversational chatbot can retrieve to provide context-aware responses.

Production ChromaDB data may be excluded from GitHub because of its size and deployment-specific nature.

---

## Production Deployment

The production deployment may contain additional files and services that are intentionally excluded from the Git repository, including:

* Environment configuration files
* API keys and credentials
* MySQL database credentials
* ChromaDB collections
* Python environments
* Machine-learning model files
* Runtime logs
* Temporary files
* Server-specific configuration

On Linux-based servers, FastAPI and other backend services may be configured as **systemd services** for automatic startup and continuous operation.

---

## Data and Scientific Resources

DRoP integrates information from multiple scientific resources and datasets, including:

* Genomic datasets
* Transcriptomic datasets
* Metagenomic datasets
* Proteomic datasets
* Metabolomic datasets
* Phenotypic datasets
* Pathogen strain information
* Chickpea germplasm resources
* Scientific publications
* Experimental protocols
* Disease images and videos

Where applicable, records are linked to publicly available repositories, including:

* NCBI BioProject
* NCBI BioSample
* NCBI SRA
* Genome assembly records

---

## AI Output Disclaimer

AI-generated responses and predictions provided through DRoP are intended to support research, learning, and preliminary decision-making.

AI outputs may contain errors or may not fully represent field-specific conditions. Users should verify AI-generated information and disease predictions against experimental or field observations before using them for research conclusions or field-level disease management decisions.

---

## Intended Users

DRoP is intended to support:

* Plant pathologists
* Researchers
* Bioinformaticians
* Crop breeders
* Microbiologists
* Agricultural scientists
* Students and educators
* Disease management researchers

---

## Research and Agricultural Applications

DRoP can support several aspects of DRR research, including:

* Disease identification and diagnosis
* Disease surveillance
* Epidemiological studies
* Host–pathogen interaction studies
* Resistance screening
* Molecular breeding
* Multi-omics analysis
* Pathogen biology
* Disease prediction
* Development of management strategies
* Research data discovery and integration

---

## Portal

**DRoP – Dry Root Rot Portal**

https://drr.nipgr.ac.in/DROP/

---

## Maintainer

**DRoP Team**
National Institute of Plant Genome Research (NIPGR)
New Delhi, India

---

## Citation

If you use DRoP or its datasets in your research, please cite the associated DRoP publication:

> **DRoP – Dry Root Rot Portal**

The publication citation will be added here once the associated manuscript/publication details are finalized.

---

## Contributing

Researchers and developers interested in contributing to DRoP are welcome to contribute scientific resources, datasets, computational tools, documentation, and software improvements.

Please contact the DRoP research team for information regarding scientific resources, datasets, or collaboration.

---

## Contact

For questions, contributions, or scientific resources related to Dry Root Rot, please contact the **DRoP research team at NIPGR**.
