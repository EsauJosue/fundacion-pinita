<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}

$producto = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM catalogo WHERE id_producto = ?;");
$resultado = $sentencia->execute([$producto]);
if($resultado === TRUE){
    header('Location: notificacion-confirmacion.php');
}
}else{
    echo "Error en el Sistema";
}
?>