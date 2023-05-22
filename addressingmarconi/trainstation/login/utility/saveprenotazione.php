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
    SALVA PRENOTAZIONE
    ------------------------------*/

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_prenotazione = $_POST['nome_prenotazione'];
    $cognome_prenotazione = $_POST['cognome_prenotazione'];
    $km_prenotazione = $_POST['km_prenotazione'];
    $id_prenotazione = $_POST['id_prenotazione'];
    $costo_prenotazione = $_POST['costo_prenotazione'];

    echo $nome_prenotazione;
    echo $cognome_prenotazione;
    echo $km_prenotazione;
    echo $id_prenotazione;
    echo $costo_prenotazione;


    $query = $db->prepare("INSERT INTO prenotazione (nome_prenotazione, cognome_prenotazione, km_prenotazione, id_prenotazione, costo_prenotazione) VALUES (:nome_prenotazione, :cognome_prenotazione, :km_prenotazione, :id_prenotazione, :costo_prenotazione)");

    $query->bindParam(":nome_prenotazione", $nome_prenotazione);
    $query->bindParam(":cognome_prenotazione", $cognome_prenotazione);
    $query->bindParam(":km_prenotazione", $km_prenotazione);
    $query->bindParam(":id_prenotazione", $id_prenotazione);
    $query->bindParam(":costo_prenotazione", $costo_prenotazione);


    try {
        $query->execute();
        header("location: ../../prenotazione/prenotazione.php");
        exit();
    } catch (PDOException $e) {
        header("location: ../../registrazione/registrazione-err.php");
        exit();
    }
    }

            
?>