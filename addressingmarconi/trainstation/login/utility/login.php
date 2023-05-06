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

$email = $_POST['email'];
$password = $_POST['password'];



$q = $db->prepare("SELECT * FROM utente WHERE email = :email");
$q->bindParam(':email', $email, PDO::PARAM_STR);
$q->execute();
$q->setFetchMode(PDO::FETCH_ASSOC); // fetchiamo e passiamo a rassegna tutte le righe
$rows = $q->rowCount(); // contiamo righe
if ($rows > 0) { // utente esiste
    while ($row = $q->fetch()) {
        
        // Imposto nella sessione l'id utente
        $_SESSION["id_utente"] = $row["id_utente"];
        
        /*
         * Altri dettagli dell'utente puoi settarli come `$_SESSION["nome_attributo"] = $row["nome_colonna_tabella_utente"]`
         */
        
        if ($row['id_utente'] === '1' && $row['password'] === $password) {
            header("location: ../profilo/registrato.php");
            exit;
        } else if ($row['id_utente'] === '2' && $row['password'] === $password) {
            header("location: ../profilo/amministrativo.php");
            exit;
        } else if ($row['id_utente'] === '3' && $row['password'] === $password) {
            header("location: ../profilo/esercizio.php");
            exit;
        } else {
            header("location: ../error.php");
            exit;
        }
    }
} else {
    echo "utente non presente in archivio";
}
?>
