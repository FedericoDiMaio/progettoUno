<!DOCTYPE html>
<html>

    <head>
        <title>TrainStation Marconi</title>
        <link rel="stylesheet" type="text/css" href="./landing.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

      <div class="logo">TrainStation Marconi </div>
        <nav>
            <ul>

              <li><a href="./login/login.php">login</a></li>
              <li><a href="./registrazione/registrazione.php">signup</a></li>
            
            </ul>
        </nav>

    </header>

    

      <form action="./login/utility/checkdate.php" method="POST">

        <div class="form-group">
          <label for="departure">Stazione di partenza</label>

          <?php 
            $sql = "SELECT * FROM stazione";
            $result = $db->query($sql);
        
            // controllare se sono state restituite stazioni
            if ($result->rowCount() > 0) {
              // creare un modulo con menu a tendina per stazioni
              echo '<form method="POST">';
        
              echo '<select name="workstation" class="select-partenza">';
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
        
            // controllare se sono state restituite stzioni
            if ($result->rowCount() > 0) {
              // creare un modulo con menu a tendina per stazioni
              echo '<form method="POST">';
        
                echo '<select name="workstation" class="select-destinazione">';
              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . intval($row["id"]) . '">' . htmlspecialchars($row["nome_stazione"]) . '</option>';
              }
                echo '</select>';
            }
          ?>
          
        </div>

            <div class="form-group">
                <label for="depart-date">Data di partenza</label>
                <input type="date" id="depart-date" name="andata" required>
            </div>

            <div class="form-group">
                <label for="return-date">Data di ritorno</label>
                <input type="date" id="return-date" name="ritorno" required>
            </div>

            <div class="cerca-container">
                <button type="submit" class="btn btn-primary cerca-treni">Cerca treni</button>
            </div>

      </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </body>
</html>