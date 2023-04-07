<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

/*
session_start();
$sessionid = $_SESSION['id'];
echo $sessionid;

if($sessionid ==""){
    header('location: error.php');
}
*/
/*------------------------------
CONNESIONE PDO
-------------------------------*/


$servername="localhost";
$username="root";
$password="";
$dbname="progettouno";

try{
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    print "ERRORE!: ". $e->getMessage() . "<br>";
    die();
}

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // retrieve selected workstation, direction and round trip from POST data
  $selected_workstation = isset($_POST['workstation']) ? intval($_POST['workstation']) : null;
  $selected_direction = isset($_POST['direction']) ? $_POST['direction'] : null;
  $round_trip = isset($_POST['round_trip']) && $_POST['round_trip'] == 'yes';

  // validate input
  if (empty($selected_workstation) || empty($selected_direction)) {
    echo 'Please select a workstation and direction.';
    exit;
  }

  // perform query to retrieve information about selected workstation
  $sql = "SELECT * FROM stazione WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $selected_workstation, PDO::PARAM_INT);
  $stmt->execute();

  // retrieve results
  $workstation_data = $stmt->fetch(PDO::FETCH_ASSOC);

  // calculate km traveled based on direction and round trip
  $km_traveled = $selected_direction == 'origin'
    ? $workstation_data['km_origine']
    : $workstation_data['km_destinazione'];

  if ($round_trip) {
    $km_traveled *= 2;
  }

  // output selected workstation, direction, round trip and km traveled
  echo 'Selected workstation: ' . htmlspecialchars($workstation_data['nome_stazione']) . '<br>';
  echo 'Selected direction: ' . htmlspecialchars($selected_direction) . '<br>';
  echo 'Round trip: ' . ($round_trip ? 'Yes' : 'No') . '<br>';
  echo 'Km traveled: ' . $km_stazione;

} else {
  // form has not been submitted, display it
  // perform query to retrieve all workstations
  $sql = "SELECT * FROM stazione";
  $result = $db->query($sql);
}
  // check if any workstations were returned
  if ($result->rowCount() > 0) {
    // create a form with dropdown menus for workstation, origin/destination selection and round trip
    echo '<form method="POST">';

    // dropdown menu for workstation selection
    echo '<label for="workstation">Select workstation:</label>';
    echo '<select name="workstation">';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
    }
    echo '</select>';

    // dropdown menu for origin/destination selection
    echo '<label for="direction">Select direction:</label>';
    echo '<select name="direction">';
    echo '<option value="origin">Origin</option>';
    echo '<option value="destination">Destination</option>';
    echo '</select>';
    

   // perform query to retrieve all workstations
    $sql = "SELECT * FROM stazione";
    $result = $db->query($sql);

    // check if any workstations were returned
    if ($result->rowCount() > 0) {
    // create a form with dropdown menus for workstation, origin/destination selection and round trip
    echo '<form method="POST">';

    // dropdown menu for workstation selection
    echo '<label for="workstation">Select workstation:</label>';
    echo '<select name="workstation">';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
    }
    echo '</select>';

    

    // dropdown menu for origin/destination selection
    echo '<label for="direction">Select direction:</label>';
    echo '<select name="direction">';
    echo '<option value="origin">Origin</option>';
    echo '<option value="destination">Destination</option>';
    echo '</select>';

    // checkbox for round trip
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
    
    
    