<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php'

?>
<?php
if(!isset($_POST['oculto'])){
    exit();
}
    $titulo = $_POST['blog_titulo'];
    $extracto = $_POST['blog_extracto'];
    $contenido = $_POST['blog_contenido'];
    $permitido=array("image/png","image/jpeg");
    $staff = $_SESSION['nombreUsr'];
    $fecha = date("Y/m/d");
    if(isset($_REQUEST['guardar'])){
        
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            $datos_imagen = file_get_contents($_FILES['foto']['tmp_name']);
            $tipoArchivo = $_FILES['foto']['type'];
            if( in_array($tipoArchivo,$permitido) == false ){
            
                header('Location: notificacion-archivoNoPermitido.php',true,303);
                die();

            }
            $nombreArchivo=$_FILES['foto']['name'];
            $consulta = $bd->prepare("INSERT INTO blogpost(titulo,extracto,contenido,imagen,tipoimagen,id_staff,fecha) VALUES (?,?,?,?,?,?,?);"); 
            $consulta->bindParam(1, $titulo, PDO::PARAM_STR,120);
            $consulta->bindParam(2, $extracto, PDO::PARAM_STR,350);
            $consulta->bindParam(3, $contenido, PDO::PARAM_STR,5000);
            $consulta->bindParam(4, $datos_imagen, PDO::PARAM_LOB);
            $consulta->bindParam(5, $tipoArchivo, PDO::PARAM_STR,40);
            $consulta->bindParam(6, $staff, PDO::PARAM_STR,80);
            $consulta->bindParam(7, $fecha, PDO::PARAM_STR);
            $consulta->execute();
            
            header('Location: notificacion-confirmacion.php',true,303);
           
        }else{
            header('Location: notificacion-error.php',true,303);
        
        }
            

    }
    
?>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>