<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}

$aportacion = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM reg_apoyos WHERE id_apoyo = ?;");
$resultado = $sentencia->execute([$aportacion]);
if($resultado === TRUE){
    header('Location: notificacion-confirmacion.php');
}
}else{
    echo "Error en el Sistema";
}
?>