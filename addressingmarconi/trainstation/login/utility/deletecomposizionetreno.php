<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "progettouno";

try {
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  print "ERRORE!: " . $e->getMessage() . "<br>";
  die();
}

$id_treno = $_POST['id_treno'];

// Verifica se è stato inviato un parametro per identificare la riga da cancellare
if (isset($_POST['id_treno'])) {
    $id_treno = $_POST['id_treno'];

    // Query per cancellare la riga
    $sql = "DELETE FROM treno WHERE id_treno = :id_treno";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_treno', $id_treno);

    if ($stmt->execute()) {
        echo "Riga cancellata con successo.";
    } else {
        echo "Errore durante la cancellazione della riga: " . $stmt->errorInfo()[2];
    }
}

// Chiudi la connessione al database
$db = null;
?>
    <nav>
        <ul>
        <li><a href="../../composizione_treno/eserciziocomposizione.php">visualizza treni</a></li>
        <li><a href="../../login/profilo/esercizio.php">componi treno</a></li>
        </ul>
    </nav>