<html>
    <head>
        <title>TrainStation</title>
        <link rel="stylesheet" type="text/css" href="./prenotazione.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    
    
    <?php
            session_start();

            // Verifica se l'utente ha eseguito il login
            if (!isset($_SESSION["nome"]) || !isset($_SESSION["cognome"])) {
                // L'utente non ha eseguito il login, reindirizza alla pagina di login o mostra un messaggio di errore
                header("Location: ../../trainstation/prenotazione/utentenonregistrato.php");
                exit(); 
                
            }
            
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


            $sql = "SELECT * FROM prenotazione";
            $result = $db->query($sql);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // Mostra i valori ottenuti nelle card
                    echo '<div class="card">';    
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">locomotiva: ' . $row['id_prenotazione'] .'</h5>';
                    echo '<p class="card-text">carrozza: ' . $row['nome_prenotazione'] .'</p>';
                    echo '<p class="card-text">numero treno: ' . $row['cognome_prenotazione'] .'</p>';
                    echo '<p class="card-text">numero treno: ' . $row['km_prenotazione'] .'</p>';
                    echo '<p class="card-text">numero treno: ' . $row['costo_prenotazione'] .'</p>';
                    echo '<a href="#" class="btn btn-primary prenota">prenota</a>';
                    echo '</div>';
                    echo '</div>';
                    }
                }
            
    ?>

    <header>
        <div class="logo">pagina di prenotazione</div>

        <nav>
            <ul>
                <li><a href="#">logout</a></li>
            </ul>
        </nav>

    </header>

    
   

    




