<?php

include "../utility/connection.php";
include "../utility/function.php";

if(isset($_POST['Nome_Categoria'])){

  $Nome_categoria = $_POST['Nome_Categoria'];

  $sql_insert_category = "INSERT INTO `categoria`(`Nome_Categoria`) VALUES ('$Nome_categoria')";
  $result_insert_category = $con->query($sql_insert_category);

  if($result_insert_category){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Categoria inserita con successo!</h3>
          </div>    
        </div>
      ";
  } else {
    echo "
    <div class='position-error  animate-error'>
        <div class='alert alert-danger' role='alert'>
          <h4>Errore durante l'inserimento della categoria!</h4>
        </div>    
    </div>
    ";
   }
}

?>