<?php


include "connection.php";

$nome_azienda = "M&M ICT";

if(isset($_SESSION['Id_Admin']))
    $sql_count_Prodotti = "SELECT ID_Prodotto FROM prodotti";
    $result_count_Prodotti = $con->query($sql_count_Prodotti);
    $Rows_Prodotti = $result_count_Prodotti->num_rows;
    $_SESSION['Prodotti'] = $Rows_Prodotti;

    $sql = "SELECT * FROM dipendenti";
    $result = $con->query($sql);
    $rows_dipendenti = $result->num_rows;
    $_SESSION['Numero_dipendenti'] = $rows_dipendenti;

    $sql_quantity = "SELECT Quantità , Nome FROM magazzino";
    $result_sql_quantity = $con->query($sql_quantity);
    $fetched_result_quantity = mysqli_fetch_all($result_sql_quantity);

    $Total_quantity = 0;

    foreach($fetched_result_quantity as $i){
        $Total_quantity = $Total_quantity + $i[0]; 
        $_SESSION['Quantita_Merce'] = $Total_quantity;
      }
?>