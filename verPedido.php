<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';

$pedido = $_GET['id'];

    $consulta = $bd->query("SELECT id_pedido,fecha,nombreCliente,telefono,email,calle,numero,fraccionamiento,ciudad,estado,cp,id_producto,cantidad,total,estatus FROM pedidos WHERE id_pedido = $pedido");
    $pedido = $consulta->fetchAll(PDO::FETCH_OBJ);

    if(!$pedido){
        echo 'No existe el pedido';
    }else{
        foreach ($pedido as $dato){

            ?>
             <div class="title__box">
                <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
                <h2 class="title__box__title">Detalle del pedido</h2>
            </div>
            <div class="content">
                <div class="content__pedido">
                    <div class="content__pedido-item">
                        <p><strong>Pedido:</strong><?php echo $dato->id_pedido?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Fecha:</strong><?php echo $dato->fecha?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Cliente:</strong><?php echo $dato->nombreCliente?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Teléfono:</strong><?php echo $dato->telefono?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Email:</strong><?php echo $dato->email?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Calle:</strong><?php echo $dato->calle?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Número:</strong><?php echo $dato->numero?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Fraccionamiento:</strong><?php echo $dato->fraccionamiento?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Cliudad:</strong><?php echo $dato->ciudad?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Estado:</strong><?php echo $dato->estado?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>C.P.:</strong><?php echo $dato->cp?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Producto:</strong><?php echo $dato->calle?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Cantidad:</strong><?php echo $dato->cantidad?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Total:</strong><?php echo $dato->total?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Estatus:</strong><?php echo $dato->estatus?></p>
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