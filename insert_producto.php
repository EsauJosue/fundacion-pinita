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
    
    if(isset($_REQUEST['guardar'])){
        if(isset($_FILES['foto']['name'])){
            $tipoArchivo = $_FILES['foto']['type'];
            $permitido=array("image/png","image/jpeg");
            if( in_array($tipoArchivo,$permitido)== false){
                die("Archivo no permitido");
            }
            $nombreArchivo=$_FILES['foto']['name'];
            $tamanoArchivo=$_FILES['foto']['size'];
            $imagen=fopen($_FILES['foto']['tmp_name'],'r');
            $binarios=fread($imagen,$tamanoArchivo);
            $con = mysqli_connect($db_host,$user,$password,$dbname);
            $binarios=mysqli_escape_string($con,$binarios);
            $sentencia = $bd->prepare("INSERT INTO catalogo(id_producto,descripcion,observaciones,precio,existencia,imagen,tipoimagen) VALUES (?,?,?,?,?,?,?);");
            $resultado = $sentencia->execute([$clave,$descripcion,$detalles,$precio,$existencia,$binarios,$tipoArchivo]);
            if($resultado === TRUE){
                echo "Se ha guardado correctamente el programa: ".$nombrePrograma;
                header('Location: productos.php',true,303);
            }else{
                echo "Ocurrio un error o el programa ya existe. Favor de intentar más tarde o cambiar el usuario.";
            }

                }
    }

    
?>