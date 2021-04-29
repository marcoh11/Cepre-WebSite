<?php 
$mysqli= new mysqli("localhost" , "root" , "" , "cepre");
if(mysqli_connect_error()){
    echo 'Conexion Fallida :',mysqli_connect_error();
    exit();
}
?>
