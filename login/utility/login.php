<?php

/*------------------------------
CONNESIONE PDO
-------------------------------*/

$servername="localhost";
$username="root";
$password="";
$dbname="progettoUno"

try{
    $db = new PDO("mysql:=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "ERRORE!: ". $e->getMessage() . "<br>";
    die();
}

/*------------------------------
LOGIN
-------------------------------*/

$email = $_POST['email'];
$password = $_POST['password'];

//query
$q = $db->prepare("SELECT * FROM utenti WHERE email = '$email'");
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);   //fetchiamo e passiamo a rassegna tutte le righe
$rows = $q->rowCount();               //contiamo righe
if($row>0){                           //utente esiste
    while ($row=$q->fetch()){
        if($row['password']===$password){
            echo "LOGIN CORRETTO"
        }else{
            echo "PASSWORD ERRATA"
        }
        echo "utente trovato in archivio";

    }
}else{
    echo "utente non trovato in archivio";
}

?>