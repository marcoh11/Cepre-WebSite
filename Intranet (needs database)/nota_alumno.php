<?php
require "conection.php";  
$sql = "Select * from examen_curso";
        $resultado = $mysqli->query($sql);
        while ($row= $resultado->fetch_assoc()){ 
        $idexamen=$row['idExamen'];
        $idalumno=$row['idAlumno'];
        $buenas=$row['C01']+$row['C02']+$row['C03']+$row['C04']+$row['C05']+$row['C06']+$row['C07']+$row['C08']+$row['C09']+$row['C10']+$row['C11']+$row['C12']+$row['C13']+$row['C14']+$row['C15']+$row['C16']+$row['C17'];
        $malas=$row['malas'];
        $sql2 ="INSERT INTO `examen_nota`(`idExamen`, `idAlumno`,`buenas`,`malas`) VALUES ('$idexamen',$idalumno,$buenas,$malas)";
        $stmt = $mysqli->prepare($sql2);
        $stmt->execute();
        header("Location: notas_admin.php");
    }
?>