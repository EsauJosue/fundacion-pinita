<?php
include 'components/head.php';
include './components/header.php';
include 'model/conexion.php';


    if(!isset($_POST['oculto'])){
        exit();
    } 
    $clave = $_POST['clave-product'];
    $descripcion = $_POST['descripcion-product'];
    $detalles = $_POST['detalles-product'];
    $precio = $_POST['precio-product'];
    $existencia = $_POST['existencia-product'];
    $permitido=array("image/png","image/jpeg");
    
    if(isset($_REQUEST['actualizar'])){
        echo 'actualizar';
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            
            $datos_imagen = file_get_contents($_FILES['foto']['tmp_name']);
            $tipoArchivo = $_FILES['foto']['type'];
            if( in_array($tipoArchivo,$permitido) ==false ){
            
                header('Location: notificacion-archivoNoPermitido.php',true,303);
                die();

            }
            $nombreArchivo=$_FILES['foto']['name'];
            $sentencia = $bd->prepare("UPDATE catalogo SET descripcion = ?, observaciones =?, precio = ?,existencia = ?,imagen = ?,tipoimagen = ? WHERE id_producto = ?;");
            $resultado = $sentencia->execute([$descripcion,$detalles,$precio,$existencia,$datos_imagen,$tipoArchivo,$clave]);
                if($resultado === TRUE){
                    header("Location: notificacion-confirmacion.php");
                }else{
                    header("Location: notificacion-error.php");
                }      


            }
        }
        
    ?>