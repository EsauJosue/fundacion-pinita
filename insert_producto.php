<?php
if(!isset($_POST['oculto'])){
    exit();
}
include 'model/conexion.php';
    $clave = $_POST['clave-product'];
    $descripcion = $_POST['descripcion-product'];
    $detalles = $_POST['detalles-product'];
    $precio = $_POST['precio-product'];
    $existencia = $_POST['existencia-product'];
    $permitido=array("image/png","image/jpeg");
    if(isset($_REQUEST['guardar'])){
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

            $datos_imagen = file_get_contents($_FILES['foto']['tmp_name']);
            $tipoArchivo = $_FILES['foto']['type'];
            if( in_array($tipoArchivo,$permitido) ==false ){
            
                header('Location: notificacion-archivoNoPermitido.php',true,303);
                die();

            }
            $nombreArchivo=$_FILES['foto']['name'];
            $consulta = $bd->prepare("INSERT INTO catalogo(id_producto,descripcion,observaciones,precio,existencia,imagen,tipoimagen) VALUES (?,?,?,?,?,?,?);"); 
            $consulta->bindParam(1, $clave, PDO::PARAM_STR,12);
            $consulta->bindParam(2, $descripcion, PDO::PARAM_STR,100);
            $consulta->bindParam(3, $detalles, PDO::PARAM_STR,180);
            $consulta->bindParam(4, $precio, PDO::PARAM_INT);
            $consulta->bindParam(5, $existencia, PDO::PARAM_INT);
            $consulta->bindParam(6, $datos_imagen, PDO::PARAM_LOB);
            $consulta->bindParam(7, $tipoArchivo, PDO::PARAM_STR,40);
            $consulta->execute();
            header('Location: notificacion-confirmacion.php',true,303);
       
        }else{
            header('Location: notificacion-error.php',true,303);
        }
            //if($consulta === TRUE){
            //     header('Location: notificacion-confirmacion.php',true,303);
            //    
            // }else{

            //     header('Location: notificacion-error.php',true,303);

               
            // }

    }
    
?>