<?php

session_start();
$sessionid = $_SESSION['id'];
echo $sessionid;

if($sessionid ==""){
    echo("PROFILO ESERCIZIO");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>
<body>
   <h1>utente@utente.com</h1>
</body>
</html>