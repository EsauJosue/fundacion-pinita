<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}

$pedido = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM pedidos WHERE id_pedido = ?;");
$resultado = $sentencia->execute([$pedido]);
if($resultado === TRUE){
    header('Location: notificacion-confirmacion.php');
}
}else{
    echo "Error en el Sistema";
}
?>