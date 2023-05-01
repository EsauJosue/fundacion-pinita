<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}

$programa = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM programa_social WHERE id_programa = ?;");
$resultado = $sentencia->execute([$programa]);
if($resultado === TRUE){
    header('Location: notificacion-confirmacion.php');
}
}else{
    echo "Error en el Sistema";
}
?>