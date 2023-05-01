<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';

$solicitud = $_GET['id'];

    $consulta = $bd->query("SELECT id_solicitud,id_usuario,fecha,id_programa,estatus,observaciones FROM solicitud_apoyo WHERE id_solicitud = $solicitud");
    $solicitudes = $consulta->fetchAll(PDO::FETCH_OBJ);

    if(!$solicitudes){
        echo 'No existen solicitudes de apoyo';
    }else{
        foreach ($solicitudes as $dato){

            ?>
             <div class="title__box">
                <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
                <h2 class="title__box__title">Detalle de Solicitud</h2>
            </div>
            <div class="content">
               <div class="content__solicitud">
                <div class="content__solicitud-item">
                    <p><strong>Solicitud:</strong><?php echo $dato->id_solicitud?></p>
                </div>
                <div class="content__solicitud-item">
                    <p><strong>Solicitante:</strong><?php echo $dato->id_usuario?></p>
                </div>
                <div class="content__solicitud-item">
                    <p><strong>Fecha:</strong><?php echo $dato->fecha?></p>
                </div>
                <div class="content__solicitud-item">
                    <p><strong>Programa Solicitado:</strong><?php echo $dato->id_programa?></p>
                </div>
                <div class="content__solicitud-item">
                    <p><strong>Estado de Solicitud:</strong><?php echo $dato->estatus?></p>
                </div>
                <div class="content__solicitud-item">
                    <p><strong>Observaciones:</strong><?php echo $dato->observaciones?></p>
                </div>
                <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Regresar</a>
               </div>
            

            </div>
            
            
            
            <?php

        }
    }
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>