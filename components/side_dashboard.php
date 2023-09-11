
    <div class="container-dashboard">
        <div style="text-align: center; position: relative; top: 25px; display: flex; flex-direction: column; ">
        <a href="my-info.php"><img src="images/icons8-utente-64.png"></a>
        <h1><?php echo $_SESSION['Id_Admin'];?></h1>
        </div>
        
        <br>

        <div class="section1" style="text-align: center;">
            <h3 class="animate-title">Gestione Generale</h3>
            
            <ul style="margin-right: 30px;">
                <li><a href="Analytics.php">Analitica</a></li>
                <li><a href="Prodotti.php">Prodotti</a></li>
                <li><a href="Magazzino.php">Magazzino</a></li>
                <li><a href="dipendenti.php">Dipendenti</a></li>
            </ul>
        </div>


        <div class="container-bottom-buttons">
            <div class="icon-something">
                <a href="dashboard.php"><img src="images/icons home/icons8-esterno-sf-black-filled-32.png"></a>
            </div>
            <div class="icon-home">
                <a href="my-info.php"><img width="32" height="32" src="https://img.icons8.com/material-sharp/48/user.png" alt="user"/></a>
            </div>
            <div class="icon-exit">
                
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-customized" name="submit">logout<img src="images/icons8-uscita-32.png" style="margin-left: 10px;"></a></button> 
                </form>
                 
            </div>
        </div>
       
    </div>
