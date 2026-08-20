<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>DRR Images Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  
  <style>
    .ack-section {
      padding: 4rem 0;
      background: transparent;
      width: 100%;
    }

    .ack-header h2 {
      font-weight: 400;
      font-size: 2.5rem;
      text-align: center;
      position: relative;
      margin-bottom: 3rem;
    }

    .ack-header h2::after {
      content: '';
      width: 80px;
      height: 4px;
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      border-radius: 10px;
    }

    .header-section {
      border-bottom: none;
      box-shadow: none;
    }

    .btn-success:focus {
      box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }

    /* Stress Category Cards */
    .stress-card {
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      border: 2px solid transparent;
      border-radius: 24px;
      background: white;
      box-shadow: var(--card-shadow);
      text-align: center;
      padding: 40px 30px;
      height: 100%;
    }

    .stress-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15);
    }

    .stress-card.active {
      border-color: var(--primary-green);
      background: #ffffff;
      box-shadow: 0 0 0 5px rgba(25, 135, 84, 0.1);
    }

    .stress-icon {
      font-size: 3rem;
      margin-bottom: 20px;
      display: block;
    }

    .pill-container {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      padding: 20px;
      margin: 30px 0;
    }

    .sub-pill {
      padding: 12px 24px;
      background: white;
      border: 1.5px solid var(--primary-green);
      border-radius: 50px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      color: var(--primary-green);
    }

    .sub-pill:hover {
      background: var(--hover-green);
      border-color: var(--hover-green);
      transform: scale(1.05);
    }

    .sub-pill.active {
      background: var(--primary-green);
      border-color: var(--primary-green);
      box-shadow: 0 4px 12px rgba(25, 135, 84, 0.4);
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
      gap: 30px;
    }

    .image-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(0, 0, 0, 0.03);
      transition: 0.3s;
    }

    .image-card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
    }

    #paperblotContainer {
      width: 100%;
      display: flex !important;
      flex-wrap: wrap;
      justify-content: center;
      gap: 12px;
      margin-bottom: 20px;
    }

    #paperblotGallery {
      width: 100% !important;
      display: grid !important;
      grid-template-columns: repeat(2, minmax(620px, 1fr));
      gap: 25px;
    }

    .github-block,
    .location-table-block {
      background: #ffffff;
      border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .empty-state {
      padding: 60px;
      text-align: center;
      color: #777;
      font-style: italic;
    }

    @media (max-width: 768px) {
      #paperblotGallery {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <section class="ack-section">
    <div class="container-fluid my-2">
      <div class="ack-header bg-primary bg-opacity-10 py-2 mb-3 rounded-3">
        <h2 class="text-primary display-4 text-center mb-0">
          <i class="me-3"></i>DRR Image Dashboard
        </h2>
        <p class="lead opacity-95 text-muted mx-auto" style="max-width: 800px;">
          Visualizing Dry Root Rot (DRR) progression through multiple imaging techniques
        </p>
      </div>
    </div>

    <div class="container py-2">
      <div class="row g-2 justify-content-center">
        <div class="col-lg-5 col-md-6">
          <div class="stress-card text-center p-4 h-100 shadow-sm border-black rounded-4"
            id="card-Field"
            onclick="selectCategory('Field_images', 'card-Field')">
            <div class="stress-icon mb-3">🌳</div>
            <h4 class="fw-bold">Field images</h4>
            <p class="text-muted small">
              Phenotyping in natural soil environments via drones and handheld devices.
            </p>
          </div>
        </div>

        <div class="col-lg-5 col-md-6">
          <div class="stress-card text-center p-4 h-100 shadow-sm border-black rounded-4"
            id="card-Paper"
            onclick="selectCategory('Paperblot_images', 'card-Paper')">
            <div class="stress-icon mb-3">🔬</div>
            <h4 class="fw-bold">Laboratory images</h4>
            <p class="text-muted small">
              Controlled laboratory imaging using microscopes and scanners.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div id="subContainer" class="pill-container d-none animate__animated animate__fadeIn mt-4"></div>
    <div id="subSubContainer" class="pill-container d-none animate__animated animate__fadeIn mt-3"></div>

    <div id="imageDisplay" class="gallery-grid mt-4">
      <div class="empty-state w-100">
        <p>Select a category to display research images.</p>
      </div>
    </div>
  </section>

  <div class="container-fluid mt-4 mb-2">
    <div class="location-table-block p-4 rounded-4 shadow-sm bg-white">
      <h4 class="fw-bold text-center text-primary mb-3">Chickpea Image Collection Locations</h4>
      <p class="text-muted text-center mb-4">A complete overview of sampling locations, varieties, and agro-climatic zones.</p>

      <div class="table-responsive">
        <table id="locationTable" class="table table-striped table-hover table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th>S.No</th>
              <th>Location / Name</th>
              <th>State</th>
              <th>Latitude (°N)</th>
              <th>Longitude (°E)</th>
              <th>Chickpea Variety / Genotype</th>
              <th>Agro-climatic Zone</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>New Delhi (NIPGR)</td>
              <td>Delhi</td>
              <td>28.545</td>
              <td>77.193</td>
              <td>PUSA 372, BG 212, PUSA 362, PUSA 547, JG 62 (research), ICC 4958 (research)</td>
              <td>Trans-Gangetic Plains</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Meerut, Uttar Pradesh</td>
              <td>Uttar Pradesh</td>
              <td>28.973</td>
              <td>77.738</td>
              <td>PUSA 372, BG 212, PUSA 362, Avrodhi, Udai, JG 62</td>
              <td>Upper Gangetic Plains</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Dharwad, Karnataka (UAS Dharwad ref.)</td>
              <td>Karnataka</td>
              <td>15.459</td>
              <td>75.007</td>
              <td>JG 11, Annigeri-1, A-1, ICC 4958 (research), JG 62 (research)</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Jobner, Rajasthan</td>
              <td>Rajasthan</td>
              <td>26.972</td>
              <td>75.389</td>
              <td>PUSA 372, BG 212, GNG 1581, GNG 1958, RSG 888</td>
              <td>Semi-Arid Eastern Plain Zone</td>
            </tr>
            <tr>
              <td>5</td>
              <td>GKVK, Bengaluru</td>
              <td>Karnataka</td>
              <td>13.082</td>
              <td>77.579</td>
              <td>JG 11, Annigeri-1, A-1, ICC 4958, JG 62</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Udumalaipettai, Tamil Nadu</td>
              <td>Tamil Nadu</td>
              <td>10.587</td>
              <td>77.247</td>
              <td>JG 11, CO 4, CO 5, JAKI 9218</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Thondamuthur, Tamil Nadu</td>
              <td>Tamil Nadu</td>
              <td>10.989</td>
              <td>76.845</td>
              <td>JG 11, CO 4, CO 5, JAKI 9218</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Shillong/Umiam, Meghalaya</td>
              <td>Meghalaya</td>
              <td>25.666</td>
              <td>91.913</td>
              <td>PUSA 372, ICCV 10, PUSA 256, ICC 4958 (research)</td>
              <td>North Eastern Hill Region</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Sepahijala, Tripura</td>
              <td>Tripura</td>
              <td>23.776</td>
              <td>91.275</td>
              <td>PUSA 372, ICCV 10, PUSA 256</td>
              <td>North Eastern Hill Region</td>
            </tr>
            <tr>
              <td>10</td>
              <td>Kadapa, Andhra Pradesh</td>
              <td>Andhra Pradesh</td>
              <td>14.467</td>
              <td>78.824</td>
              <td>JG 11, NBeG 3, NBeG 47, ICC 4958 (research)</td>
              <td>Scarce Rainfall Zone</td>
            </tr>
            <tr>
              <td>11</td>
              <td>Imphal, Manipur</td>
              <td>Manipur</td>
              <td>24.817</td>
              <td>93.936</td>
              <td>PUSA 372, ICCV 10, PUSA 256</td>
              <td>North Eastern Hill Region</td>
            </tr>
            <tr>
              <td>12</td>
              <td>Medziphema, Nagaland</td>
              <td>Nagaland</td>
              <td>25.760</td>
              <td>93.861</td>
              <td>PUSA 372, ICCV 10, PUSA 256</td>
              <td>North Eastern Hill Region</td>
            </tr>
            <tr>
              <td>13</td>
              <td>NIPGR SPROUT facility, New Delhi</td>
              <td>Delhi</td>
              <td>28.545</td>
              <td>77.193</td>
              <td>Chickpea mini-core collection</td>
              <td>Trans-Gangetic Plains</td>
            </tr>
            <tr>
              <td>14</td>
              <td>Pollachi</td>
              <td>Tamil Nadu</td>
              <td>10.6580</td>
              <td>76.8360</td>
              <td>To be confirmed</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>15</td>
              <td>Udumalpet Agricultural Region</td>
              <td>Tamil Nadu</td>
              <td>10.5881</td>
              <td>77.2474</td>
              <td>To be confirmed</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>16</td>
              <td>Aliyar Coconut Research Station</td>
              <td>Tamil Nadu</td>
              <td>10.650-10.660</td>
              <td>76.950-76.970</td>
              <td>-</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>17</td>
              <td>Pollachi North / Kinathukadavu dryland belt</td>
              <td>Tamil Nadu</td>
              <td>~10.70</td>
              <td>~76.95</td>
              <td>To be verified</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>18</td>
              <td>Udumalpet-Madathukulam dryland belt</td>
              <td>Tamil Nadu</td>
              <td>~10.60</td>
              <td>~77.35</td>
              <td>To be verified</td>
              <td>Western Zone</td>
            </tr>
            <tr>
              <td>19</td>
              <td>National Pulses Research Centre, Vamban</td>
              <td>Tamil Nadu</td>
              <td>10.392-10.395</td>
              <td>78.945-78.950</td>
              <td>Multiple chickpea varieties; station-specific trials to be checked</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>20</td>
              <td>KVK Vamban</td>
              <td>Tamil Nadu</td>
              <td>10.39-10.40</td>
              <td>78.94-78.95</td>
              <td>To be confirmed</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>21</td>
              <td>Vamban village / Manjanviduthy area</td>
              <td>Tamil Nadu</td>
              <td>~10.39</td>
              <td>~78.95</td>
              <td>To be confirmed</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>22</td>
              <td>Agricultural College & Research Institute, Kudumiyanmalai</td>
              <td>Tamil Nadu</td>
              <td>10.417</td>
              <td>78.653</td>
              <td>To be confirmed</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>23</td>
              <td>Kudumiyanmalai village</td>
              <td>Tamil Nadu</td>
              <td>10.417</td>
              <td>78.653</td>
              <td>To be confirmed</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>24</td>
              <td>Visalur</td>
              <td>Tamil Nadu</td>
              <td>~10.43</td>
              <td>~78.67</td>
              <td>To be verified</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>25</td>
              <td>Pudukkottai-Kudumiyanmalai dryland belt</td>
              <td>Tamil Nadu</td>
              <td>~10.40</td>
              <td>~78.70</td>
              <td>To be verified</td>
              <td>Southern Zone</td>
            </tr>
            <tr>
              <td>26</td>
              <td>ICAR-KVK Bengaluru Rural, Hadonahalli</td>
              <td>Karnataka</td>
              <td>13.36924</td>
              <td>77.54496</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>27</td>
              <td>Hadonahalli</td>
              <td>Karnataka</td>
              <td>13.36924</td>
              <td>77.54496</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>28</td>
              <td>Doddaballapura</td>
              <td>Karnataka</td>
              <td>13.2928</td>
              <td>77.5378</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>29</td>
              <td>Chikkaballapura</td>
              <td>Karnataka</td>
              <td>13.4307</td>
              <td>77.7283</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>30</td>
              <td>ARS Chintamani, Chikkaballapur</td>
              <td>Karnataka</td>
              <td>13.4000</td>
              <td>77.0667</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>31</td>
              <td>ARS Nelamakanahalli, Chikkaballapur</td>
              <td>Karnataka</td>
              <td>13.0667</td>
              <td>77.7000</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>32</td>
              <td>ARS Balajigapade, Chikkaballapur</td>
              <td>Karnataka</td>
              <td>17.0667 (flagged erroneous)</td>
              <td>77.7000</td>
              <td>To be confirmed</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>33</td>
              <td>Chikkabelavangala</td>
              <td>Karnataka</td>
              <td>13.28735</td>
              <td>77.40856</td>
              <td>To be verified</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>34</td>
              <td>Nagenahalli / Hadonahalli vicinity</td>
              <td>Karnataka</td>
              <td>~13.38</td>
              <td>~77.55</td>
              <td>To be verified</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>35</td>
              <td>Doddaballapura-Gauribidanur agricultural belt</td>
              <td>Karnataka</td>
              <td>~13.50</td>
              <td>~77.55</td>
              <td>To be verified</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>36</td>
              <td>Gauribidanur</td>
              <td>Karnataka</td>
              <td>13.61145</td>
              <td>77.51678</td>
              <td>-</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>37</td>
              <td>Gauribidanur Taluk</td>
              <td>Karnataka</td>
              <td>13.4167-13.7833</td>
              <td>77.3667-77.7167</td>
              <td>-</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>38</td>
              <td>Gauribidanur-Doddaballapura belt</td>
              <td>Karnataka</td>
              <td>~13.45-13.60</td>
              <td>~77.45-77.55</td>
              <td>-</td>
              <td>Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>39</td>
              <td>KVK Virinjipuram, Vellore</td>
              <td>Tamil Nadu</td>
              <td>12.95895</td>
              <td>79.01522</td>
              <td>To be confirmed from KVK-specific chickpea records</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>40</td>
              <td>Virinjipuram / Virinchipuram</td>
              <td>Tamil Nadu</td>
              <td>12.95895</td>
              <td>79.01522</td>
              <td>To be confirmed</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>41</td>
              <td>Nilavur / Nilavoor, Yelagiri</td>
              <td>Tamil Nadu</td>
              <td>12.561-12.565</td>
              <td>78.635-78.640</td>
              <td>-</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>42</td>
              <td>Vellore-K.V. Kuppam agricultural belt</td>
              <td>Tamil Nadu</td>
              <td>~12.95</td>
              <td>~79.15</td>
              <td>To be confirmed</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>43</td>
              <td>Gudiyatham-Pernambut belt</td>
              <td>Tamil Nadu</td>
              <td>~12.90</td>
              <td>~78.87</td>
              <td>To be confirmed</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>44</td>
              <td>Katpadi-Kaniyambadi belt</td>
              <td>Tamil Nadu</td>
              <td>~12.95</td>
              <td>~79.20</td>
              <td>To be confirmed</td>
              <td>North Eastern Zone</td>
            </tr>
            <tr>
              <td>45</td>
              <td>Damoh</td>
              <td>Madhya Pradesh</td>
              <td>23.8381</td>
              <td>79.4419</td>
              <td>Super Annigeri (Bheemarayanagudi, UAS-Raichur ref.)</td>
              <td>Vindhya Plateau Zone</td>
            </tr>
            <tr>
              <td>46</td>
              <td>Jabalpur</td>
              <td>Madhya Pradesh</td>
              <td>23.1815</td>
              <td>79.9864</td>
              <td>Super Annigeri (ref.)</td>
              <td>Kymore Plateau & Satpura Hills Zone</td>
            </tr>
            <tr>
              <td>47</td>
              <td>Narsinghpur</td>
              <td>Madhya Pradesh</td>
              <td>22.9475</td>
              <td>79.1940</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Narmada Valley Zone</td>
            </tr>
            <tr>
              <td>48</td>
              <td>Hoshangabad / Narmadapuram</td>
              <td>Madhya Pradesh</td>
              <td>22.7441</td>
              <td>77.7360</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Narmada Valley Zone</td>
            </tr>
            <tr>
              <td>49</td>
              <td>Chhindwara</td>
              <td>Madhya Pradesh</td>
              <td>22.0574</td>
              <td>78.9382</td>
              <td>Super Annigeri (ref.)</td>
              <td>Satpura Plateau Zone</td>
            </tr>
            <tr>
              <td>50</td>
              <td>Seoni</td>
              <td>Madhya Pradesh</td>
              <td>22.0868</td>
              <td>79.5435</td>
              <td>Super Annigeri (ref.)</td>
              <td>Kymore Plateau & Satpura Hills Zone</td>
            </tr>
            <tr>
              <td>51</td>
              <td>Amravati</td>
              <td>Maharashtra</td>
              <td>20.9374</td>
              <td>77.7796</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>52</td>
              <td>Akola</td>
              <td>Maharashtra</td>
              <td>20.7002</td>
              <td>77.0082</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>53</td>
              <td>Buldhana</td>
              <td>Maharashtra</td>
              <td>20.5293</td>
              <td>76.1842</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>54</td>
              <td>Washim</td>
              <td>Maharashtra</td>
              <td>20.1110</td>
              <td>77.1330</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>55</td>
              <td>Yavatmal</td>
              <td>Maharashtra</td>
              <td>20.3899</td>
              <td>78.1307</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Vidarbha Zone</td>
            </tr>
            <tr>
              <td>56</td>
              <td>Jalna</td>
              <td>Maharashtra</td>
              <td>19.8347</td>
              <td>75.8816</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>57</td>
              <td>Beed</td>
              <td>Maharashtra</td>
              <td>18.9891</td>
              <td>75.7601</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>58</td>
              <td>Osmanabad / Dharashiv</td>
              <td>Maharashtra</td>
              <td>18.1860</td>
              <td>76.0419</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Maharashtra Plateau (Assured Rainfall) Zone</td>
            </tr>
            <tr>
              <td>59</td>
              <td>Medak</td>
              <td>Telangana</td>
              <td>18.0453</td>
              <td>78.2631</td>
              <td>Super Annigeri (ref.)</td>
              <td>Central Telangana Zone</td>
            </tr>
            <tr>
              <td>60</td>
              <td>Rangareddy</td>
              <td>Telangana</td>
              <td>17.2403</td>
              <td>78.4294</td>
              <td>Super Annigeri (ref.)</td>
              <td>Southern Telangana Zone</td>
            </tr>
            <tr>
              <td>61</td>
              <td>Guntur</td>
              <td>Andhra Pradesh</td>
              <td>16.3067</td>
              <td>80.4365</td>
              <td>Super Annigeri (ref.)</td>
              <td>Krishna-Godavari Zone</td>
            </tr>
            <tr>
              <td>62</td>
              <td>Mahbubnagar / Mahabubnagar</td>
              <td>Telangana</td>
              <td>16.7488</td>
              <td>77.9855</td>
              <td>Super Annigeri (ref.)</td>
              <td>Southern Telangana Zone</td>
            </tr>
            <tr>
              <td>63</td>
              <td>Prakasam (HQ: Ongole)</td>
              <td>Andhra Pradesh</td>
              <td>15.5057</td>
              <td>80.0499</td>
              <td>Super Annigeri (ref.)</td>
              <td>Krishna-Godavari Zone</td>
            </tr>
            <tr>
              <td>64</td>
              <td>Kurnool</td>
              <td>Andhra Pradesh</td>
              <td>15.8281</td>
              <td>78.0373</td>
              <td>Super Annigeri (ref.)</td>
              <td>Scarce Rainfall Zone</td>
            </tr>
            <tr>
              <td>65</td>
              <td>Anantapur / Ananthapuramu</td>
              <td>Andhra Pradesh</td>
              <td>14.6819</td>
              <td>77.6006</td>
              <td>Super Annigeri (ref.)</td>
              <td>Scarce Rainfall Zone</td>
            </tr>
            <tr>
              <td>66</td>
              <td>Gulbarga / Kalaburagi</td>
              <td>Karnataka</td>
              <td>17.3297</td>
              <td>76.8343</td>
              <td>Super Annigeri (ref.)</td>
              <td>North Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>67</td>
              <td>Raichur</td>
              <td>Karnataka</td>
              <td>16.2120</td>
              <td>77.3439</td>
              <td>Super Annigeri (UAS-Raichur, Bheemarayanagudi)</td>
              <td>North Eastern Dry Zone</td>
            </tr>
            <tr>
              <td>68</td>
              <td>UAS Dharwad - Main Station</td>
              <td>Karnataka</td>
              <td>15.4880</td>
              <td>74.9820</td>
              <td>-</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>69</td>
              <td>ICAR-IARI Regional Research Centre, Dharwad</td>
              <td>Karnataka</td>
              <td>15.4889</td>
              <td>74.9813</td>
              <td>-</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>70</td>
              <td>ICAR-KVK, Dharwad</td>
              <td>Karnataka</td>
              <td>15.489-15.490</td>
              <td>74.982-74.983</td>
              <td>Not specified</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>71</td>
              <td>Shirkol</td>
              <td>Karnataka</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>JG-11, BGD-103, JG-130, JAKI-9218, Annigeri-1; kabuli types also included</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>72</td>
              <td>Kumaragoppa</td>
              <td>Karnataka</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>JG-11, BGD-103, JG-130, JAKI-9218, Annigeri-1; kabuli types included</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>73</td>
              <td>Arekurahatti</td>
              <td>Karnataka</td>
              <td>15.51741</td>
              <td>75.31523</td>
              <td>Same trial set (JG-11 etc.)</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>74</td>
              <td>Amminabhavi</td>
              <td>Karnataka</td>
              <td>15.5399</td>
              <td>75.0582</td>
              <td>Same trial set (JG-11 etc.)</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>75</td>
              <td>Harobelavadi</td>
              <td>Karnataka</td>
              <td>15.62249</td>
              <td>75.07160</td>
              <td>Same trial set (JG-11 etc.)</td>
              <td>Northern Dry Zone</td>
            </tr>
            <tr>
              <td>76</td>
              <td>IGKV Raipur - Main Station</td>
              <td>Chhattisgarh</td>
              <td>21.2457</td>
              <td>81.6050</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>77</td>
              <td>ICAR-NIBSM, Baronda</td>
              <td>Chhattisgarh</td>
              <td>21.2365</td>
              <td>81.7905</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>78</td>
              <td>KVK Raipur, IGKV</td>
              <td>Chhattisgarh</td>
              <td>21.2457</td>
              <td>81.6050</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>79</td>
              <td>Palaud / Palond, Arang</td>
              <td>Chhattisgarh</td>
              <td>21.18333</td>
              <td>81.81667</td>
              <td>JAKI 9218</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>80</td>
              <td>KVK Bemetara, Jhal</td>
              <td>Chhattisgarh</td>
              <td>21.7156</td>
              <td>81.5342</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>81</td>
              <td>Kongaikala / Kongia Kalan</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>82</td>
              <td>Baharghat</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>83</td>
              <td>Sandi</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>84</td>
              <td>Mouhabhata / Mauhabhatha</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>85</td>
              <td>Banshapur</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>Not specified</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>86</td>
              <td>KVK Dhamtari, Sambalpur</td>
              <td>Chhattisgarh</td>
              <td>20.71 (approx.)</td>
              <td>81.55 (approx.)</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>87</td>
              <td>Kasahi</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>88</td>
              <td>Batang</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>89</td>
              <td>Santara</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>90</td>
              <td>Karga</td>
              <td>Chhattisgarh</td>
              <td>To be verified</td>
              <td>To be verified</td>
              <td>RVG 202</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>91</td>
              <td>Paneka</td>
              <td>Chhattisgarh</td>
              <td>21.90360</td>
              <td>81.36878</td>
              <td>JAKI 9218 (earlier dominant variety JG-74)</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>92</td>
              <td>KVK Kawardha</td>
              <td>Chhattisgarh</td>
              <td>~22.006</td>
              <td>~81.233</td>
              <td>-</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>93</td>
              <td>Maharatola / Mahratola</td>
              <td>Chhattisgarh</td>
              <td>~21.85</td>
              <td>~81.13</td>
              <td>JG-11</td>
              <td>Chhattisgarh Plains Zone</td>
            </tr>
            <tr>
              <td>94</td>
              <td>CSAUAT Kanpur - Main Campus (city reference, NOT farmer field)</td>
              <td>Uttar Pradesh</td>
              <td>26.4912</td>
              <td>80.3070</td>
              <td>-</td>
              <td>Upper/Central Gangetic Plains (Kanpur region)</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <script>
    const dataMap = {
      "Field_images": ["Drone", "RGB_handheld_camera", "Root", "Split_root", "Whole_plant"],
      "Paperblot_images": ["Camera", "Microscope", "Root_Scanner"]
    };

    const paperblotSubMap = {
      "Camera": ["Control", "DRR", "Other stress(Not Control,Not DRR)"],
      "Microscope": ["Control", "DRR", "Other stress(Not Control,Not DRR)"],
      "Root_Scanner": ["Control", "DRR", "Other stress(Not Control,Not DRR)"]
    };

    let selectedMainCategory = "";
    let selectedSubCategory = "";

    function selectCategory(cat, cardId) {
      selectedMainCategory = cat;
      selectedSubCategory = "";

      document.querySelectorAll('.stress-card').forEach(c => c.classList.remove('active'));
      document.getElementById(cardId).classList.add('active');

      const subContainer = document.getElementById('subContainer');
      subContainer.classList.remove('d-none');
      subContainer.innerHTML = "";

      document.getElementById('imageDisplay').innerHTML = `
        <div class="empty-state w-100">
          <p>Select a subcategory to display images.</p>
        </div>
      `;

      if (dataMap[cat]) {
        dataMap[cat].forEach((sub, index) => {
          const pill = document.createElement('div');
          pill.className = 'sub-pill animate__animated animate__fadeInUp';
          pill.style.animationDelay = (index * 0.05) + 's';
          pill.innerText = sub.replaceAll("_", " ");
          pill.onclick = () => selectSub(sub, pill);
          subContainer.appendChild(pill);
        });
      }
    }

    function selectSub(sub, pillElement) {
      selectedSubCategory = sub;

      document.querySelectorAll('.sub-pill').forEach(p => p.classList.remove('active'));
      pillElement.classList.add('active');

      if (selectedMainCategory === "Field_images") {
        showImages_Field(sub);
      }

      if (selectedMainCategory === "Paperblot_images") {
        showPaperblotPills(sub);
      }
    }

    function showPaperblotPills(deviceName) {
      const display = document.getElementById("imageDisplay");

      display.innerHTML = `
        <div class="w-100">
          <div id="paperblotContainer" class="pill-container animate__animated animate__fadeIn"></div>
          <div id="paperblotGallery" class="gallery-grid mt-3"></div>
        </div>
      `;

      const paperblotContainer = document.getElementById("paperblotContainer");
      const gallery = document.getElementById("paperblotGallery");

      paperblotContainer.innerHTML = "";
      gallery.innerHTML = `
        <div class="empty-state w-100">
          <p>Select DRR / Other_stress / Control to display images.</p>
        </div>
      `;

      if (paperblotSubMap[deviceName]) {
        paperblotSubMap[deviceName].forEach((type, index) => {
          const pill = document.createElement("div");
          pill.className = "sub-pill animate__animated animate__fadeInUp";
          pill.style.animationDelay = (index * 0.05) + "s";
          pill.innerText = type.replaceAll("_", " ");

          pill.onclick = () => {
            document.querySelectorAll("#paperblotContainer .sub-pill")
              .forEach(p => p.classList.remove("active"));

            pill.classList.add("active");
            showImages_Paperblot(deviceName, type);
          };

          paperblotContainer.appendChild(pill);
        });
      }
    }

    function showImages_Field(sub) {
      const display = document.getElementById('imageDisplay');

      // Set container layout to Bootstrap Row
      display.className = "row g-4 mt-2 justify-content-center";
      display.innerHTML = "";

      for (let i = 1; i <= 4; i++) {
//        const imagePath = `photos/Field_images/${sub}/${i}.png`;
        const imagePath = `Images/Field_images/${sub}/${i}.png`;

        display.innerHTML += `
        <div class="col-md-6">
          <div class="image-card animate__animated animate__zoomIn">
            <img src="${imagePath}"
                 onerror="this.src='https://via.placeholder.com/500x350?text=Missing:+${sub}/${i}.png'"
                 alt="Field Image">
            <div class="p-3 text-center">
              <h6 class="fw-bold text-success mb-0">${sub.replaceAll("_"," ")} - ${i}</h6>
            </div>
          </div>
        </div>
      `;
      }
    }

    function showImages_Paperblot(device, type) {
      const gallery = document.getElementById("paperblotGallery");
      gallery.innerHTML = "";

      for (let i = 1; i <= 4; i++) {
//        const imagePath = `photos/Paperblot_images/${device}/${type}/${i}.png`;
        const imagePath = `Images/Paperblot_images/${device}/${type}/${i}.png`;

        gallery.innerHTML += `
        <div class="image-card animate__animated animate__zoomIn">
            <img src="${imagePath}" 
                 onerror="this.src='https://via.placeholder.com/500x350?text=Missing:+${type}+${i}.png'" 
                 alt="Paperblot Image">
            <div class="p-3 text-center">
                <h6 class="fw-bold text-success mb-0">${device.replaceAll("_"," ")} | ${type.replaceAll("_"," ")} - ${i}</h6>
            </div>
        </div>
      `;
      }
    }

    $(document).ready(function() {
      $('#locationTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50, 100],
        "responsive": true,
        "language": {
          "search": "Search Location / Variety:"
        }
      });
    });
  </script>

  <div class="container mt-5 mb-4">
    <div class="github-block text-center p-4 rounded-4 shadow-sm">
      <h5 class="fw-bold mb-2">📌 DRR Image Dataset</h5>
      <p class="text-muted mb-3">
        You can access all DRR images and resources from our GitHub repository.
      </p>

      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/Images"
          target="_blank"
          class="btn btn-dark rounded-pill px-4">
          <i class="fab fa-github me-1"></i> View on GitHub
        </a>

        <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/Images.zip"
          class="btn btn-success rounded-pill px-4">
          <i class="fas fa-download me-1"></i> Download Images (ZIP)
        </a>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>
