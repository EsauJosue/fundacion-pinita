<?php
include 'components/head.php';
include './components/header.php';
include 'model/conexion.php';


    if(!isset($_POST['oculto'])){
        exit();
    } 
    $id_taller = $_POST['id_taller'];
    $nombre = $_POST['taller_nombre'];
    $fecha = $_POST['taller_fecha'];
    $hora = $_POST['taller_hora'];
    $lugar = $_POST['taller_lugar'];
    $ponente = $_POST['taller_ponente'];
    $tipo = $_POST['taller_tipo'];
    $precio = $_POST['taller_precio'];
    $contacto = $_POST['taller_contacto'];
    $detalles = $_POST['taller_detalles'];
  
    $sentencia = $bd->prepare("UPDATE ctrl_talleres SET nombre =?, fecha = ?,hora = ?,lugar =?,tipo =?,ponentes =?,detalles =?,precio =?,contacto =? WHERE id_taller = $id_taller;");
        $resultado = $sentencia->execute([$nombre,$fecha,$hora,$lugar,$tipo,$ponente,$detalles,$precio,$contacto]);
            if($resultado === TRUE){
                header("Location: notificacion-confirmacion.php");
            }else{
                header("Location: notificacion-error.php");
            }      
    ?>