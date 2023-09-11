<?php

use function PHPSTORM_META\type;

include "../utility/connection.php";
include "../utility/function.php";

if(isset($_POST['Quantità']) && isset($_POST['Nome_prodotto_Magazzino'])){

  $nome_prodotto_magazzino = $_POST['Nome_prodotto_Magazzino'];
  $Quantità = $_POST['Quantità'];
  
  $check_row_sql_prodotto_magazzino = "SELECT * FROM magazzino WHERE Nome = '$nome_prodotto_magazzino'";
  $result_check_row_sql_prodotto_magazzino = $con->query($check_row_sql_prodotto_magazzino);
  $rows_product_magazzino = $result_check_row_sql_prodotto_magazzino->num_rows;
  
  if($rows_product_magazzino > 0){

    $sql_quantity = "SELECT * FROM magazzino WHERE Nome = '$nome_prodotto_magazzino'";
    $result_sql_quantity = $con->query($sql_quantity);
    $fetched_result_quantity = mysqli_fetch_all($result_sql_quantity);
  
    if(!empty($fetched_result_quantity[0][2])){
      $new_sum_quantity = intval($fetched_result_quantity[0][2]) + intval($Quantità);
      $sql_update_quantity = "UPDATE `magazzino` SET `Quantità`='$new_sum_quantity' WHERE Nome = '$nome_prodotto_magazzino'";
      $result_update_quantity = $con->query($sql_update_quantity);
      if($result_update_quantity){
        echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-success' role='success'>
              <h3>Aggiunta la quantità alla quantità gia presente!</h3>
            </div>    
          </div>
        ";
      } else {
      echo "
      <div class='position-error  animate-error'>
          <div class='alert alert-danger' role='alert'>
            <h4>Errore durante l'operazione!</h4>
          </div>    
      </div>
      ";
     }
    }
  } else {
    $sql_insert_quantity = "INSERT INTO magazzino(Nome , Quantità) VALUES ('$nome_prodotto_magazzino' , '$Quantità')";
    $result_insert_quantity = $con->query($sql_insert_quantity);
    if($result_insert_quantity){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Operazione avvenuta con successo!</h3>
          </div>    
        </div>
      ";
  } else {
    echo "
    <div class='position-error  animate-error'>
        <div class='alert alert-danger' role='alert'>
          <h4>Errore durante l'operazione!</h4>
        </div>    
    </div>
    ";
   }
  }
}

?>