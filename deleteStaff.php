<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

if(!isset($_GET['id'])){
    exit();
}

$staff = $_GET['id'];
include 'model/conexion.php';
$sentencia = $bd->prepare("DELETE FROM staff WHERE id_staff = ?;");
$resultado = $sentencia->execute([$staff]);
if($resultado === TRUE){
    header('Location: ctrl_staff.php');
}
}else{
    echo "Error en el Sistema";
}
?>