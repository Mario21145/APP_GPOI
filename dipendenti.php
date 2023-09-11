<?php

include "utility/connection.php";
include "utility/function.php";

session_start();

if(isset($_SESSION['Id_Admin'])){
    $sql = "SELECT * FROM dipendenti";
    $result = $con->query($sql);
    $rows_dipendenti = $result->num_rows;
    $fetch = mysqli_fetch_all($result);

    if(isset($_POST['Cerca_Dipendenti']) & isset($_POST['Id_Dipendente']) ){
      $id_dipendente = $_POST['Id_Dipendente'];
      if(empty($id_dipendente) || strlen($id_dipendente) < 5 || strlen($id_dipendente) > 5){
        echo "
               <div class='alert alert-danger position-error' role='alert'>
                    <h1 style='font-size: 20px; font-weight: 700; '>Errore durante la digitazione dell'id</h1>
               </div>
            ";
        } else {
        $sql = "SELECT * FROM dipendenti WHERE ID_Dipendente = $id_dipendente";
        $result = $con->query($sql);
        $Fetched_Array_Dipedente = mysqli_fetch_all($result);
        if($result){
          echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-success' role='success'>
              <h3>Dipendente trovato!</h3>
            </div>    
          </div>
        ";
        header("Refresh: 10");
        } else {
          echo "
        <div class='position-error  animate-error'>
            <div class='alert alert-danger' role='alert'>
              <h4>Errore durante l'esecuzione dell'operazione</h4>
            </div>    
        </div>
        ";
        header("Refresh: 3");
        }

    }

   if(isset($_POST['Aggiungi_Dipendente_bottone'])){
      $id = rand(0 , 99999);
      if(isset($_POST['Nome_Dipendente'])  && isset($_POST['Cognome_Dipendente']) && isset($_POST['Ruolo_Dipendente']))

     $nome_dipendente = $_POST['Nome_Dipendente'];
     $cognome_dipendente = $_POST['Cognome_Dipendente'];
     $ruolo_dipendente = $_POST['Ruolo_Dipendente'];


      $sql_insert_dipendente = "INSERT INTO dipendenti(ID_Dipendente, Nome_Dipendente, Cognome_Dipendente , Ruolo_Dipendente) VALUES ('$id',' $nome_dipendente',' $cognome_dipendente',' $ruolo_dipendente')";
      $result_sql_insert_dipendente = $con->query($sql_insert_dipendente);

      if($result_sql_insert_dipendente){
        echo "
        <div class='position-error  animate-error'>
          <div class='alert alert-success' role='success'>
            <h3>Dipendente aggiunto con successo!</h3>
                <div style='text-align: center; font-weight: 700;'>
                    <p>Id: $id</p><p>nome: $nome_dipendente</p><p>cognome: $cognome_dipendente</p><p>ruolo: $ruolo_dipendente</p>
                </div>
          </div>    
        </div>
      ";
      header("Refresh: 5");
      } else {
        echo "
        <div class='position-error  animate-error'>
            <div class='alert alert-danger' role='alert'>
              <h4>Errore durante l'esecuzione dell'operazione</h4>
            </div>    
        </div>
        ";
        header("Refresh: 3");
      }
   }

   if(isset($_POST['Modifica_Dipendente_bottone'])){
    if(isset($_POST['Nome_Dipendente'])  && isset($_POST['Cognome_Dipendente']) && isset($_POST['Ruolo_Dipendente']) && isset($_POST['Id_Dipendente'])){
        $nome_dipendente = $_POST['Nome_Dipendente'];
        $cognome_dipendente = $_POST['Cognome_Dipendente'];
        $ruolo_dipendente = $_POST['Ruolo_Dipendente'];
        $id = $_POST['Id_Dipendente'];

        $sql_update_dipendente = "UPDATE `dipendenti` SET `ID_Dipendente`='$id',`Nome_Dipendente`='$nome_dipendente' , `Cognome_Dipendente`='$cognome_dipendente' , `Ruolo_Dipendente`='$ruolo_dipendente'  WHERE ID_Dipendente = $id";
        $result_sql_update_dipendente = $con->query($sql_update_dipendente);

        if($result_sql_update_dipendente){
          echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-success' role='success'>
              <h3>Dipendente modificato con successo!</h3>
                  <div style='text-align: center; font-weight: 700;'>
                      <p>Id: $id</p><p>nome: $nome_dipendente</p><p>cognome: $cognome_dipendente</p><p>ruolo: $ruolo_dipendente</p>
                  </div>
            </div>    
          </div>
        ";
        header("Refresh: 5");
        } else {
          echo "
          <div class='position-error  animate-error'>
              <div class='alert alert-danger' role='alert'>
                <h4>Errore durante l'esecuzione dell'operazione</h4>
              </div>    
          </div>
          ";
          header("Refresh: 3");
        }

    }
   }

   if(isset($_POST['Elimina_Dipendente_bottone'])){
    if(isset($_POST['Id_Dipendente'])){
      $id = $_POST['Id_Dipendente'];

     $sql_delete_dipendente = "DELETE FROM dipendenti WHERE ID_Dipendente = $id";
     $result_sql_delete_dipendente = $con->query($sql_delete_dipendente);

     if($result_sql_delete_dipendente){
      echo "
          <div class='position-error  animate-error'>
            <div class='alert alert-success' role='success'>
              <h3>Dipendente eliminato con successo!</h3>
            </div>    
          </div>
        ";
        header("Refresh: 5");
     } else{
      echo "
      <div class='position-error  animate-error'>
          <div class='alert alert-danger' role='alert'>
            <h4>Errore durante l'esecuzione dell'operazione</h4>
          </div>    
      </div>
      ";
      header("Refresh: 3");
     }
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
    <title>Dipendenti</title>
</head>

<body>

    <style>
    body {
        background-color: #f5f0e8;
        background-size: cover;
        margin-left: 250px;
    }
    </style>


    <?php include "components/side_dashboard.php"; ?>

    <div class="container">
        <div class="container-dipendenti">
            <h1 style="margin-top: 20px; font-weight: 700; text-align: center; font-size: 60px;">Dipendenti</h1>
            <form action="dipendenti.php" method="POST" class="d-flex justify-content-center" role="search"
                style="margin-top: 50px;">
                <input class="form-control me-2" type="search" placeholder="Search By Id" aria-label="Search"
                    name="Id_Dipendente" required>
                <button class="btn btn-outline-success" type="submit" name="Cerca_Dipendenti">Search</button>
            </form>
            <br>

            <table class="table table-hover" style='text-align:center;'>
                <thead>
                    <tr class='box-dipendenti-data border'>
                        <th>
                            <h1>Id</h1>
                        </th>
                        <th>
                            <h1>Nome</h1>
                        </th>
                        <th>
                            <h1>Cognome</h1>
                        </th>
                        <th>
                            <h1>ruolo</h1>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php
                      
                      if(isset($_POST['Cerca_Dipendenti'])){
                        if(empty($Fetched_Array_Dipedente)){
                          echo "<tr class='table-danger'>";
                          echo "   
                            <td class='table-danger'><h1>Nessun <b>id</b> trovato!</h1></td>
                            <td class='table-danger'><h1>Nessun <b>nome</b> trovato!</h1></td>
                            <td class='table-danger'><h1>Nessun <b>cognome</b> trovato!</h1></td>
                            <td class='table-danger'><h1>Nessun <b>ruolo</b> trovato!</h1></td>
                          ";
                          echo "</tr>";
                        } else {
                          foreach($Fetched_Array_Dipedente as $ro){
                            echo "<tr class='table-success'>";
                            echo "   
                              <td style='margin-top: 15px'><h1>$ro[0]</h1></td>
                              <td style='margin-top: 15px'><h1>$ro[1]</h1></td>
                              <td style='margin-top: 15px'><h1>$ro[2]</h1></td>
                              <td style='margin-top: 15px'><h1>$ro[3]</h1></td>
                          ";
                          echo "</tr>";
                          }
                        }

                      } else {
                        foreach ($fetch as $row) {
                          for($i = 0; $i < $rows_dipendenti; $i++){
                            echo "<tr class='box-dipendenti-data border' style='margin-top:10px;'>";
                          }
                          echo "   
                            <td style='margin-top: 15px !important'><h1>$row[0]</h1></td>
                            <td style='margin-top: 15px !important'><h1>$row[1]</h1></td>
                            <td style='margin-top: 15px !important'><h1>$row[2]</h1></td>
                            <td style='margin-top: 15px !important'><h1>$row[3]</h1></td>
                        ";
                        for($i = 0; $i < $rows_dipendenti; $i++){
                          echo "</tr>";
                        }
                        }
                      }       
                ?>
                </tbody>
            </table>

            <br>
            <div class="line"></div>

            <div class="container-section-update-data-dipendenti">
                <div class="box-add-dipendenti">
                    <br>
                    <h2 style="font-weight: 700; text-align: center;">Aggiungi dipendente</h2>
                    <br>
                    <form action="dipendenti.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="nome-prodotto"
                                name="Nome_Dipendente">
                            <label for="floatingInput">Nome Dipendente</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="prezzo-prodotto"
                                name="Cognome_Dipendente">
                            <label for="floatingInput">Cognome Dipendente</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="prezzo-prodotto"
                                name="Ruolo_Dipendente">
                            <label for="floatingInput">Ruolo Dipendente</label>
                        </div>

                        <br>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type='submit' class='btn btn-success justify-center'
                                name='Aggiungi_Dipendente_bottone'>Aggiungi <img width="40" height="40"
                                    src="https://img.icons8.com/ios-filled/50/plus-2-math.png"
                                    alt="plus-2-math" /></button>
                        </div>

                    </form>
                </div>

                <div class="box-modify-dipendenti">
                    <form action="dipendenti.php" method="post">
                        <h2 style="font-weight: 700; text-align: center;">Modifica Dipendente</h2>
                        <br>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                name="Id_Dipendente" required>
                            <label for="floatingPassword">Id Dipendente</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                name="Nome_Dipendente" required>
                            <label for="floatingPassword">Aggiungi il nuovo nome del dipendente</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                name="Cognome_Dipendente" required>
                            <label for="floatingPassword">Aggiungi il nuovo cognome del dipendente</label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                name="Ruolo_Dipendente" required>
                            <label for="floatingPassword">Aggiungi il nuovo ruolo del dipendente</label>
                        </div>
                        <br>

                        <div style="margin-top: 12px;"></div>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type='submit' class='btn btn-secondary justify-center'
                                name='Modifica_Dipendente_bottone'>Modifica <img width="40" height="40"
                                    src="https://img.icons8.com/external-becris-lineal-becris/64/external-edit-mintab-for-ios-becris-lineal-becris.png"
                                    alt="external-edit-mintab-for-ios-becris-lineal-becris" /></button>
                        </div>

                    </form>
                </div>

                <div class="box-delete-dipendenti">
                    <form action="dipendenti.php" method="post">
                        <h2 style="font-weight: 700; text-align: center;">Elimina Dipendente</h2>
                        <br>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                name="Id_Dipendente" required>
                            <label for="floatingPassword">Id Dipendente</label>
                        </div>
                        <br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type='submit' class='btn btn-danger justify-center'
                                name='Elimina_Dipendente_bottone'>Elimina <img width='40' height='40'
                                    src='https://img.icons8.com/sf-black-filled/64/delete-forever.png'
                                    alt='delete-forever'></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>