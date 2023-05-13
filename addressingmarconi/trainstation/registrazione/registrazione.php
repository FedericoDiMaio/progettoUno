<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrazione utente</title>
    <link rel="stylesheet" href="./registrazione.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <h1>Registrazione utente</h1>
    </header>
    <form action="../login/utility/saveregistrazione.php" method="POST">
      <div class="form-row">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form-row">
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required>
      </div>
      <div class="form-row">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-row">
        <label for="telefono">Numero di telefono:</label>
        <input type="tel" id="telefono" name="telefono" required>
      </div>
      <div class="form-row">
        <label for="residenza">Residenza:</label>
        <input type="text" id="residenza" name="residenza" required>
      </div>
      <div class="form-row">
        <label for="data_di_nascita">Data di nascita:</label>
        <input placeholder="yyyy-mm-dd" type="text" id="data_di_nascita" name="data_di_nascita" required>
      </div>
      
   

      <div class="form-row">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-row">
        <label for="conferma_password">Conferma password:</label>
      <input type="password" id="conferma_password" name="conferma_password" required>
    </div>
    
    <div class="form-row">
      <input type="submit" value="Registrati">
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
