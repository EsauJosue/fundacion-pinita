<?php
include 'components/head.php';
include './components/header.php';
include 'model/conexion.php';


    if(!isset($_POST['oculto'])){
        exit();
    } 
    $id_programa = $_POST['id_programa'];
    $nombre = $_POST['nombre_programa'];
    $encargado = $_POST['psocial_encargado'];
    $detalles = $_POST['programa_detalles'];

        $sentencia = $bd->prepare("UPDATE programa_social SET nombre =?, detalles = ?,id_staff = ? WHERE id_programa = $id_programa;");
        $resultado = $sentencia->execute([$nombre,$detalles,$encargado]);
            if($resultado === TRUE){
                header("Location: notificacion-confirmacion.php");
            }else{
                header("Location: notificacion-error.php");
            }      
    ?>