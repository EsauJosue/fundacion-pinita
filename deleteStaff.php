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

$consultaPerfil = $bd->query("SELECT perfil FROM staff WHERE id_staff = '$staff';");
$perfil = $consultaPerfil->fetchAll(PDO::FETCH_OBJ);
foreach ($perfil as $dato){
    if($dato->perfil == 'administrador'){
        $consulta = $bd->query("SELECT COUNT(*) FROM staff WHERE perfil = 'administrador';");
        $administradores = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($administradores as $datoA){
            if($datoA<=1){
                header('Location: notificacion-error-administrador.php');
            }else{
                $sentencia = $bd->prepare("DELETE FROM staff WHERE id_staff = ?;");
                $resultado = $sentencia->execute([$sentencia]);
                if($resultado === TRUE){
                    header('Location: notificacion-confirmacion.php');
                }else{
                    echo "Error en el Sistema";
                }

            }
        
        }
    }else{
        $sentencia = $bd->prepare("DELETE FROM staff WHERE id_staff = ?;");
        $resultado = $sentencia->execute([$sentencia]);
        if($resultado === TRUE){
            header('Location: notificacion-confirmacion.php');
        }else{
            echo "Error en el Sistema";
        }

    }

}


}

?>