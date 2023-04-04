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



//query
$q = $db->prepare("SELECT * FROM utente WHERE email = '$email'");
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC);   //fetchiamo e passiamo a rassegna tutte le righe
$rows = $q->rowCount();               //contiamo righe
if($rows>0){                          //utente esiste
    while ($rows=$q->fetch()){
        if($rows['password']===$password){
            session_start();
            $_SESSION['id'] = $rows['id'];
            header("location: ../welcome.php");
        }else{
            header("location: ../error.php");
        }
    }
}else{
    echo "utente non presente in archivio";
}



?>