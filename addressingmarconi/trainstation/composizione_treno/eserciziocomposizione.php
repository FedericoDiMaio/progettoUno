<!DOCTYPE html>
<html>

    <head>
      <title>TrainStation profilo esercizio</title>
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
        
        $nome = isset($_SESSION["nome"]) ? $_SESSION["nome"] : '';
        $cognome = isset($_SESSION["cognome"]) ? $_SESSION["cognome"] : '';

        
      ?>

    <header>

        <div>
            <link rel="stylesheet" type="text/css" href="./eserciziocomposizione.css">
        </div>

        <div class="logo">backoffice di esercizio</div>

        <nav>
            <ul>
                <li><a href="../../trainstation/login/out.php">logout</a></li>
            </ul>
        </nav>

        <nav>
            <ul>
                <li><a href="../../trainstation/login/profilo/esercizio.php">componi</a></li>
            </ul>
        </nav>

    </header>

    <h1>Benvenuto <?php echo $nome . ' ' . $cognome; ?></h1>
    <h3>i treni disponibili nei giorni feriali sono : </h3>

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