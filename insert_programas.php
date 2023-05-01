<?php 
    //session_start();
    include 'components/head.php';
    include 'components/header.php';
?>
<section class="content">
    <?php
        if(!isset($_POST['oculto'])){
            exit();
        }
        include 'model/conexion.php';
            $nombrePrograma = $_POST['psocial_nombre'];
            $detallePrograma = $_POST['psocial_detalles'];
            $encargado = $_POST['psocial_encargado'];
            
                $sentencia = $bd->prepare("INSERT INTO programa_social(nombre,detalles,id_staff) VALUES (?,?,?);");
                $resultado = $sentencia->execute([$nombrePrograma,$detallePrograma,$encargado]);
                if($resultado === TRUE){
                    echo "Se ha guardado correctamente el programa: ".$nombrePrograma;
                    header('Location: notificacion-confirmacion.php');
                }else{
                    echo "Ocurrio un error o el programa ya existe. Favor de intentar más tarde o cambiar el usuario.";
                }
    ?>
</section>

<?php include 'components/footer.php';?>