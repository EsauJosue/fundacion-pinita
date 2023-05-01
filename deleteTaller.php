<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}
$taller = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM ctrl_talleres WHERE id_taller = ?;");
$resultado = $sentencia->execute([$taller]);
if($resultado === TRUE){
    header('Location: notificacion-confirmacion.php');
}
}else{
    echo "Error en el Sistema";
}
?>