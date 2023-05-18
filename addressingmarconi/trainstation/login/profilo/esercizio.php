<!DOCTYPE html>
  <html>

      <head>
        <title>TrainStation profilo esercizio</title>
        <link rel="stylesheet" type="text/css" href="./esercizio.css">
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
          
          session_start();
          $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
          $cognome = isset($_SESSION['cognome']) ? $_SESSION['cognome'] : '';
          

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $nome_carrozza = isset($_POST['nome_carrozza']) ? ($_POST['nome_carrozza']) : null;
              $nome_locomotiva = isset($_POST['nome_locomotiva']) ? $_POST['nome_locomotiva'] : null;
              
            
              if (empty($nome_carrozza) || empty($nome_locomotiva)) {
                echo 'Please select carrozza, locomotiva ';
                exit;
              }
              
            }
        ?>



        
          <header>
            <div class="logo">backoffice di esercizio</div>

              <nav>
                <ul>
                  <li><a href="../out.php">logout</a></li>
                </ul>
              </nav>
          </header>

    

          <h1>Benvenuto <?php echo $nome . ' ' . $cognome; ?></h1>
          <h3>componi i convogli a partire dal materiale rotabile disponibile : </h3>

          <form action="../utility/savecomposizionetreno.php" method="POST">

              <div class="form-group">
                <label for="nome_locomotiva">locomotiva</label>

                <?php 
                    $sql = "SELECT * FROM locomotiva";
                    $result = $db->query($sql);
                    if ($result->rowCount() > 0) {
                      echo '<select name="nome_locomotiva">';
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . ($row["nome_locomotiva"]) . '">' . htmlspecialchars($row["nome_locomotiva"]) . '</option>';
                      }
                      echo '</select>';
                    }
                ?>

              </div>

              <div class="form-group">
              <label for="nome_carrozza">carrozza</label>
            
                <?php 
                    $sql = "SELECT * FROM carrozza";
                    $result = $db->query($sql);

                    if ($result->rowCount() > 0) {

                        echo '<form method="POST">';
                        echo '<select name="nome_carrozza">';

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                          echo '<option value="' . ($row["nome_carrozza"]) . '">' . htmlspecialchars($row["nome_carrozza"]) . '</option>';
                        }

                      echo '</select>';

                    }
                    
                ?>

          </div>

          <div class="form-group">
              <label for="nome_carrozza_uno">carrozza</label>
              
            
                <?php 
                    $sql = "SELECT * FROM carrozza";
                    $result = $db->query($sql);

                    if ($result->rowCount() > 0) {

                        echo '<form method="POST">';
                        echo '<select name="nome_carrozza_uno">';

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                          echo '<option value="' . ($row["nome_carrozza"]) . '">' . htmlspecialchars($row["nome_carrozza"]) . '</option>';
                        }

                      echo '</select>';

                    }
                    
                ?>

          </div>


          <div class="form-group">
              <label for="nome_carrozza_due">carrozza</label>
              
            
                <?php 
                    $sql = "SELECT * FROM carrozza";
                    $result = $db->query($sql);

                    if ($result->rowCount() > 0) {

                        echo '<form method="POST">';
                        echo '<select name="nome_carrozza_due">';

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                          echo '<option value="' . ($row["nome_carrozza"]) . '">' . htmlspecialchars($row["nome_carrozza"]) . '</option>';
                        }

                      echo '</select>';

                    }
                    
                ?>

          </div>
              
            <div class="form-group">
                <label for="depart-date">Data </label>
                <input type="date" id="depart-date" name="tipologia" required>
            </div>

            

          <button type="submit" class="btn btn-primary">Componi treno</button>

      </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>

  </html>




