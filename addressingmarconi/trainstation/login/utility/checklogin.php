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
    LOGIN 
    -------------------------------*/
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];




    $q = $db->prepare("SELECT * FROM utente WHERE email = :email");
    $q->bindParam(':email', $email, PDO::PARAM_STR);
    $q->execute();
    $q->setFetchMode(PDO::FETCH_ASSOC); // fetchiamo e passiamo a rassegna tutte le righe
    $rows = $q->rowCount(); // contiamo righe

    if ($rows > 0) { // utente esiste
        while ($row = $q->fetch()) {
        
            $_SESSION["nome"] = $row["nome"];
            $_SESSION["cognome"] = $row["cognome"];

            if ($row['ruolo'] === 'registrato' && $row['password'] === $password) {
                header("location: ../profilo/registrato.php");
                exit;

            } else if ($row['ruolo'] === 'amministrativo' && $row['password'] === $password) {
                header("location: ../profilo/amministrativo.php");
                exit;

            } else if ($row['ruolo'] === 'esercizio' && $row['password'] === $password) {
                header("location: ../profilo/esercizio.php");
                exit;

            } else {
                header("location: ../error.php");
                exit;
        }
    }

    } else {
        echo "Utente non trovato";

    }

?>
