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
            $nombreEvento = $_POST['taller_nombre'];
            $fechaEvento = $_POST['taller_fecha'];
            $horaEvento = $_POST['taller_hora'];
            $lugarEvento = $_POST['taller_lugar'];
            $ponenteEvento = $_POST['taller_ponente'];
            $tipoEvento = $_POST['taller_tipo'];
            $detallesEvento = $_POST['tallerDetalles'];
            $precio = $_POST['taller_precio'];
            $contacto = $_POST['taller_contacto'];
            $sentencia = $bd->prepare("INSERT INTO ctrl_talleres(nombre,fecha,hora,lugar,tipo,ponentes,detalles,precio,contacto) VALUES (?,?,?,?,?,?,?,?,?);");
            $resultado = $sentencia->execute([$nombreEvento,$fechaEvento,$horaEvento,$lugarEvento,$tipoEvento,$ponenteEvento,$detallesEvento,$precio,$contacto]);
            if($resultado === TRUE){
                echo "Se ha guardado correctamente el evento: ".$nombreEvento;
                header("Location: ctrl_talleres.php", true, 303);
            }else{
                echo "Ocurrio un error al registrar el evento.";
            }
    ?>
</section>

<?php include 'components/footer.php';?>