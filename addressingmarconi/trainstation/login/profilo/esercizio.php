<!DOCTYPE html>
<html>

  <head>
	  <title>TrainStation profilo esercizio</title>
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

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_carrozza = isset($_POST['nome_carrozza']) ? ($_POST['nome_carrozza']) : null;
        $nome_locomotiva = isset($_POST['nome_locomotiva']) ? $_POST['nome_locomotiva'] : null;
        
       
        if (empty($nome_carrozza) || empty($nome_locomotiva)) {
          echo 'Please select carrozza, locomotiva and posti_a_sedere!';
          exit;
        }

        $sql = "SELECT * FROM carrozza WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $nome_carrozza, PDO::PARAM_INT);
        $stmt->execute();
        $nome_carrozza = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM locomotiva WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $nome_locomotiva, PDO::PARAM_INT);
        $stmt->execute();
        $nome_locomotiva = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo 'carrozza: ' . htmlspecialchars($nome_carrozza['nome_carrozza']) . '<br>';
        echo 'locomotiva: ' . htmlspecialchars($nome_locomotiva['nome_locomotiva']) . '<br>';
        
        
      }
    ?>

    <header>

      <div>
        <link rel="stylesheet" type="text/css" href="./esercizio.css">
      </div>

	    <div class="logo">backoffice di esercizio</div>

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
    <h3>componi i convogli a partire dal materiale rotabile disponibile</h3>

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
  
      <button type="submit">Componi treno</button>
    </form>
  </body>
</html>


