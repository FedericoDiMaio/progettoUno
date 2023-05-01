<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css">
  <title>Document</title>

</head>

<body>

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

  // verificare se il modulo è stato inviato
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // recuperare la postazione di lavoro selezionata, la direzione e il viaggio di andata e ritorno dai dati POST
    $selected_workstation = isset($_POST['workstation']) ? intval($_POST['workstation']) : null;
    $selected_direction = isset($_POST['direction']) ? $_POST['direction'] : null;
    $round_trip = isset($_POST['round_trip']) && $_POST['round_trip'] == 'yes';

    // validare i dati inviati
    if (empty($selected_workstation) || empty($selected_direction)) {
      echo 'Please select a workstation and a direction';
      exit;
    }

    // eseguire la query per recuperare i dati della postazione di lavoro selezionata
    $sql = "SELECT * FROM stazione WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $selected_workstation, PDO::PARAM_INT);
    $stmt->execute();

    // recuperare i dati della postazione di lavoro selezionata
    $workstation_data = $stmt->fetch(PDO::FETCH_ASSOC);

    // calcolare i km percorsi
    $km_traveled = $selected_direction == 'origin'
      ? $workstation_data['km_origine']
      : $workstation_data['km_destinazione'];

    if ($round_trip) {
      $km_traveled *= 2;
    }


    // visualizzare i dati
    echo 'Selected workstation: ' . htmlspecialchars($workstation_data['nome_stazione']) . '<br>';
    echo 'Selected direction: ' . htmlspecialchars($selected_direction) . '<br>';
    echo 'Round trip: ' . ($round_trip ? 'Yes' : 'No') . '<br>';
    echo 'Km traveled: ' . $km_stazione;

  } else {

    // il modulo non è stato inviato, visualizzalo
    // esegue una query per recuperare tutte le workstation
    $sql = "SELECT * FROM stazione";
    $result = $db->query($sql);
  }
  // controllare se sono state restituite postazioni di lavoro
  if ($result->rowCount() > 0) {
    // creare un modulo con menu a tendina per postazione di lavoro, selezione origine/destinazione e andata e ritorno
    echo '<form method="POST">';

    // menu a discesa per la selezione della postazione di lavoro
    echo '<label for="workstation">Select workstation:</label>';
    echo '<select name="workstation">';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
    }
    echo '</select>';

    // menu a discesa per la selezione dell'origine/destinazione
    echo '<label for="direction">Select direction:</label>';
    echo '<select name="direction">';
    echo '<option value="origin">Origin</option>';
    echo '<option value="destination">Destination</option>';
    echo '</select>';
    echo '<br>';


    // eseguire query per recuperare tutte le workstation
    $sql = "SELECT * FROM stazione";
    $result = $db->query($sql);

    // controllare se sono state restituite postazioni di lavoro
    if ($result->rowCount() > 0) {
      // creare un modulo con menu a tendina per postazione di lavoro, selezione origine/destinazione e andata e ritorno
      echo '<form method="POST">';

      // menu a discesa per la selezione della postazione di lavoro
      echo '<label for="workstation">Select workstation:</label>';
      echo '<select name="workstation">';
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
      }
      echo '</select>';

      // menu a discesa per la selezione dell'origine/destinazione
      echo '<label for="direction">Select direction:</label>';
      echo '<select name="direction">';
      echo '<option value="origin">Origin</option>';
      echo '<option value="destination">Destination</option>';
      echo '</select>';
      echo '<br>';

      // casella di controllo per il viaggio di andata e ritorno
      echo '<label for="round_trip">Round trip:</label>';
      echo '<input type="checkbox" name="round_trip" value="yes">';

      echo '<input type="submit" value="Submit">';
      echo '</form>';

    } else {
      echo "0 results";
    }
  }
  ?>
</body>

</html>