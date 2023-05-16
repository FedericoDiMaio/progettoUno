<!DOCTYPE html>
<html>

  <head>
    <title>TrainStation Marconi</title>
    <link rel="stylesheet" type="text/css" href="./landingview.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>

    <body>

      <?php

        session_start();
        $andata=  isset($_SESSION["andata"]);
        $ritorno = isset($_SESSION["ritorno"]);
          
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
       
           // controllare se sono state restituite postazioni di lavoro
           if ($result->rowCount() > 0) {
             // creare un modulo con menu a tendina per postazione di lavoro, selezione origine/destinazione e andata e ritorno
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
            <input type="date" id="depart-date" name="depart-date" required>
        </div>

        <div class="form-group">
            <label for="return-date">Data di ritorno</label>
            <input type="date" id="return-date" name="return-date" required>
        </div>

        <div class="cerca-container">
            <a href="./landingview.php"><button type="button" class="btn btn-primary cerca-treni">Cerca treni</button><a>
        </div>

    </form>

    <div class="card-container">




  <?php
    $sql = "SELECT * FROM treno";
    $result = $db->query($sql);
    echo $andata;
    echo $ritorno;
            

    //  if ($result->rowCount() > 0) {

    //    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    //      if ($andata == $row['tipologia']) {
    //        echo '<div class="card">';    
    //        echo '<div class="card-body">';
    //        echo '<h5 class="card-title">locomotiva: ' . $row['nome_locomotiva'] .'</h5>';
    //        echo '<p class="card-text">carrozza: ' . $row['nome_carrozza'] .'</p>';
    //        echo '<p class="card-text">tipologia: ' . $row['tipologia'] .'</p>';
    //        echo '<p class="card-text">numero treno: ' . $row['id_treno'] .'</p>';
    //        echo '<a href="#" class="btn btn-primary prenota">prenota</a>';
    //        echo '</div>';
    //        echo '</div>';
    //      }else{
    //        echo "No";
    //      }
    //    }
    // }

  ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>