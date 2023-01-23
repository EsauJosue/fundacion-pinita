<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include 'model/conexion.php';
?>
 <div class="title__box">
    <h2 class="title__box__title">Proceso de solicitud de apoyo</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>
    </div>
</div>

<section class="content">
    <?php
        if(!isset($_POST['oculto'])){
            exit();
        }
            $userA = $_POST['user'];
            $fechaSolicitudA = $_POST['fecha'];
            $id_programaA = $_POST['programa_id'];
            $estatusA = 'pendiente';
            $observacionesA = $_POST['observaciones'];
            $sentenciaX = $bd->prepare("INSERT INTO solicitud_apoyo(id_usuario,fecha,id_programa,estatus,observaciones) VALUES (?,?,?,?,?);");
            $resultado = $sentenciaX->execute([$userA,$fechaSolicitudA,$id_programaA,$estatusA,$observacionesA]);
            if($resultado === TRUE){
                echo "Se ha guardado correctamente la solicitud de apoyo, por favor espere a que nuestro equipo revise la solicitud y de ser autorizada estaremos poniendonos en contacto con los datos que nos proporcionó. ";
            }else{
                echo "Ocurrio un error al registrar el apoyo.";
            }
    ?>
</section>

<?php
}else{
    echo "Error en el Sistema";
}
include 'components/footer.php';
?>