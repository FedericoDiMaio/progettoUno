<?php

/*------------------------------
CONNESIONE PDO
-------------------------------*/

$servername="localhost";
$username="root";
$password="";
$dbname="progettouno";

try{
    $db = new PDO("mysql:=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    print "ERRORE!: ". $e->getMessage() . "<br>";
    die();
}

/*------------------------------
LOGIN 
-------------------------------*/

$email = $_POST['email'];
$password = $_POST['password'];



$q = $db->prepare("SELECT * FROM utente WHERE email = :email");
$q->bindParam(':email', $email, PDO::PARAM_STR);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC); // fetchiamo e passiamo a rassegna tutte le righe
$rows = $q->rowCount(); // contiamo righe
if ($rows > 0) { // utente esiste
    while ($row = $q->fetch()) {
        if ($row['id'] === '1') {
            header("location: ../../../profilo/registrato.php");
            exit;
        } else if ($row['id'] === '2') {
            header("location: ../profilo/amministrativo.php");
            exit;
        }else if ($row['id'] === '3') {
            header("location: ../profilo/esercizio.php");
            exit;
        } else if ($row['password'] === $password) {
            session_start();
            $_SESSION['id'] = $row['id'];
            header("location: ../profilo/registrato.php");
            exit;
        } else {
            header("location: ../login/error.php");
            exit;
        }
    }
} else {
    echo "utente non presente in archivio";
}
?>