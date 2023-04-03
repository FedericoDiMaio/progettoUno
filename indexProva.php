<?php


$connesione = new mysqli('localhost','root','','progettoUno');
if($connesione->connect_error){
    die('connesione fallita: '.$connesione->connect_error);
}
$sql = "SELECT * FROM utenti";
$result = $connesione->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "nome: ". $row['nome'] . "<br>";
        echo "cognome: ". $row['cognome'] . "<br>";
        echo "e-mail: ". $row['email'] . "<br>";
       
    }
    

}else{
    echo "non ci sono dati";
}
    
?>