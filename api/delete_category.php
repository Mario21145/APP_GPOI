<?php

include "../utility/connection.php";
include "../utility/function.php";




if(isset($_POST['cat'])){

  $Categoria = $_POST['cat'];

  $sql = "DELETE FROM `categoria` WHERE Nome_Categoria = '$Categoria' ";
  $result_delete_category = $con->query($sql);

  if(empty($result_delete_category)){
    echo "vuoto";
  }

  if($result_delete_category){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Categoria eliminata con successo!</h3>
          </div>    
        </div>
      ";
  } else {
    echo "
    <div class='position-error  animate-error'>
        <div class='alert alert-danger' role='alert'>
          <h4>Errore durante l'eliminazione della categoria!</h4>
        </div>    
    </div>
    ";
   }
}

?>