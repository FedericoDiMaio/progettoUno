<!DOCTYPE html>
<html>

<head>
    <title>TrainStation Marconi</title>
    <link rel="stylesheet" type="text/css" href="./landingview.css">
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

      <div class="logo">TrainStation marconi </div>
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

    <?php

        // Esegui la query per ottenere i valori desiderati
        $sql = "SELECT * FROM treno";
        $result = $db->query($sql);
        if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            echo '<div class="card">';
            echo '<div class="card-content">';
            // Mostra i valori ottenuti nel codice HTML
            echo '<div class="card-title-container">';
            echo '<h2 class="card-title">treno: ' . $row['id_treno'] .'</h2>';
            echo '<h2 class="card-title">locomotiva: ' . $row['nome_locomotiva'] .'</h2>';
            echo '<h2 class="card-title">carrozza: ' . $row['nome_carrozza'] .'</h2>';
            echo '</div>';
            echo '<p class="card-description"></p>';
            echo '<p class="card-description"></p>';
            echo '<a href="#" class="btn btn-primary">modifica</a>';
            echo '</div>';
            echo '</div>';
            }
        }
    ?>

</body>

</html>