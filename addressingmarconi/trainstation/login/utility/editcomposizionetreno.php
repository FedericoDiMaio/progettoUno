<?php

session_start();

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

$nome = isset($_SESSION["nome"]) ? $_SESSION["nome"] : '';
$cognome = isset($_SESSION["cognome"]) ? $_SESSION["cognome"] : '';


?>
