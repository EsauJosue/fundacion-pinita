<?php
include 'components/head.php';
include './components/header.php';
include 'model/conexion.php';


    if(!isset($_POST['oculto'])){
        exit();
    } 
    $id_aportacion = $_POST['id_aportacion'];
    $benefactor = $_POST['benefactor'];
    $tipo_aportacion = $_POST['tipo_aportacion'];
    $aportacion_detalles = $_POST['aportacion_detalles'];
    $programa_destino = $_POST['programa_destino'];
    $cantidad_aportacion = $_POST['cantidad_aportacion'];
    $aportacion_divisa = $_POST['aportacion_divisa'];
    
        $sentencia = $bd->prepare("UPDATE reg_apoyos SET id_usuario = ?, tipo_apoyo =?, detalles = ?,id_programa = ?,cantidad = ?,divisa = ? WHERE id_apoyo = ?;");
        $resultado = $sentencia->execute([$benefactor,$tipo_aportacion,$aportacion_detalles,$programa_destino,$cantidad_aportacion,$aportacion_divisa,$id_aportacion]);
            if($resultado === TRUE){
                header("Location: notificacion-confirmacion.php");
            }else{
                header("Location: notificacion-error.php");
            }      
    ?>