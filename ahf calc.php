<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Active Harmonic Filter Calculator</title>
  <style>
    /* CSS Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body Styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* Main Container */
    .ahf-main-wrapper {
      max-width: 600px;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Calculator Header */
    .ahf-header {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    /* Input Wrapper */
    .ahf-input-wrapper {
      border: 1px solid #d3d3d3;
      padding: 20px;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
      background-color: #f9f9f9;
    }

    .ahf-row-input {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin: 15px 0;
      align-items: center;
    }

    .ahf-form-label-input {
      width: 50%;
      font-size: 18px;
      color: #333;
    }

    .ahf-form-input {
      width: 150px;
      height: 40px;
      font-size: 18px;
      padding: 5px;
      border: 1px solid #b3b3b3;
      transition: background-color 0.3s, border 0.3s, box-shadow 0.3s; /* Animasi untuk input form */
    }

    .ahf-form-input:focus {
      background-color: #c3e9fa;
      outline: none;
      border: 1px solid #ff8000; /* Warna oranye untuk border saat difokuskan */
      box-shadow: 0 0 5px rgba(255, 128, 0, 0.5); /* Efek shadow oranye saat difokuskan */
    }

    .ahf-mt-10 {
      margin-top: 10px;
    }

    .ahf-mt-30 {
      margin-top: 30px;
    }

    /* Calculate Button */
    .ahf-btn-wrapper {
      display: flex;
      justify-content: space-between; /* Menambahkan ruang antara tombol Hitung dan Reset */
      margin-top: 20px;
    }

    .ahf-calculate-btn,
    .ahf-reset-btn {
      width: 48%; /* Membagi lebar setengah untuk masing-masing tombol */
      padding: 15px;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }

    .ahf-calculate-btn {
      background-color: #f56614; /* Warna oranye untuk tombol Hitung */
      color: #fff;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .ahf-calculate-btn:hover {
      background-color: #ff8000; /* Warna oranye yang lebih terang saat hover */
    }

    .ahf-calculate-btn:active {
      transform: scale(0.98);
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .ahf-reset-btn {
      background-color: #ccc; /* Warna abu-abu untuk tombol Reset */
      color: #333;
    }

    .ahf-reset-btn:hover {
      background-color: #ddd; /* Warna abu-abu yang lebih terang saat hover */
    }

    .ahf-reset-btn:active {
      transform: scale(0.98);
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>
<body>
  <div class="ahf-main-wrapper">
    <h2 class="ahf-header">Active Harmonic Filter Calculator</h2>
    <form id="ahf-form" class="ahf-input-wrapper">
      <h5>Masukkan data berikut untuk menghitung standar harmonik pada jaringan distribusi Anda</h5>
      <div class="ahf-row-input">
        <label for="ampere" class="ahf-form-label-input">Ampere</label>
        <input type="number" id="ampere" class="ahf-form-input">
        <span>A</span>
      </div>
      <div class="ahf-row-input">
        <label for="thd_saat_ini" class="ahf-form-label-input">Nilai THDI saat ini</label>
        <input type="number" id="thd_saat_ini" class="ahf-form-input">
        <span>%</span>
      </div>
      <div class="ahf-row-input">
        <label for="thd_diharapkan" class="ahf-form-label-input">Nilai THDI yang diharapkan</label>
        <input type="number" id="thd_diharapkan" class="ahf-form-input">
        <span>%</span>
      </div>
      <div class="ahf-row-input">
        <label for="output_ahf" class="ahf-form-label-input">Hasil Perhitungan AHF</label>
        <input type="number" id="output_ahf" class="ahf-form-input" disabled>
        <span>A</span>
      </div>
      <div class="ahf-btn-wrapper">
        <button type="button" id="calculate_btn" class="ahf-calculate-btn">Hitung</button>
        <button type="reset" class="ahf-reset-btn">Reset</button>
      </div>
    </form>
  </div>

  <script>
    const ampere = document.querySelector("#ampere");
    const thdSaatIni = document.querySelector("#thd_saat_ini");
    const thdDiharapkan = document.querySelector("#thd_diharapkan");
    const outputResult = document.querySelector("#output_ahf");
    const calculateBtn = document.querySelector("#calculate_btn");
    const resetBtn = document.querySelector("#ahf-form");

    calculateBtn.addEventListener("click", function () {
      const initial = ahdFormula(ampere.value, thdSaatIni.value);
      const final = ahdFormula(ampere.value, thdDiharapkan.value);
      const results = initial - final;
      outputResult.value = results.toFixed(5);
    });

    resetBtn.addEventListener("reset", function () {
      outputResult.value = "";
    });

    function ahdFormula(ampere, nilaiThd) {
      return Math.sqrt(
        Math.pow(ampere, 2) * Math.pow(nilaiThd / 100, 2) / (1 + Math.pow(nilaiThd / 100, 2))
      );
    }
  </script>
</body>
</html>
