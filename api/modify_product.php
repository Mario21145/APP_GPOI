<?php

include "../utility/connection.php";
include "../utility/function.php";

if(isset($_POST['Id_Prodotto']) && isset($_POST['Nome_prodotto']) && isset($_POST['Categoria']) && isset($_POST['Prezzo'])){

  $Id_prodotto = $_POST['Id_Prodotto'];
  $Nome_prodotto = $_POST['Nome_prodotto'];
  $Categoria = $_POST['Categoria'];
  $Prezzo = $_POST['Prezzo'];

  $sql_update_product = "UPDATE `prodotti` SET `Nome_Prodotto`='$Nome_prodotto',`Categoria_Prodotto`='$Categoria' , `Prezzo`='$Prezzo'  WHERE ID_Prodotto = $Id_prodotto";
  $result_update = $con->query($sql_update_product);
  if($result_update){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Prodotto modificato con successo!</h3>
          </div>    
        </div>
      ";
  } else {
    echo "
    <div class='position-error  animate-error'>
        <div class='alert alert-danger' role='alert'>
          <h4>Errore durante la modifica del prodotto!</h4>
        </div>    
    </div>
    ";
   }
}

?>