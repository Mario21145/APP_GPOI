<?php

include "../utility/connection.php";
include "../utility/function.php";

if(isset($_POST['Id_Prodotto']) && isset($_POST['Nome_prodotto']) && isset($_POST['Categoria']) && isset($_POST['Prezzo'])){

  $Id_prodotto = $_POST['Id_Prodotto'];
  $Nome_prodotto = $_POST['Nome_prodotto'];
  $Categoria = $_POST['Categoria'];
  $Prezzo = $_POST['Prezzo'];

  $sql_insert_product = "INSERT INTO prodotti(ID_Prodotto, Nome_Prodotto, Categoria_Prodotto , Prezzo) VALUES ('$Id_prodotto','$Nome_prodotto','$Categoria','$Prezzo')";
  $result_insert = $con->query($sql_insert_product);
  if($result_insert){
      echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Prodotto aggiunto con successo!</h3>
                <div style='text-align: center; font-weight: 700;'>
                    <p>Id: $Id_prodotto</p><p>Nome: $Nome_prodotto</p><p>Categoria: $Categoria</p><p>Categoria: $Prezzo</p>
                </div>
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