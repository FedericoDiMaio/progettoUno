<?php

session_start();
$sessionid = $_SESSION['id'];
echo $sessionid;

if($sessionid ==""){
    header("location: ../error.php");
}

?>


