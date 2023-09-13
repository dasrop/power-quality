<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Filter Harmonik Aktif</title>
    <style>
        /* Styling for Input Wrapper */
        .ahf-input-wrapper {
            border: 1px solid #d3d3d3;
            padding: 10px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            background-color: #f9f9f9;
        }

        .ahf-row-input {
            display: flex;
            flex-wrap: wrap;
            margin: 10px 0;
            align-items: center;
        }

        /* Modifikasi lebar pada tampilan mobile */
        .ahf-form-label-input,
        .ahf-form-input {
            width: 100%;
            font-size: 18px;
            color: #333;
        }

        .ahf-form-input {
            height: 30px;
            font-size: 14px;
            border: 1px solid #b3b3b3;
            transition: background-color 0.3s, border 0.3s, box-shadow 0.3s;
        }

        .ahf-form-input:focus {
            background-color: #c3e9fa;
            outline: none;
            border: 1px solid #ff8000;
            box-shadow: 0 0 5px rgba(255, 128, 0, 0.5);
        }

        /* Styling for Calculate Button */
        .ahf-btn-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .calculate_btn,
        .reset_btn {
            width: 48%;
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .calculate_btn {
            background-color: orange; /* Warna oranye */
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .calculate_btn:hover {
            background-color: darkorange; /* Warna oranye lebih gelap saat dihover */
        }

        .calculate_btn:active {
            transform: scale(0.98);
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .reset_btn {
            background-color: #ccc;
            color: #333;
        }

        .reset_btn:hover {
            background-color: #ddd;
        }

        .reset_btn:active {
            transform: scale(0.98);
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="main_wrapper">
        <div class="main_wrapper_calculator">
            <form id="ahf-form" class="ahf-input-wrapper">
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
                    <input type="number" id="output_ahf" class="ahf-form-input" disabled="">
                    <span>A</span>
                </div>
                <div class="ahf-btn-wrapper">
                    <button type="button" id="calculate_btn" class="calculate_btn">Hitung</button>
                    <button type="reset" class="reset_btn">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const ampere = document.querySelector("#ampere");
        const thdSaatIni = document.querySelector("#thd_saat_ini");
        const thdDiharapkan = document.querySelector("#thd_diharapkan");
        const outputResult = document.querySelector("#output_ahf");
        const calculateBtn = document.querySelector("#calculate_btn");
        const resetBtn = document.querySelector("#ahf-form");

        calculateBtn.addEventListener("click", function() {
            const initial = ahdFormula(ampere.value, thdSaatIni.value);
            const final = ahdFormula(ampere.value, thdDiharapkan.value);
            const results = initial - final;
            outputResult.value = results.toFixed(5);
        });

        resetBtn.addEventListener("reset", function() {
            outputResult.value = "";
        });

        function ahdFormula(ampere, nilaiThd) {
            return Math.sqrt(Math.pow(ampere, 2) * Math.pow((nilaiThd / 100), 2) / (1 + Math.pow((nilaiThd / 100), 2)));
        }
    </script>
</body>
</html>
