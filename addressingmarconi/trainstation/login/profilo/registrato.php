<!DOCTYPE html>
<html>
<head>
	<title>TrainStation</title>
    <link rel="stylesheet" type="text/css" href="./registrato.css">
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
  }
  ?>

	<header>
    
		<div class="logo">TrainStation</div>
		<nav>
			<ul>
				<li><a href="../out.php">logout</a></li>
        </ul>
		</nav>
	</header>
    <?php
    session_start();
    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
    $cognome = isset($_SESSION['cognome']) ? $_SESSION['cognome'] : '';
    ?>
  <h1>Benvenuto <?php echo $nome . ' ' . $cognome; ?></h1>
    <form>
  <div class="form-group">
    <label for="departure">Stazione di partenza</label>
    <?php 
           $sql = "SELECT * FROM stazione";
           $result = $db->query($sql);
       
           // controllare se sono state restituite postazioni di lavoro
           if ($result->rowCount() > 0) {
             // creare un modulo con menu a tendina per postazione di lavoro, selezione origine/destinazione e andata e ritorno
             echo '<form method="POST">';
       
             echo '<select name="workstation">';
             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
               echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
             }
             echo '</select>';
            }
        ?>
  </div>
  <div class="form-group">
    <label for="destination">Stazione di destinazione</label>
    <?php 
           $sql = "SELECT * FROM stazione";
           $result = $db->query($sql);
       
           // controllare se sono state restituite postazioni di lavoro
           if ($result->rowCount() > 0) {
             // creare un modulo con menu a tendina per postazione di lavoro, selezione origine/destinazione e andata e ritorno
             echo '<form method="POST">';
       
             echo '<select name="workstation">';
             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
               echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
             }
             echo '</select>';
            }
        ?>
  </div>
  <div class="form-group">
    <label for="depart-date">Data di partenza</label>
    <input type="date" id="depart-date" name="depart-date" required>
  </div>
  <div class="form-group">
    <label for="return-date">Data di ritorno</label>
    <input type="date" id="return-date" name="return-date" required>
  </div>
  <button type="submit">Cerca treni</button>
</form>
          
<div class="card">
  <div class="card-image">
  </div>
  <div class="card-content">
    <h2 class="card-title">Prenota i tuoi biglietti online</h2>
    <p class="card-description">Scegli il tuo evento preferito e prenota i tuoi biglietti comodamente da casa. Risparmia tempo e non perdere l'occasione di assistere al tuo evento preferito.</p>
    <a href="#" class="btn btn-primary">Prenota ora</a>
  </div>
</div>



</body>
</html>


