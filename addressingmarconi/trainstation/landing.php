<!DOCTYPE html>
<html>

<head>
    <title>TrainStation Marconi</title>
    <link rel="stylesheet" type="text/css" href="./landing.css">
</head>

<body>

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

    
  ?>

    <header>

      <div class="logo">TrainStation Marconi </div>
        <nav>
            <ul>

              <li><a href="./login/login.php">login</a></li>
              <li><a href="./registrazione/registrazione.php">signup</a></li>
            
            </ul>
        </nav>

    </header>

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

        <nav>
            <ul>
                <li><a href="../trainstation/landingview.php">Cerca treni</a></li>
            </ul>
        </nav>

    </form>

</body>
</html>