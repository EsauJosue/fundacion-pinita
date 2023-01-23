<?php
session_start();

include_once 'model/conexion.php';
$usuario = $_POST['user'];
$password = $_POST['password'];

$busqueda = $bd->prepare('SELECT usuario, password, nombre, perfil from usuarios WHERE usuario = ? AND password = ?;');
$busqueda->execute([$usuario, $password]);
$datos = $busqueda->fetch(PDO::FETCH_OBJ);

$busquedaStaff = $bd->prepare('SELECT id_staff, password, nombre, perfil from staff WHERE id_staff = ? AND password = ?;');
$busquedaStaff->execute([$usuario, $password]);
$datosStaff = $busquedaStaff->fetch(PDO::FETCH_OBJ);

if($datos === FALSE && $datosStaff === FALSE){
    header('Location: error_login.php');
     
}elseif($busqueda->rowCount() == 1){
       
    $_SESSION['usuario']= $datos->usuario;
    $_SESSION['nombreUsr']= $datos->nombre;
    $_SESSION['perfilUsr']= $datos->perfil;
    header('Location: indexUsr.php');
}elseif($busquedaStaff->rowCount() == 1){
       
    $_SESSION['usuario']= $datosStaff->id_staff;
    $_SESSION['nombreUsr']= $datosStaff->nombre;
    $_SESSION['perfilUsr']= $datosStaff->perfil;
    header('Location: indexUsr.php');
}
?>