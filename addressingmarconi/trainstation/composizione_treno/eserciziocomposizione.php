<!DOCTYPE html>
<html>

    <head>
      <title>TrainStation profilo esercizio</title>
      <link rel="stylesheet" type="text/css" href="./eserciziocomposizione.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
        <div class="logo">backoffice di esercizio</div>

        <nav>
            <ul>
                <li><a href="../../trainstation/login/out.php">logout</a></li>
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

            // Mostra i valori ottenuti nelle card
            echo '<div class="card">';    
            echo '<div class="card-body">';
            echo '<h5 class="card-title">locomotiva: ' . $row['nome_locomotiva'] .'</h5>';
            echo '<p class="card-text">carrozza: ' . $row['nome_carrozza'] .'</p>';
            echo '<p class="card-text">carrozza: ' . $row['nome_carrozza_uno'] .'</p>';
            echo '<p class="card-text">carrozza: ' . $row['nome_carrozza_due'] .'</p>';
            echo '<p class="card-text">tipologia: ' . $row['tipologia'] .'</p>';
            echo '<p class="card-text">numero treno: ' . $row['id_treno'] .'</p>';

            // form per modificare
            // echo '<form action="../login/utility/editcomposizionetreno.php" method="POST">';
            // echo '<input type="hidden" name="id_treno" value="' . $row['id_treno'] . '">';
            // echo '<button type="submit" class="btn btn-primary">Modifica</button>';
            // echo '</form>';

            // form per cancellare
            echo '<form action="../login/utility/deletecomposizionetreno.php" method="POST">';
            echo '<input type="hidden" name="id_treno" value="' . $row['id_treno'] . '">';
            echo '<button type="submit" class="btn btn-primary">cancella</button>';
            echo '</form>';
            
            echo '</div>';
            echo '</div>';
            }
          }
         
     
          
    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>