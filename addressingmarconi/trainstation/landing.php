<!DOCTYPE html>
<html>
<head>
	<title>TrainStation</title>
    <link rel="stylesheet" type="text/css" href="./landing.css">
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
    ?>
	<header>
    
		<div class="logo">TrainStation</div>
		<nav>
			<ul>
				<li><a href="./login/index.php">login</a></li>
			</ul>
		</nav>
	</header>
    <form>
  <div class="form-group">
    <label for="departure">Stazione di partenza</label>
    <input type="text" id="departure" name="departure" required>
  </div>
  <div class="form-group">
    <label for="destination">Stazione di destinazione</label>
    <input type="text" id="destination" name="destination" required>
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

</body>
</html>

        
