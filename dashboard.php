<?php

session_start();

include "utility/connection.php";
include "utility/variables.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Dashboard - <?php echo $_SESSION['Id_Admin']; ?></title>
</head>

<body>
  <style>
    body {
      background-color: #f5f0e8;
      background-size: cover;
      margin-left: 250px;
    }

    .circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #f5f0e8;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      border: 1.2px solid #674f04;
      transition: 0.4s ease-in-out;
    }

    .card:hover {
      padding: 30px;
      background: #d3bd9a !important;
      /*transform: translateY(-20px);*/
    }
  </style>



  <?php include "components/side_dashboard.php" ?>


  <div class="container">
    <h1 style="margin-top: 30px; font-weight: 700; text-align: center; font-size: 60px;">Home</h1>
    <div style='margin-top: 80px;'></div>
    <div class="container text-center">
      <div class="row">

        <div class="col">
          <div class="card">
            <div class="card-header" style='background: #d3bd9a !important; '>
              <h1>Dipendenti</h1>
            </div>
            <div class="card-body d-flex justify-content-center" style='background: #d3bd9a !important; '>
              <div class='circle'>
                <img width="70" height="70" src="https://img.icons8.com/ios-filled/100/groups.png" alt="groups" />
              </div>
              <div style="margin-left: 20px;"></div>
              <div class="d-flex align-items-center">
                <p class="card-text fs-2 text " style='font-weight: 700 !important;'>
                  <?php echo $_SESSION['Numero_dipendenti']; ?>
                </p>
              </div>
              <div style="margin-right: 20px;"></div>
              <div class="d-flex align-items-center">
                <a href="dipendenti.php" class="btn btn-dark fs-2 text">Dettagli</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card">
            <div class="card-header" style='background: #d3bd9a !important; '>
              <h1>Unità Disponibili</h1>
            </div>
            <div class="card-body d-flex justify-content-center" style='background: #d3bd9a !important; '>
              <div class='circle'>
                <img width="70" height="70" src="https://img.icons8.com/ios-filled/100/package.png" alt="package" />
              </div>
              <div style="margin-left: 20px;"></div>
              <div class="d-flex align-items-center">
                <p class="card-text fs-2 text " style='font-weight: 700 !important;'>
                  <?php echo $_SESSION['Quantita_Merce']; ?>
                </p>
              </div>
              <div style="margin-right: 20px;"></div>
              <div class="d-flex align-items-center">
                <a href="magazzino.php" class="btn btn-dark fs-2 text">Dettagli</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card">
            <div class="card-header" style='background: #d3bd9a !important; '>
              <h1>Prodotti Disponibili</h1>
            </div>
            <div class="card-body d-flex justify-content-center" style='background: #d3bd9a !important; '>
              <div class='circle'>
                <img width="70" height="70" src="https://img.icons8.com/ios-filled/100/aliexpress.png" alt="aliexpress" />
              </div>
              <div style="margin-left: 20px;"></div>
              <div class="d-flex align-items-center">
                <p class="card-text fs-2 text " style='font-weight: 700 !important;'>
                  <?php echo $_SESSION['Prodotti']; ?>
                </p>
              </div>
              <div style="margin-right: 20px;"></div>
              <div class="d-flex align-items-center">
                <a href="prodotti.php" class="btn btn-dark fs-2 text">Dettagli</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">

        <div class="col">
          <div class="card">
            <div class="card-header" style='background: #d3bd9a !important; '>
              <h1>Entrate</h1>
            </div>
            <div class="card-body d-flex justify-content-center" style='background: #d3bd9a !important; '>
              <div class='circle'>
                <img width="70" height="70" src="https://img.icons8.com/ios-filled/100/get-revenue.png" alt="get-revenue" />
              </div>
              <div style="margin-left: 20px;"></div>
              <div class="d-flex align-items-center">
                <p class="card-text fs-2 text " style='font-weight: 700 !important; color: green;'>
                  <?php echo rand(0, 9999); ?>
                </p>
              </div>
              <div style="margin-right: 20px;"></div>
              <div class="d-flex align-items-center">
                <a href="Analytics.php" class="btn btn-dark fs-2 text">Dettagli</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card">
            <div class="card-header" style='background: #d3bd9a !important; '>
              <h1>Uscite</h1>
            </div>
            <div class="card-body d-flex justify-content-center" style='background: #d3bd9a !important; '>
              <div class='circle'>
                <img width="70" height="70" src="https://img.icons8.com/ios-filled/100/package.png" alt="package" />
              </div>
              <div style="margin-left: 20px;"></div>
              <div class="d-flex align-items-center">
                <p class="card-text fs-2 text " style='font-weight: 700 !important; color: red;'>
                  <?php echo rand(0, 9999) ?>
                </p>
              </div>
              <div style="margin-right: 20px;"></div>
              <div class="d-flex align-items-center">
                <a href="Analytics.php" class="btn btn-dark fs-2 text">Dettagli</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <svg style='position: fixed; bottom: 0;' id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 230" version="1.1" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(200.677, 180.823, 149.056, 1)" offset="0%"></stop>
        <stop stop-color="rgba(103, 79, 4, 1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,46L60,65.2C120,84,240,123,360,145.7C480,169,600,176,720,161C840,146,960,107,1080,103.5C1200,100,1320,130,1440,153.3C1560,176,1680,192,1800,176.3C1920,161,2040,115,2160,95.8C2280,77,2400,84,2520,95.8C2640,107,2760,123,2880,107.3C3000,92,3120,46,3240,34.5C3360,23,3480,46,3600,65.2C3720,84,3840,100,3960,103.5C4080,107,4200,100,4320,88.2C4440,77,4560,61,4680,72.8C4800,84,4920,123,5040,130.3C5160,138,5280,115,5400,92C5520,69,5640,46,5760,34.5C5880,23,6000,23,6120,30.7C6240,38,6360,54,6480,76.7C6600,100,6720,130,6840,153.3C6960,176,7080,192,7200,168.7C7320,146,7440,84,7560,53.7C7680,23,7800,23,7920,26.8C8040,31,8160,38,8280,61.3C8400,84,8520,123,8580,141.8L8640,161L8640,230L8580,230C8520,230,8400,230,8280,230C8160,230,8040,230,7920,230C7800,230,7680,230,7560,230C7440,230,7320,230,7200,230C7080,230,6960,230,6840,230C6720,230,6600,230,6480,230C6360,230,6240,230,6120,230C6000,230,5880,230,5760,230C5640,230,5520,230,5400,230C5280,230,5160,230,5040,230C4920,230,4800,230,4680,230C4560,230,4440,230,4320,230C4200,230,4080,230,3960,230C3840,230,3720,230,3600,230C3480,230,3360,230,3240,230C3120,230,3000,230,2880,230C2760,230,2640,230,2520,230C2400,230,2280,230,2160,230C2040,230,1920,230,1800,230C1680,230,1560,230,1440,230C1320,230,1200,230,1080,230C960,230,840,230,720,230C600,230,480,230,360,230C240,230,120,230,60,230L0,230Z"></path>
    <defs>
      <linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(162, 143, 112, 1)" offset="0%"></stop>
        <stop stop-color="rgba(211, 189, 154, 1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform:translate(0, 50px); opacity:0.9" fill="url(#sw-gradient-1)" d="M0,115L60,95.8C120,77,240,38,360,19.2C480,0,600,0,720,34.5C840,69,960,138,1080,168.7C1200,199,1320,192,1440,168.7C1560,146,1680,107,1800,103.5C1920,100,2040,130,2160,130.3C2280,130,2400,100,2520,92C2640,84,2760,100,2880,99.7C3000,100,3120,84,3240,88.2C3360,92,3480,115,3600,111.2C3720,107,3840,77,3960,84.3C4080,92,4200,138,4320,164.8C4440,192,4560,199,4680,172.5C4800,146,4920,84,5040,69C5160,54,5280,84,5400,95.8C5520,107,5640,100,5760,88.2C5880,77,6000,61,6120,49.8C6240,38,6360,31,6480,30.7C6600,31,6720,38,6840,61.3C6960,84,7080,123,7200,115C7320,107,7440,54,7560,49.8C7680,46,7800,92,7920,107.3C8040,123,8160,107,8280,107.3C8400,107,8520,123,8580,130.3L8640,138L8640,230L8580,230C8520,230,8400,230,8280,230C8160,230,8040,230,7920,230C7800,230,7680,230,7560,230C7440,230,7320,230,7200,230C7080,230,6960,230,6840,230C6720,230,6600,230,6480,230C6360,230,6240,230,6120,230C6000,230,5880,230,5760,230C5640,230,5520,230,5400,230C5280,230,5160,230,5040,230C4920,230,4800,230,4680,230C4560,230,4440,230,4320,230C4200,230,4080,230,3960,230C3840,230,3720,230,3600,230C3480,230,3360,230,3240,230C3120,230,3000,230,2880,230C2760,230,2640,230,2520,230C2400,230,2280,230,2160,230C2040,230,1920,230,1800,230C1680,230,1560,230,1440,230C1320,230,1200,230,1080,230C960,230,840,230,720,230C600,230,480,230,360,230C240,230,120,230,60,230L0,230Z"></path>
    <defs>
      <linearGradient id="sw-gradient-2" x1="0" x2="0" y1="1" y2="0">
        <stop stop-color="rgba(211, 189, 154, 1)" offset="0%"></stop>
        <stop stop-color="rgba(139.204, 100.879, 16.16, 1)" offset="100%"></stop>
      </linearGradient>
    </defs>
    <path style="transform:translate(0, 100px); opacity:0.8" fill="url(#sw-gradient-2)" d="M0,69L60,65.2C120,61,240,54,360,53.7C480,54,600,61,720,76.7C840,92,960,115,1080,126.5C1200,138,1320,138,1440,126.5C1560,115,1680,92,1800,76.7C1920,61,2040,54,2160,49.8C2280,46,2400,46,2520,53.7C2640,61,2760,77,2880,95.8C3000,115,3120,138,3240,130.3C3360,123,3480,84,3600,80.5C3720,77,3840,107,3960,134.2C4080,161,4200,184,4320,195.5C4440,207,4560,207,4680,195.5C4800,184,4920,161,5040,153.3C5160,146,5280,153,5400,134.2C5520,115,5640,69,5760,61.3C5880,54,6000,84,6120,84.3C6240,84,6360,54,6480,38.3C6600,23,6720,23,6840,38.3C6960,54,7080,84,7200,88.2C7320,92,7440,69,7560,65.2C7680,61,7800,77,7920,95.8C8040,115,8160,138,8280,145.7C8400,153,8520,146,8580,141.8L8640,138L8640,230L8580,230C8520,230,8400,230,8280,230C8160,230,8040,230,7920,230C7800,230,7680,230,7560,230C7440,230,7320,230,7200,230C7080,230,6960,230,6840,230C6720,230,6600,230,6480,230C6360,230,6240,230,6120,230C6000,230,5880,230,5760,230C5640,230,5520,230,5400,230C5280,230,5160,230,5040,230C4920,230,4800,230,4680,230C4560,230,4440,230,4320,230C4200,230,4080,230,3960,230C3840,230,3720,230,3600,230C3480,230,3360,230,3240,230C3120,230,3000,230,2880,230C2760,230,2640,230,2520,230C2400,230,2280,230,2160,230C2040,230,1920,230,1800,230C1680,230,1560,230,1440,230C1320,230,1200,230,1080,230C960,230,840,230,720,230C600,230,480,230,360,230C240,230,120,230,60,230L0,230Z"></path>
  </svg>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    var elemento = document.getElementById("get_value");
    var valore = elemento.textContent;


    var elements = document.getElementsByClassName('myElement');

    // Recupera i valori di tutti gli elementi
    for (var i = 0; i < elements.length; i++) {
      var value = elements[i].textContent;
      console.log(value);
    }


    const datiVenditeMensili = {
      labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno'],
      datasets: [{
        label: 'Vendite Mensili',
        data: [1200, 1500, valore, 1800, 2000, 1300],
        backgroundColor: '#d3bd9a',
        borderColor: '#a28f70',
        borderWidth: 2
      }]
    };

    const opzioniGrafico = {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    const canvasGrafico = document.getElementById('myChart').getContext('2d');

    const grafico = new Chart(canvasGrafico, {
      type: 'bar',
      data: datiVenditeMensili,
      options: opzioniGrafico
    });
  </script>

</body>

</html>