<?php
session_start();
require "conection.php";
if(!isset($_SESSION['id'])){
header("Location: login.php");
}

$sql="SELECT idExamen FROM `examen_nota` GROUP BY idExamen ORDER by idExamen DESC LIMIT 1";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_assoc();
$idExamen=$row['idExamen'];
if(is_null($row['idExamen'])){
header("Location: notas_admin.php");
}else{
$sql2 ="DELETE FROM `examen_nota` WHERE idExamen='$idExamen'";
$stmt = $mysqli->prepare($sql2);
if($stmt->execute()){
    $sql3 ="DELETE FROM `examen_curso` WHERE idExamen='$idExamen'";
    $stmt3 = $mysqli->prepare($sql3);
    $stmt3->execute();
    echo '<script >alert("Datos eliminados correctamente");
    window.location= "notas_admin.php";   
    </script>';		
    } else {
        echo '<script >alert("No se pudo eliminar los datos");
        window.location= "notas_admin.php";   
        </script>';		
}
}