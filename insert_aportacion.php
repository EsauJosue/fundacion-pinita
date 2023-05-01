<?php
if(!isset($_POST['oculto'])){
    exit();
}
include 'model/conexion.php';
    $benefactor = $_POST['benefactor'];
    $tipo_aportacion = $_POST['tipo_aportacion'];
    $detalles = $_POST['aportacion_detalles'];
    $programa = $_POST['programa_destino'];
    $cantidad = $_POST['cantidad_aportacion'];
    $divisa=$_POST['aportacion_divisa'];
    $fecha = date('Y-m-d'); 
    
    if(isset($_REQUEST['guardar_aportacion'])){
            $consulta = $bd->prepare("INSERT INTO reg_apoyos(id_usuario,fecha,tipo_apoyo,detalles,id_programa,cantidad,divisa) VALUES (?,?,?,?,?,?,?);"); 
            $consulta->bindParam(1, $benefactor, PDO::PARAM_STR,12);
            $consulta->bindParam(2, $fecha, PDO::PARAM_STR);
            $consulta->bindParam(3, $tipo_aportacion, PDO::PARAM_STR,80);
            $consulta->bindParam(4, $detalles, PDO::PARAM_STR,180);
            $consulta->bindParam(5, $programa, PDO::PARAM_INT);
            $consulta->bindParam(6, $cantidad, PDO::PARAM_INT);
            $consulta->bindParam(7, $divisa, PDO::PARAM_STR,3);
            $consulta->execute();
            header('Location: notificacion-confirmacion.php');
       
        }else{
            header('Location: notificacion-error.php');
        }
            
    
?>