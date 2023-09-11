<?php

include "utility/connection.php";
include "utility/function.php";

session_start();

$lenght_ID_Prodotto = 0;

if(isset($_SESSION['Id_Admin'])){
    $sql = "SELECT * FROM prodotti";
    $result = $con->query($sql);
    $fetch = mysqli_fetch_all($result);

    //Query per contare i prodotti e mostrare quanti ce ne sono
    $sql_count_Prodotti = "SELECT ID_Prodotto FROM prodotti";
    $result_count_Prodotti = $con->query($sql_count_Prodotti);
    $Rows_Prodotti = $result_count_Prodotti->num_rows;
    
    //Query per contare le categorie e mostrare quanti ce ne sono
    $sql_count_Categorie = "SELECT Nome_Categoria FROM categoria";
    $result_count_Categorie = $con->query($sql_count_Categorie);
    $Rows_Categorie = $result_count_Categorie->num_rows;

    if(isset($_POST['Id_Prodotto']) && isset($_POST['Cerca_Prodotto'])){
      $ID_Prodotto = $_POST['Id_Prodotto'];
      $lenght_ID_Prodotto = strlen($ID_Prodotto);
      
    
      $sql_search_product = "SELECT * FROM prodotti WHERE ID_Prodotto = '$ID_Prodotto'";
      $result_product = $con->query($sql_search_product);
      $Fetched_result_product = mysqli_fetch_all($result_product);
      $rows_product_result = $result_product->num_rows;
  }

// controllo id e cose del genere


                    if(isset($_POST['Cerca_Prodotto'])){
                      if($lenght_ID_Prodotto <= 3){
                        if($rows_product_result > 0){
                          echo "
                          <div class='position-error  animate-error'>
                            <div class='alert alert-success' role='success'>
                              <h3>Prodotto trovato</h3>
                            </div>    
                          </div>
                          ";
                          header("Refresh: 10");
                        } else {
                          echo "
                          <div class='position-error  animate-error'>
                            <div class='alert alert-danger' role='alert'>
                              <h3>Nessun Prodotto trovato!</h3>
                            </div>    
                          </div>
                          ";
                          header("Refresh: 5");
                        }
                      } else if($lenght_ID_Prodotto != 3){
                        echo "
                        <div class='position-error  animate-error'>
                            <div class='alert alert-danger' role='alert'>
                              <h4>Id non valido</h4>
                            </div>    
                        </div>
                        ";
                        header("Refresh:5");
                       }
                     } 
  
  //ELimina prodotto////////////////////////////////////////////////////////////////
  if(isset($_POST['Elimina_bottone'])){

    if(isset($_POST['Id_Prodotto'])){

      $data = array(
        'id_P' => $_POST['Id_Prodotto']
      );

      echo Request_POST('delete_product.php' , $data);
      if(Request_POST('delete_product.php' , $data)){
        header("Refresh:3");
      }
    }
  }

  if(isset($_POST['Aggiungi_bottone'])){

      $categoriaSelezionata = $_POST['selected_category'];
    
      $categoriaSelezionata;

      $id = rand(0 , 999);
      
      $sql_check_same_id = "SELECT ID_Prodotto FROM prodotti WHERE ID_Prodotto = $id";
      $result_check_same_id =  $con->query($sql_check_same_id);
      $rows_check_id = $result_check_same_id->num_rows;
      
      if($rows_check_id == 0){
        
        $data = array(
          'Id_Prodotto' => $id,
          'Nome_prodotto' => $_POST['Nome_prodotto'],
          'Categoria' => $categoriaSelezionata,
          'Prezzo' => $_POST['Prezzo_prodotto']
        );
  
        echo Request_POST('insert_product.php' , $data);
        if(Request_POST('insert_product.php' , $data)){
          header("Refresh:3");
        }
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


    if(isset($_POST['Modifica_bottone'])){
      if(isset($_POST['Id_Prodotto']) && isset($_POST['Nome_Prodotto']) && isset($_POST['selected_category']) && isset($_POST['Prezzo_Prodotto'])){

        $categoriaSelezionata = $_POST['selected_category'];
        $id_update = $_POST['Id_Prodotto'];
        $nome_prodotto = $_POST['Nome_Prodotto'];

        $data = array(
          'Id_Prodotto' => $id_update,
          'Nome_prodotto' => $nome_prodotto,
          'Categoria' => $categoriaSelezionata,
          'Prezzo' => $_POST['Prezzo_Prodotto']
        );

        echo Request_POST('modify_product.php' , $data);
        if(Request_POST('modify_product.php' , $data)){
          header("Refresh:3");
        }
      }
    }

    if(isset($_POST['Elimina_Categoria_bottone'])){
      
        $categoriaSelezionata = $_POST['selected_category'];

        $data = array(
          'cat' => $categoriaSelezionata
        );

        echo Request_POST('delete_category.php' , $data);
        header("Refresh:3");
        
      } 
    


    if(isset($_POST['Inserisci_Categoria_bottone'])){
      if(isset($_POST['Nome_Categoria'])){
        $nome_categoria = $_POST['Nome_Categoria'];

        $data = array(
          'Nome_Categoria' => $nome_categoria
        );

        echo Request_POST('insert_category.php' , $data);
        header("Refresh:3");
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
    <title>Prodotti</title>
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
        <div class="container-prodotti">


            <h1 style="margin-top: 30px; font-weight: 700; text-align: center; font-size: 60px;">Prodotti</h1>

            <div class="container">
                <div class="intro-prodotti">
                    <div class="box-ip1">
                        <img width="64" height="64" src="https://img.icons8.com/pastel-glyph/64/shopping-cart--v2.png"
                            alt="shopping-cart--v2" />
                        <h1>Prodotti</h1>
                        <h1><?php echo $Rows_Prodotti?></h1>
                    </div>
                    <div class="box-ip2">
                        <img width="64" height="64" src="https://img.icons8.com/ios-filled/50/price-tag.png"
                            alt="price-tag" />
                        <h1>Categorie</h1>
                        <h1><?php echo $Rows_Categorie?></h1>
                    </div>
                </div>
            </div>

            <div class="mostra-prodotti" style="margin-top: 60px;">
                <h1 style="margin-top: 0px; font-weight: 700; text-align: center; font-size: 50px;">Cerca prodotto</h1>
                <br>
                <form action="prodotti.php" method="POST" class="d-flex justify-content-center" role="search"
                    style="margin-top: 30px; margin-bottom: 25px; padding: 25px !important;">
                    <input class="form-control form-select-lg me-2" type="search" placeholder="Search By Id Prodotto"
                        aria-label="Search" name="Id_Prodotto" required>
                    <button class="btn btn-success" type="submit" name="Cerca_Prodotto">Search</button>
                </form>

                <div class="container-table-data">
                    <table class="table table-hover" style='text-align:center;'>
                        <thead>
                            <tr class='box-prodotti-data'>
                                <th>
                                    <h1>Id</h1>
                                </th>
                                <th>
                                    <h1>Nome</h1>
                                </th>
                                <th>
                                    <h1>Categoria</h1>
                                </th>
                                <th>
                                    <h1>Prezzo</h1>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            <?php
                      
                      
                      if(isset($_POST['Cerca_Prodotto'])){
                        foreach($Fetched_result_product as $ro){
                          echo "<tr class='table-success'>";
                          echo "   
                            <td style='margin-top: 15px'><h1>$ro[0]</h1></td>
                            <td style='margin-top: 15px'><h1>$ro[1]</h1></td>
                            <td style='margin-top: 15px'><h1>$ro[2]</h1></td>
                            <td style='margin-top: 15px'><h1>$ro[3]€</h1></td>
                        ";
                        echo "</tr>";
                        }
                      } else {
                        
                        
                          foreach ($fetch as $row) {
                            for($i = 0; $i < $Rows_Prodotti; $i++){
                              echo "<tr class='box-prodotti-data border' style='margin-top:10px;'>";
                            }
                            echo "   
                              <td style='margin-top: 15px'><h1>$row[0]</h1></td>
                              <td style='margin-top: 15px'><h1>$row[1]</h1></td>
                              <td style='margin-top: 15px'><h1>$row[2]</h1></td>
                              <td style='margin-top: 15px'><h1>$row[3]€</h1></td>
                          ";
                          for($i = 0; $i < $Rows_Prodotti; $i++){
                            echo "</tr>";
                          }
                          }
                      }
                      ?>
                        </tbody>
                    </table>
                </div>
            </div>






            <div class="gestisci-prodotti">

                <h1 style="margin-top: 0px; font-weight: 700; text-align: center; font-size: 50px;">Gestisci prodotto
                </h1>
                <br>
                <div class="container-box-gestisci-prodotti">

                    <div class="box-add">
                        <br>
                        <h2 style="font-weight: 700; text-align: center;">Aggiungi prodotto</h2>
                        <br>
                        <form action="prodotti.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="nome-prodotto"
                                    name="Nome_prodotto">
                                <label for="floatingInput">Nome Prodotto</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="prezzo-prodotto"
                                    name="Prezzo_prodotto">
                                <label for="floatingInput">Prezzo Prodotto</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="selected_category">
                                    <option selected>Categoria</option>
                                    <?php
                  
                          $sql_category = "SELECT * FROM categoria";
                          $result_sql_category = $con->query($sql_category);
                          $fetched_sql_category = mysqli_fetch_all($result_sql_category);
                          foreach($fetched_sql_category as $o ){
                            $selected = '';
                            if (in_array($o[0], $categoriaSelezionata)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[0] . "' $selected>" . $o[0] . "</option>";
                          }
                        ?>
                                </select>
                                <label for="floatingSelect">Scegliere la categoria del prodotto</label>
                            </div>

                            <br>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type='submit' class='btn btn-success justify-center'
                                    name='Aggiungi_bottone'>Aggiungi <img width="40" height="40"
                                        src="https://img.icons8.com/ios-filled/50/plus-2-math.png"
                                        alt="plus-2-math" /></button>
                            </div>

                        </form>

                    </div>

                    <div class="box-modify">
                        <!--BOX MODIFY-->

                        <form action="prodotti.php" method="post">
                            <h2 style="font-weight: 700; text-align: center;">Modifica prodotto</h2>
                            <br>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                    name="Id_Prodotto" required>
                                <label for="floatingPassword">Id Prodotto da modificare</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                    name="Nome_Prodotto" required>
                                <label for="floatingPassword">Aggiungi il nuovo nome del prodotto</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                    name="Prezzo_Prodotto" required>
                                <label for="floatingPassword">Aggiungi il nuovo prezzo del prodotto</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example" name="selected_category">
                                    <option selected>Categoria</option>
                                    <?php
                  
                          $sql_category = "SELECT * FROM categoria";
                          $result_sql_category = $con->query($sql_category);
                          $fetched_sql_category = mysqli_fetch_all($result_sql_category);
                          foreach($fetched_sql_category as $o ){
                            $selected = '';
                            if (in_array($o[0], $categoriaSelezionata)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[0] . "' $selected>" . $o[0] . "</option>";
                          }
                        ?>
                                </select>
                                <label for="floatingSelect">Scegliere la nuova categoria del prodotto</label>
                            </div>

                            <div style="margin-top: 12px;"></div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type='submit' class='btn btn-secondary justify-center'
                                    name='Modifica_bottone'>Modifica <img width="40" height="40"
                                        src="https://img.icons8.com/external-becris-lineal-becris/64/external-edit-mintab-for-ios-becris-lineal-becris.png"
                                        alt="external-edit-mintab-for-ios-becris-lineal-becris" /></button>
                            </div>

                        </form>

                    </div>

                    <div class="box-delete">
                        <br>
                        <form action="prodotti.php" method="post">
                            <h2 style="font-weight: 700; text-align: center;">Elimina prodotto</h2>
                            <br>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                    name="Id_Prodotto" required>
                                <label for="floatingPassword">Id Prodotto</label>
                            </div>
                            <br>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type='submit' class='btn btn-danger justify-center'
                                    name='Elimina_bottone'>Elimina <img width='40' height='40'
                                        src='https://img.icons8.com/sf-black-filled/64/delete-forever.png'
                                        alt='delete-forever'></button>
                            </div>
                        </form>

                    </div>
                    <div class="box-modify-category">
                        <h2 style="font-weight: 700; text-align: center;">Gestisci Categorie</h2>
                        <div class="container-modify-category">

                            <div class="box-delete-category">
                                <form action="prodotti.php" method="post">
                                    <h2 style="font-weight: 700; text-align: center;">Elimina Categoria</h2>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect"
                                            aria-label="Floating label select example" name="selected_category">
                                            <option selected>Categoria</option>
                                            <?php
                  
                          $sql_category = "SELECT * FROM categoria";
                          $result_sql_category = $con->query($sql_category);
                          $fetched_sql_category = mysqli_fetch_all($result_sql_category);
                          foreach($fetched_sql_category as $o ){
                            $selected = '';
                            if (in_array($o[0], $categoriaSelezionata)) {
                              $selected = 'selected';
                            }
                            echo "<option value='" . $o[0] . "' $selected>" . $o[0] . "</option>";
                          }
                        ?>
                                        </select>
                                        <label for="floatingSelect">Elimina Cat</label>
                                    </div>
                                    <div style="margin-top: 10px;"></div>
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button type='submit' class='btn btn-danger justify-center'
                                            name='Elimina_Categoria_bottone'>Elimina</button>
                                    </div>
                                </form>
                            </div>

                            <div class="box-insert-category">
                                <form action="prodotti.php" method="post">
                                    <h2 style="font-weight: 700; text-align: center;">Inserisci Categoria</h2>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="ID"
                                            name="Nome_Categoria" required>
                                        <label for="floatingPassword">Nome Categoria</label>
                                    </div>
                                    <div style="margin-top: 10px;"></div>
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button type='submit' class='btn btn-success justify-center'
                                            name='Inserisci_Categoria_bottone'>Aggiungi</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>