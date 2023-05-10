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
    $nome_locomotiva = $_POST['nome_locomotiva'];
    
    $query = $db->prepare("INSERT INTO treno (nome_carrozza, nome_locomotiva) VALUES ( :nome_carrozza, :nome_locomotiva)");
    $query->bindParam(':nome_carrozza', $nome_carrozza, PDO::PARAM_STR);
    $query->bindParam(':nome_locomotiva', $nome_locomotiva, PDO::PARAM_STR);
    
    
    try {
        $query->execute();
        header("location: ../../composizione_treno/eserciziocomposizione.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    
}

?>
