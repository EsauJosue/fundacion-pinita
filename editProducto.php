<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

include 'components/head.php';
include_once 'components/permisos-menu.php';

include 'model/conexion.php';

$id = $_GET['id'];
$sentencia = $bd->prepare("SELECT * FROM catalogo WHERE id_producto = '$id';");
$sentencia->execute([$id]);
$producto = $sentencia->fetchAll(PDO::FETCH_OBJ); 
?>
 <div class="title__box">
    <h2 class="title__box__title">Editar Producto</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>
<section class="content">
    <?php
     foreach ($producto as $dato){
        ?>

    <form action="updateProduct.php" class="content__form" method="POST" enctype="multipart/form-data" id="" accept-charset="utf-8">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtClave">Clave: </label>
            <input type="text" placeholder="Ingrese la clave del producto" name="clave-product" class="content__form__box-input" id="txtClave" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDescripcion">Descripción: </label>
            <input type="text" placeholder="Descripción del producto" name="descripcion-product" class="content__form__box-input" id="txtDescripcion" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetalles">Detalles adicionales: </label>
            <input type="text" placeholder="Descripción del producto" name="detalles-product" class="content__form__box-input observaciones" id="txtDetalles" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPrecio">Precio: </label>
            <input type="number" placeholder="Descripción del producto" name="precio-product" class="content__form__box-input" id="txtPrecio" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label " for="ctaImagen">Imagen: </label>
            <input type="file" placeholder="" name="foto" class="cta-imagen" id="ctaImagen" accept="image/jpeg, image/png">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtExistencia">Existencia: </label>
            <input type="number" placeholder="Cantidad de producto existente" name="existencia-product" class="content__form__box-input input-" id="txtExistencia" required>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" name="guardar" onclick="return confirmacion()">Registrar</button>
            <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Cancelar</a>
        </div>
    </form>
        <?php 

     }
}else{
    echo "Error en el sistema";
}  

        ?>