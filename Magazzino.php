<?php

include "utility/connection.php";
include "utility/function.php";

session_start();

if(isset($_SESSION['Id_Admin'])){







    $sql_product = "SELECT Nome_Prodotto FROM prodotti";
    $result_sql_product = $con->query($sql_product);
    $fetched_result_product = mysqli_fetch_all($result_sql_product);

    $sql_quantity = "SELECT Quantità , Nome FROM magazzino";
    $result_sql_quantity = $con->query($sql_quantity);
    $fetched_result_quantity = mysqli_fetch_all($result_sql_quantity);
  
    foreach($fetched_result_product as $row){
        echo " 
        <div style='display: none;'>
            <p class='product'>$row[0]</p>
        </div>
        ";
    }

    foreach($fetched_result_quantity as $row_q){
      echo " 
      <div style='display: none;'>
          <p class='quantity'>$row_q[0]-$row_q[1]</p>
      </div>
      ";
  }

  //Per merce totale

  $Total_quantity = 0;

  foreach($fetched_result_quantity as $i){
    $Total_quantity = $Total_quantity + $i[0]; 
    $_SESSION['Quantita_Merce'] = $Total_quantity;
  }

  //Per merce fuori magazzino
  $sql_select_all_quantità_FuoriMagazzino = "SELECT Quantità_Fuori_Magazzino FROM magazzino";
  $result_sql_select_all_quantità_FuoriMagazzino = $con->query($sql_select_all_quantità_FuoriMagazzino);
  $fetched_result_sql_select_all_quantità_FuoriMagazzino = mysqli_fetch_all($result_sql_select_all_quantità_FuoriMagazzino);

  $Total_quantity_outOfStock = 0;

  foreach($fetched_result_sql_select_all_quantità_FuoriMagazzino as $i){
    $Total_quantity_outOfStock = $Total_quantity_outOfStock + $i[0]; 
  }

  //Aggiungi quantità
  if(isset($_POST['Aggiungi_Quantità_bottone'])){
    if(isset($_POST['Quantità_Magazzino']) && isset($_POST['selected_product'])){
    
    $Selected_product = $_POST['selected_product'];
    $Quantità = $_POST['Quantità_Magazzino'];

    $data = array(
      'Nome_prodotto_Magazzino' => $Selected_product,
      'Quantità' => $Quantità,
    );

    echo Request_POST('insert_quantity.php' , $data);
     header("Refresh: 2");
    }
}


   

   //controllo se il prodotto e gia fuori magazzino
   if(isset($_POST['Aggiungi_Quantità_FuoriMagazzino_bottone'])){
    if(isset($_POST['Quantità_Fuori_Magazzino']) && isset($_POST['selected_product'])){
      
      $Quantità_fuori_magazzino = $_POST['Quantità_Fuori_Magazzino'];
      $nome_prodotto = $_POST['selected_product'];

      $sql_check_fuorimagazzino = "SELECT Fuori_Magazzino FROM magazzino WHERE Nome = '$nome_prodotto'";
      $result_sql_check_fuorimagazzino = $con->query($sql_check_fuorimagazzino);
      $fetched_result_check_fuorimagazzino = mysqli_fetch_all($result_sql_check_fuorimagazzino);

      if($fetched_result_check_fuorimagazzino[0][0] == 0 && $fetched_result_sql_select_all_quantità_FuoriMagazzino[0][0] == 0){
        $sql_update_product = "UPDATE `magazzino` SET `Quantità_Fuori_Magazzino`='$Quantità_fuori_magazzino ' , `Fuori_Magazzino`='1' WHERE Nome = '$nome_prodotto'";
        $result_sql_update_product = $con->query($sql_update_product);
        if($result_sql_update_product){

          $sql_add_quantity = "UPDATE magazzino SET Quantità_Fuori_Magazzino = $Quantità_fuori_magazzino WHERE Nome = '$nome_prodotto'";
          $result_sql_add_quantity = $con->query($sql_add_quantity);

          if($result_sql_add_quantity){

            $sql_select_quantità = "SELECT Quantità FROM magazzino WHERE Nome = '$nome_prodotto'";
            $result_sql_select_quantità = $con->query($sql_select_quantità);
            $fetched_result_sql_select_quantità = mysqli_fetch_all($result_sql_select_quantità);

            $sql_select_quantità_FuoriMagazzino = "SELECT Quantità_Fuori_Magazzino FROM magazzino WHERE Nome = '$nome_prodotto'";
            $result_sql_select_quantità_FuoriMagazzino = $con->query($sql_select_quantità_FuoriMagazzino);
            $fetched_result_sql_select_quantità_FuoriMagazzino = mysqli_fetch_all($result_sql_select_quantità_FuoriMagazzino);

            $new_quantity = $fetched_result_sql_select_quantità[0][0] - $fetched_result_sql_select_quantità_FuoriMagazzino[0][0];
            $sql_add_newQuantity = "UPDATE magazzino SET Quantità = $new_quantity WHERE Nome = '$nome_prodotto'";
            $result_sql_add_newQuantity = $con->query($sql_add_newQuantity);
            
            if($result_sql_select_quantità && $result_sql_select_quantità_FuoriMagazzino && $result_sql_add_newQuantity){
              echo "
              <div class='position-error  animate-error'>
                <div class='alert alert-success' role='success'>
                  <h3>Prodotto fuori magazzino!</h3>
                  <h4>Quantità modificata!</h4>
                </div>    
              </div>
            ";
            header("Refresh: 5");
            } else {
              echo "
              <div class='position-error  animate-error'>
                <div class='alert alert-danger' role='alert'>
                  <h4>Query non andate a buon fine!</h4>
                </div>    
              </div>
            ";
            header("Refresh: 3");
            }
          } else {
            echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-danger' role='alert'>
              <h4>Errore durante la query add</h4>
            </div>    
          </div>
        ";
        header("Refresh: 3");
          }
        
        } else {
          echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-danger' role='alert'>
              <h4>Errore durante l'update del prodotto</h4>
            </div>    
          </div>
        ";
        header("Refresh: 3");
        }
      } else if($fetched_result_check_fuorimagazzino[0][0] == 1 && $fetched_result_sql_select_all_quantità_FuoriMagazzino[0][0] > 0) {
            $sql_select_quantità_FuoriMagazzino = "SELECT Quantità_Fuori_Magazzino FROM magazzino WHERE Nome = '$nome_prodotto'";
            $result_sql_select_quantità_FuoriMagazzino = $con->query($sql_select_quantità_FuoriMagazzino);
            $fetched_result_sql_select_quantità_FuoriMagazzino = mysqli_fetch_all($result_sql_select_quantità_FuoriMagazzino);
            $new_out_quantity = $Quantità_fuori_magazzino + $fetched_result_sql_select_quantità_FuoriMagazzino[0][0];

            $sql_select_quantità = "SELECT Quantità FROM magazzino WHERE Nome = '$nome_prodotto'";
            $result_sql_select_quantità = $con->query($sql_select_quantità);
            $fetched_result_sql_select_quantità = mysqli_fetch_all($result_sql_select_quantità);

            $sql_select_quantità_FuoriMagazzino = "SELECT Quantità_Fuori_Magazzino FROM magazzino WHERE Nome = '$nome_prodotto'";
            $result_sql_select_quantità_FuoriMagazzino = $con->query($sql_select_quantità_FuoriMagazzino);
            $fetched_result_sql_select_quantità_FuoriMagazzino = mysqli_fetch_all($result_sql_select_quantità_FuoriMagazzino);

            $new_quantity =$fetched_result_sql_select_quantità[0][0] - $fetched_result_sql_select_quantità_FuoriMagazzino[0][0];
            $sql_add_newQuantity = "UPDATE magazzino SET Quantità = $new_quantity WHERE Nome = '$nome_prodotto'";
            $result_sql_add_newQuantity = $con->query($sql_add_newQuantity);

            $sql_add_newQuantity_out = "UPDATE magazzino SET Quantità_Fuori_Magazzino = '$new_out_quantity' WHERE Nome = '$nome_prodotto'";
            $result_sql_add_newQuantity_out = $con->query($sql_add_newQuantity_out);
            if( $result_sql_add_newQuantity_out){
              echo "
              <div class='position-error  animate-error'>
                <div class='alert alert-success' role='success'>
                  <h4>Prodotto gia presente come fuori magazzino</h4>
                  <h4>Quantità aggiunta a quella presente</h4>
                </div>    
              </div>
            ";
           header("Refresh: 3");
            }
      }

    }
  }

 

if(isset($_POST['Elimina_Prodotto_FuoriMagazzino_bottone'])){
  if(isset($_POST['selected_product'])){
      $nome_prodotto_update = $_POST['selected_product'];
      $sql_update_fuorimagazzino_product = "UPDATE magazzino SET `Fuori_Magazzino`='0' , Quantità_Fuori_Magazzino = '0' WHERE Nome = '$nome_prodotto_update'";
      $result_sql_update_fuorimagazzino_product = $con->query($sql_update_fuorimagazzino_product);
      if($result_sql_update_fuorimagazzino_product ){
        echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h4>Prodotto eliminato dal fuori magazzino</h4>
          </div>    
        </div>
      ";
     header("Refresh: 3");
      } else {
        echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-danger' role='alert'>
              <h4>Errore durante l'elimininazione</h4>
            </div>    
          </div>
        ";
        header("Refresh: 3");
      }
  }
}



}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Magazzino</title>
</head>

<body>

    <style>
    body {
        background-color: #f5f0e8;
        background-size: cover;
        margin-left: 250px;
    }
    </style>

    <?php include "components/side_dashboard.php";?>








    <div class="container">
        <div class="container-magazzino">
            <h2 style="margin-top: 30px; margin-bottom: 40px; font-weight: 700; text-align: center; font-size: 60px;">
                Magazzino</h2>
            <div class="container-info" style="padding: 30px;">
                <div class="box-grafico" style=" border-radius: 20px;">
                    <canvas id='ShowProductsAvailable'></canvas>
                </div>
                <div class="box-general-info">
                    <div class="box-merce-totale">
                        <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/big-parcel.png"
                            alt="big-parcel" />
                        <h1>Merce totale</h1>
                        <h1><?php echo $Total_quantity ?></h1>
                    </div>
                    <div class="box-merce-venduta">
                        <img width="100" height="100"
                            src="https://img.icons8.com/external-tal-revivo-bold-tal-revivo/96/external-line-chart-file-uploaded-on-a-company-server-business-bold-tal-revivo.png"
                            alt="external-line-chart-file-uploaded-on-a-company-server-business-bold-tal-revivo" />
                        <h1>Merce venduta</h1>
                        <h1><?php echo rand($Total_quantity, 99999)?></h1>
                    </div>
                    <div class="box-merce-fuori-magazzino">
                        <img src="images/icons8-out-of-stock-100.png">
                        <h1>Merce fuori magazzino</h1>
                        <h1><?php echo $Total_quantity_outOfStock?></h1>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="box insert-quantita">
                <h2 style="font-weight: 700; text-align: center; font-size: 40px,">Aggiungi quantità prodotto</h2>
                <br>
                <form action="Magazzino.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="nome-prodotto"
                            name="Quantità_Magazzino">
                        <label for="floatingInput">Aggiungi Quantità</label>
                    </div>
                    <div style="margin: 10px 0px 10px 0px;"></div>

                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="selected_product">
                            <option selected>Nome prodotto</option>
                            <?php
                  
                          $sql_prodotto_selected = "SELECT * FROM prodotti";
                          $result_sql_prodotto_selected = $con->query($sql_prodotto_selected);
                          $fetched_sql_prodotto_selected = mysqli_fetch_all($result_sql_prodotto_selected);
                          foreach($fetched_sql_prodotto_selected as $o ){
                            $selected = '';
                            if (in_array($o[1], $Selected_product)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[1] . "' $selected>" . $o[1] . "</option>";
                          }
                        ?>
                        </select>
                        <label for="floatingSelect">Nome del prodotto</label>
                    </div>

                    <br>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type='submit' class='btn btn-success justify-center'
                            name='Aggiungi_Quantità_bottone'>Aggiungi <img width="40" height="40"
                                src="https://img.icons8.com/ios-filled/50/plus-2-math.png" alt="plus-2-math" /></button>
                    </div>

                </form>
            </div>


            <div class="box-gestisci-quantita-fuori-magazzino">
                <div class="box-insert-prodotti-fuori-magazzino">
                    <h2 style="font-weight: 700; text-align: center; font-size: 40px,">Aggiungi prodotto fuori magazzino
                    </h2>
                    <br>
                    <form action="Magazzino.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="nome-prodotto"
                                name="Quantità_Fuori_Magazzino">
                            <label for="floatingInput">Aggiungi Quantità Fuori Magazzino</label>
                        </div>
                        <div style="margin: 10px 0px 10px 0px;"></div>

                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="selected_product">
                                <option selected>Nome prodotto</option>
                                <?php
                  
                          $sql_prodotto_selected = "SELECT * FROM prodotti";
                          $result_sql_prodotto_selected = $con->query($sql_prodotto_selected);
                          $fetched_sql_prodotto_selected = mysqli_fetch_all($result_sql_prodotto_selected);
                          foreach($fetched_sql_prodotto_selected as $o ){
                            $selected = '';
                            if (in_array($o[1], $Selected_product)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[1] . "' $selected>" . $o[1] . "</option>";
                          }
                        ?>
                            </select>
                            <label for="floatingSelect">Nome del prodotto</label>
                        </div>

                        <br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type='submit' class='btn btn-success justify-center'
                                name='Aggiungi_Quantità_FuoriMagazzino_bottone'>Aggiungi <img width="40" height="40"
                                    src="https://img.icons8.com/ios-filled/50/plus-2-math.png"
                                    alt="plus-2-math" /></button>
                        </div>

                    </form>
                </div>
                <div class="box-delete-prodotti-fuori-magazzino">
                    <h2 style="font-weight: 700; text-align: center; font-size: 40px,">Elimina prodotto fuori magazzino
                    </h2>
                    <br>
                    <form action="Magazzino.php" method="post">
                        <div style="margin: 10px 0px 10px 0px;"></div>

                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="selected_product">
                                <option selected>Nome prodotto</option>
                                <?php
                  
                          $sql_prodotto_selected = "SELECT * FROM prodotti";
                          $result_sql_prodotto_selected = $con->query($sql_prodotto_selected);
                          $fetched_sql_prodotto_selected = mysqli_fetch_all($result_sql_prodotto_selected);
                          foreach($fetched_sql_prodotto_selected as $o ){
                            $selected = '';
                            if (in_array($o[1], $Selected_product)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[1] . "' $selected>" . $o[1] . "</option>";
                          }
                        ?>
                            </select>
                            <label for="floatingSelect">Nome del prodotto</label>
                        </div>

                        <br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type='submit' class='btn btn-danger justify-center'
                                name='Elimina_Prodotto_FuoriMagazzino_bottone'>Elimina <img width='40' height='40'
                                    src='https://img.icons8.com/sf-black-filled/64/delete-forever.png'
                                    alt='delete-forever'></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    let labels = [];
    let data = [];

    var magazzino = document.getElementsByClassName('quantity');
    var prodotti_magazzino = [];
    for (var i = 0; i < magazzino.length; i++) {
        let quantita = magazzino[i].textContent.split("-")[0];
        let nome = magazzino[i].textContent.split("-")[1];
        prodotti_magazzino[nome] = quantita;
    }

    var products = document.getElementsByClassName('product');
    for (var i = 0; i < products.length; i++) {
        let nome = products[i].textContent;
        if (prodotti_magazzino[nome] != undefined) {
            labels.push(nome);
            data.push(prodotti_magazzino[nome]);
        } else {
            labels.push(nome);
            data.push(0);
        }
    }

    var ctx = document.getElementById('ShowProductsAvailable').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Unità Disponibili',
                data: data,
                backgroundColor: '#d3bd9a',
                borderColor: '#a28f70',
                borderWidth: 2,
                borderRadius: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    color: 'black' // Cambia il colore del titolo del grafico
                },
            },
            scales: {
                y: {
                    grid: {
                        color: 'black', // Cambia il colore delle griglie verticali (asse Y)
                    },
                    beginAtZero: true,
                },
                x: {
                    grid: {
                        color: 'black', // Cambia il colore delle griglie verticali (asse Y)
                    },
                    beginAtZero: true,
                }
            }
        }
    });
    </script>

</body>

</html>