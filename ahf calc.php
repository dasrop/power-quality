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
    .main_wrapper {
      max-width: 600px;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Calculator Header */
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    /* Input Wrapper */
    .input_wrapper {
      border: 1px solid #d3d3d3;
      padding: 20px;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
      background-color: #f9f9f9;
    }

    .row_input {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin: 15px 0;
      align-items: center;
    }

    .form_label_input {
      width: 50%;
      font-size: 18px;
      color: #333;
    }

    .form_input {
      width: 150px;
      height: 40px;
      font-size: 18px;
      padding: 5px;
      border: 1px solid #b3b3b3;
      transition: background-color 0.3s, border 0.3s;
    }

    .form_input:focus {
      background-color: #c3e9fa;
      outline: none;
      border: 1px solid #2988f5;
    }

    .mt_10 {
      margin-top: 10px;
    }

    .mt_30 {
      margin-top: 30px;
    }

    /* Calculate Button */
    .btn_wrapper {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .calculate_btn {
      width: 100%;
      padding: 15px;
      font-size: 18px;
      background-color: #f56614;
      color: #fff;
      font-weight: 700;
      letter-spacing: 1px;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }

    .calculate_btn:hover {
      background-color: #b54504;
    }

    .calculate_btn:active {
      transform: scale(0.98);
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
    }

    /* Output Result Wrapper */
    .output_ahf_wrapper {
      background-color: #f9f9f9;
      border: 1px solid #d3d3d3;
      padding: 20px;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
      margin-top: 30px;
    }

    /* Output Result Label */
    h3 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    /* Result Row */
    .row_input {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin: 15px 0;
      align-items: center;
    }

    .form_label_ahf {
      width: 65%;
      font-size: 18px;
      color: #333;
    }

    /* Output AHF Value */
    .output_ahf {
      font-weight: 700;
      display: flex;
      align-items: center;
    }

    /* Output AHF Input */
    .output_ahf_input {
      width: 100px;
      height: 40px;
      font-size: 18px;
      padding: 5px;
      border: 1px solid #b3b3b3;
      background-color: #f9f9f9;
      border-radius: 5px;
      text-align: center;
      color: #333;
    }

    /* Media Query for Small Screens */
    @media screen and (max-width: 500px) {
      .form_label_input,
      .form_label_ahf {
        width: 100%;
      }

      .form_input {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="main_wrapper">
    <h2>Active Harmonic Filter Calculator</h2>
    <div class="input_wrapper">
      <h5>Masukkan data berikut untuk menghitung standar harmonik pada jaringan distribusi Anda</h5>
      <div class="row_input">
        <label for="ampere" class="form_label_input">Ampere</label>
        <input type="number" id="ampere" class="form_input">
        <span>A</span>
      </div>
      <div class="row_input">
        <label for="thd_saat_ini" class="form_label_input">Nilai THDI saat ini</label>
        <input type="number" id="thd_saat_ini" class="form_input">
        <span>%</span>
      </div>
      <div class="row_input">
        <label for="thd_diharapkan" class="form_label_input">Nilai THDI yang diharapkan</label>
        <input type="number" id="thd_diharapkan" class="form_input">
        <span>%</span>
      </div>
      <div class="btn_wrapper">
        <button type="button" id="calculate_btn" class="calculate_btn">Hitung</button>
      </div>
    </div>
    <div class="output_ahf_wrapper">
      <h3>Hasil</h3>
      <div class="row_input">
        <div class="form_label_ahf">Besaran AHF yang dibutuhkan</div>
        <div class="output_ahf">
          <input type="number" id="output_ahf" class="output_ahf_input" disabled>
          <div class="percentage_center">A</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Add your JavaScript code here
    const ampere = document.querySelector("#ampere");
    const thdSaatIni = document.querySelector("#thd_saat_ini");
    const thdDiharapkan = document.querySelector("#thd_diharapkan");
    const outputResult = document.querySelector("#output_ahf");
    const calculateBtn = document.querySelector("#calculate_btn");

    calculateBtn.addEventListener("click", function () {
      const initial = ahdFormula(ampere.value, thdSaatIni.value);
      const final = ahdFormula(ampere.value, thdDiharapkan.value);
      const results = initial - final;
      outputResult.value = results.toFixed(5);
      console.log(results);
    });

    function ahdFormula(ampere, nilaiThd) {
      return Math.sqrt(
        Math.pow(ampere, 2) * Math.pow(nilaiThd / 100, 2) / (1 + Math.pow(nilaiThd / 100, 2))
      );
    }
  </script>
</body>
</html>
