<?php
include("conection.php");
        $consulta = mysqli_query($mysqli,"LOAD DATA INFILE 'D:/xampp/htdocs/intranet/notas/subir_notas.txt' INTO TABLE examen_curso FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'");
        if(mysqli_error($mysqli)){
        echo '<script >alert("Algunas notas no se subieron");
        window.location= "nota_alumno.php";
        </script>';
        }else{
        echo '<script >alert("Datos insertados correctamente");
        window.location= "nota_alumno.php";   
        </script>';
        }
?>

<!-- D:/xampp/htdocs/intranet/notas/subir_notas.txt -->