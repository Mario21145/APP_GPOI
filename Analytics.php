<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Entrate ed Uscite</title>
</head>
<body>

<style>
    body{
        background-color: #f5f0e8;
        background-size: cover;
        margin-left: 250px;
    }
</style>

<?php include "components/side_dashboard.php";?>

<div class="container">


    <div class="container-enter-exit">
        <h1 style="margin-top: 30px;">Analitica generale </h1>
           
        <br>
        <canvas id="myChart"></canvas>
        <br>
        <div style='display: flex; flex-direction: column; justify-content: center;'>
        <div class="container-info">
            <div class="box-entrate">
                <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/up--v1.png" alt="up--v1"/>
                <h1>Entrate</h1>
                <h2 style="color: green; font-weight: 700;"><?php echo rand(1, 9999);?>€</h2>
            </div>
            <div class="box-uscite">
                <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/down--v1.png" alt="down--v1"/>
                <h1>Uscite</h1>
                <h2 style="color: red; font-weight: 700;">-<?php echo rand(1, 9999);?>€</h2>
            </div>
            <div class="box-stima-out-of-stock">
                <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/estimate.png" alt="estimate"/>
                <h1>Perdite</h1>
                <h2 style="color: red; font-weight: 700;">-<?php echo rand(1, 9999);?>€</h2>
            </div>
            <div class="box-guadagno_totale">
                <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/euro-pound-exchange.png" alt="euro-pound-exchange"/>
                <h1>Guadagno</h1>
                <h2 style="color: green; font-weight: 700;"><?php echo rand(1, 9999);?>€</h2>
            </div>
        </div>
        

        </div>
        



           



    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 // Dati di esempio
        var datiEntrate = [5000, 4200, 1800, 1900, 9000, 4500, 5343 , 1110 , 5400, 4320 , 3030 , 1000, 3200];
        var datiUscite = [3000, 2400, 900, 800, 5000, 3400, 3370 , 3244 , 4700, 2300 , 2600 , 1500];
        var labels = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio" , "Giugno" , "Luglio" , "Agosto" , "Settembre" , "Ottobre" , "Novembre" , "Dicembre"];

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Entrate',
                    data: datiEntrate,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                },
                {
                    label: 'Uscite',
                    data: datiUscite,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
          y: {
            grid: {
              color: 'black', // Cambia il colore delle griglie verticali (asse Y)
            } ,
            beginAtZero: true,
          },
          x: {
            grid: {
              color: 'black', // Cambia il colore delle griglie verticali (asse Y)
            } ,
            beginAtZero: true,
          } 
        }
            }
        });


</script>

</body>
</html>