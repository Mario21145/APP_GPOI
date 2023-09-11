<?php

include "utility/connection.php";
require_once "prodotti.php";

$ID_PRODOTTO = $_POST['id_prodotto'];
$sql_check = "SELECT * FROM prodotti WHERE ID_Prodotto = $ID_PRODOTTO";
$result_check = $con->query($sql_check);
$rows = $result_check->num_rows;


echo 
"
<br>
<form action='prodotti.php' method='post' class='row row-cols-lg-auto g-3 d-flex justify-content-center'>
        <div class='col-12'>
    <div class='input-group'>
        <h1 style='font-weight: 700; font-size: 30px; margin-top: 10px; margin-right: 10px;'>Elimina prodotto </h1>
        <input type='text' class='form-control form-select-lg' id='inlineFormInputGroupUsername' placeholder='Inserire Id prodotto' name='Id_Prodotto'>
    </div>
    </div>
    <div class='col-12'>
        <button type='submit' class='btn btn-danger' name='Elimina_bottone'> <img style='margin-top: 5px;' width='35' height='35' src='https://img.icons8.com/sf-black-filled/64/delete-forever.png' alt='delete-forever'</button>
    </div>
</form>
";













?>