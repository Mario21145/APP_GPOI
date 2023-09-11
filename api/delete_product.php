<?php

include "../utility/connection.php";
include "../utility/function.php";

if(isset($_POST['id_P'])){
  $ID = $_POST['id_P'];
  $sql_delete_product = "DELETE FROM prodotti WHERE ID_Prodotto = $ID";
  $result_delete = $con->query($sql_delete_product);
  if($result_delete){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Prodotto Eliminato con successo!</h3>
          </div>    
        </div>
      ";
  } else {
    echo "
    <div class='position-error  animate-error'>
        <div class='alert alert-danger' role='alert'>
          <h4>Errore durante l'esecuzione dell'operazione</h4>
        </div>    
    </div>
    ";
   }
}
    

  



?>