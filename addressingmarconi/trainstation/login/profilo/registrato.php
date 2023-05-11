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
    session_start();

    // verificare se il modulo è stato inviato
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  

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
      
      if(isset($_SESSION["nome"])){
        echo '<h1>Benvenuto ' . htmlspecialchars($_SESSION["nome"]) . ' ' . htmlspecialchars($_SESSION["cognome"]) . '</h1>';
      }
      else{
        echo '<h1>Benvenuto</h1>';
      }
    
    ?>

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

    <?php
    $sql = "SELECT * FROM treno";
    $result = $db->query($sql);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card">';
            echo '<div class="card-image"></div>';
            echo '<div class="card-content">';
            echo '<div class="card-title-container">';
            echo '<div class="card-value">';
            echo '<h2 class="card-title">Treno:</h2>';
            echo '<p>' . $row['id_treno'] .'</p>';
            echo '</div>';
            echo '<div class="card-value">';
            echo '<h2 class="card-title">Locomotiva:</h2>';
            echo '<p>' . $row['nome_locomotiva'] .'</p>';
            echo '</div>';
            echo '<div class="card-value">';
            echo '<h2 class="card-title">Carrozza:</h2>';
            echo '<p>' . $row['nome_carrozza'] .'</p>';
            echo '</div>';
            echo '</div>';
            echo '<h2 class="card-title">Prenota i tuoi biglietti online</h2>';
            
            echo '<a href="#" class="btn btn-primary">Prenota ora</a>';
            echo '</div>';
            echo '</div>';
        }
    }
?>



  </body>

</html>