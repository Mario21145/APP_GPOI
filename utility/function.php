<?php

function Request_POST($page , $data){
    
    // URL dell'API che fornisce i dati della tabella
    $url = "localhost/progetti/APP_GPOI/api/" . $page;
    // Metodo della richiesta (POST)

    // Inizializzazione della richiesta
    $ch = curl_init();

    // Impostazione dell'URL e di altre opzioni di cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Impostazione del metodo della richiesta
    curl_setopt($ch, CURLOPT_POST, true);

    //Impostazione dei valori della richiesta
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Esecuzione della richiesta
    $response = curl_exec($ch);

    // Controllo degli eventuali errori
    if (curl_errno($ch)) {
        return 'Errore nella richiesta: ' . curl_error($ch);
        exit;
    }
    // Chiusura della sessione cURL
    curl_close($ch);
    
    // Gestione della risposta
    if ($response) {
        return $response;
    }

            
    }


function Box_data_dipendenti($id ,$nome, $cognome , $ruolo){

    echo "
    <div class='container-dipendenti'>
        <div class='container'>
            <div class='box-dipendenti-data-result border'>
                <h2 style='font-weight: 700; text-align: center;'>Utente trovato</h2>
                <br>
                <div style='display: flex; flex-direction: row; justify-content: space-between;'>
                    <h2>Id->[$id]</h2>  <h2>Nome->[$nome]</h2> <h2>Cognome->[$cognome]</h2> <h2>Ruolo->[$ruolo]</h2>
                </div>
                
            </div>
        </div>
    </div>
    ";


}















?>