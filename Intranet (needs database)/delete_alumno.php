<?php
    include("bd/conex.php");
    $id =$_GET['id'];
    $eliminar = "DELETE from alumno where idAlumno ='$id'";
    $eliminar1 = "DELETE from alumno_detalle where idalum ='$id'";
    $eliminar2 = "DELETE from alumno_usuario where id ='$id'";

    $resultadoEliminar = mysqli_query($conexion,$eliminar);
    $resultadoEliminar1 = mysqli_query($conexion,$eliminar1);
    $resultadoEliminar2 = mysqli_query($conexion,$eliminar2);

    if ($resultadoEliminar && $resultadoEliminar1 && $resultadoEliminar2){
        header("Location: alumnos_admin.php");
    }else{
        echo "<script>alert('No se pudo eliminar'); window.history.go(-1);</script>";
    }