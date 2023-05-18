<?php

    /*------------------------------
    CONNESIONE PDO
    -------------------------------*/

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "progettouno";

    try {
        $db = new PDO("mysql:=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "ERRORE!: " . $e->getMessage() . "<br>";
        die();
    }

    /*------------------------------
    SALVA COMPOSIZIONE TRENO
    -------------------------------*/

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        

        $nome_carrozza = $_POST['nome_carrozza'];
        $nome_carrozza_uno = $_POST['nome_carrozza_uno'];
        $nome_carrozza_due = $_POST['nome_carrozza_due'];
        $nome_locomotiva = $_POST['nome_locomotiva'];
        $tipologia = isset($_POST['tipologia']) ? $_POST['tipologia'] : '';
        $check_date =  isHolidayOrWeekend($tipologia);
        
        

        
        $query = $db->prepare("INSERT INTO treno (nome_carrozza, nome_carrozza_uno, nome_carrozza_due, nome_locomotiva, tipologia) VALUES ( :nome_carrozza, :nome_carrozza_uno, :nome_carrozza_due, :nome_locomotiva, :check_date)");
        $query->bindParam(':nome_carrozza', $nome_carrozza, PDO::PARAM_STR);
        $query->bindParam(':nome_carrozza_uno', $nome_carrozza_uno, PDO::PARAM_STR);
        $query->bindParam(':nome_carrozza_due', $nome_carrozza_due, PDO::PARAM_STR);
        $query->bindParam(':nome_locomotiva', $nome_locomotiva, PDO::PARAM_STR);
        $query->bindParam(':check_date', $check_date, PDO::PARAM_STR);
        
        
        try {
            $query->execute();
            header("location: ../../composizione_treno/eserciziocomposizione.php");
            exit();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        
    }

    /*------------------------------------------------
    FUNZIONE DI CONTROLLO PER GIORNI FESTIVI O FERIALI 
    -------------------------------------------------*/

    function isHolidayOrWeekend($date) {
        // Array di date festive
        $holidays = array(
            "2023-01-01", # Capodanno
            "2023-01-06", # Epifania
            "2023-04-16", # Pasqua
            "2023-04-17", # Lunedì dell'Angelo
            "2023-04-25", # Festa della Liberazione
            "2023-05-01", # Festa del Lavoro
            "2023-06-02", # Festa della Repubblica
            "2023-08-15", # Ferragosto
            "2023-11-01", # Ognissanti
            "2023-12-08", # Immacolata Concezione
            "2023-12-25", # Natale
            "2023-12-26", # Santo Stefano
            "2024-01-01", # Capodanno
            "2024-01-06", # Epifania
            "2024-03-31", # Pasqua
            "2024-04-01", # Lunedì dell'Angelo
            "2024-04-25", # Festa della Liberazione
            "2024-05-01", # Festa del Lavoro
            "2024-06-02", # Festa della Repubblica
            "2024-08-15", # Ferragosto
            "2024-11-01", # Ognissanti
            "2024-12-08", # Immacolata Concezione
            "2024-12-25", # Natale
            "2024-12-26" # Santo Stefano
            
        );
    
          // Verifica se la data selezionata è un giorno festivo
    if (in_array($date, $holidays)) {
        return true;
    }

    // Verifica se la data selezionata è una domenica
    $dayOfWeek = date('N', strtotime($date));
    if ($dayOfWeek == 7) {
        return true; // Domenica
    }

    // Verifica se la data selezionata è un sabato (giorno feriale)
    if ($dayOfWeek == 6) {
        return false; // Sabato
    }

    // Restituisce false per i giorni feriali dal lunedì al venerdì
    return false;
}
    
?>
