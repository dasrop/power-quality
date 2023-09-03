<!DOCTYPE html>
<html>
<head>
  <title>Kalkulator kVAr Kapasitor</title>
  <style>
    /* CSS untuk tombol */
    .orange-button {
  background-color: orange;
  border: 2px solid orange;
  border-radius: 4px;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

    /* CSS untuk efek hover pada tombol */
    .orange-button:hover {
      background-color: darkorange;
    }

    /* CSS untuk sel hasil */
    .result {
      font-weight: bold;
      padding-top: 10px;
    }

    /* CSS untuk label peringatan */
    .warning {
      color: red;
      font-size: 12px;
      padding-top: 5px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Kalkulator kVAr Kapasitor</h1>

  <table class="calc">
    <tbody>
      <tr>
        <td>Masukkan faktor daya saat ini (COS Φ1):</td>
        <td><input id="cpf" type="text" /></td>
      </tr>
      <tr>
        <td>Masukkan beban saat ini (kW):</td>
        <td><input id="cl" type="text" /></td>
      </tr>
      <tr>
        <td>Masukkan Faktor Daya yang diinginkan (COS Φ2):</td>
        <td><input id="rpf" type="text" /></td>
      </tr>
      <tr>
        <td><b>Kapasitor kVAr yang Dibutuhkan:</b></td>
        <td class="result"></td>
      </tr>
      <tr>
        <td colspan="2" class="warning" id="warning-label"></td>
      </tr>
      <tr>
        <td style="text-align: right;">
          <input id="calckvar" class="orange-button" type="button" value="Hitung" />
        </td>
        <td style="text-align: left;">
          <input id="reset" class="orange-button" type="button" value="Reset" />
        </td>
      </tr>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $('input#calckvar').click(function() {
        var a = $('input#cpf').val();
        var b = $('input#cl').val();
        var c = $('input#rpf').val();

        if (!isNumeric(a) || !isNumeric(b) || !isNumeric(c)) {
          $('#warning-label').text("Nilai tidak valid! Mohon masukkan nilai numerik.");
        } else if (a <= 0 || a >= 1) {
          $('#warning-label').text("Mohon masukkan angka di atas 0 dan di bawah 1 untuk 'Masukkan faktor daya saat ini'");
        } else if (c <= 0 || c >= 1) {
          $('#warning-label').text("Mohon masukkan angka di atas 0 dan di bawah 1 untuk 'Masukkan Faktor Daya yang diinginkan'");
        } else {
          $('#warning-label').text("");
          var answer = Math.round(parseFloat(b) * (Math.tan(Math.acos(parseFloat(a))) - Math.tan(Math.acos(parseFloat(c)))));
          $('table.calc td.result').text(answer);
        }
      });

      $('input#reset').click(function() {
        $('input[type="text"]').val("");
        $('#warning-label').text("");
        $('table.calc td.result').text("");
      });

      function isNumeric(value) {
        return !isNaN(value) && !isNaN(parseFloat(value));
      }
    });
  </script>
</body>
</html>
