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
REGISTRAZIONE UTENTE DA PAGINA DI REGISTRAZIONE
-------------------------------*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data_di_nascita = $_POST['data_di_nascita'];
    $residenza = $_POST['residenza'];
    $telefono = $_POST['telefono'];

    if (!empty($data_di_nascita)) {
        if (!validateDate($data_di_nascita)) {
            header("location: ../../login/errordata.php");
            exit();
        }
    } else {
        echo "<p>Il campo della data di nascita è obbligatorio</p>";
        exit();
    }

    $query = $db->prepare("INSERT INTO utente (nome, cognome, email, password, data_di_nascita, residenza, telefono) VALUES (:nome, :cognome, :email, :password, :data_di_nascita, :residenza, :telefono)");
    $query->bindParam(':nome', $nome, PDO::PARAM_STR);
    $query->bindParam(':cognome', $cognome, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':data_di_nascita', $data_di_nascita, PDO::PARAM_STR);
    $query->bindParam(':residenza', $residenza, PDO::PARAM_STR);
    $query->bindParam(':telefono', $telefono, PDO::PARAM_STR);

    try {
        $query->execute();
        header("location: ../../registrazione/registrazione-succ.php");
        exit();
    } catch (PDOException $e) {
        header("location: ../../registrazione/registrazione-err.php");
        exit();
    }
}

function validateDate($data) {
    $patternData = "/^\d{4}-\d{2}-\d{2}$/";
    return preg_match($patternData, $data) && strtotime($data);
}
?>
