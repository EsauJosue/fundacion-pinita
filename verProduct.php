<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';

$producto = $_GET['id'];

    $consulta = $bd->query("SELECT id_producto,descripcion,observaciones,precio,existencia,imagen,tipoimagen FROM catalogo WHERE id_producto = '$producto'");
    $producto = $consulta->fetchAll(PDO::FETCH_OBJ);

    if(!$producto){
        echo 'No existe el producto';
    }else{
        foreach ($producto as $dato){

            ?>
             <div class="title__box">
                <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
                <h2 class="title__box__title">Detalle del producto</h2>
            </div>
            <div class="content">
                <div class="content__pedido">
                    <div class="content__pedido-item">
                        <p><strong>Id Producto:</strong><?php echo $dato->id_producto?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Descripcion:</strong><?php echo $dato->descripcion?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Observaciones:</strong><?php echo $dato->observaciones?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Precio:</strong><?php echo $dato->precio?></p>
                    </div>
                    <div class="content__pedido-item">
                        <p><strong>Existencia:</strong><?php echo $dato->existencia?></p>
                    </div>
                    <?php 
                        $imagen_decodificada = base64_encode($dato->imagen);
                    ?>   
                    <img class="img-verProduct" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
                    
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