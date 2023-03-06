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

<form action="updateProduct.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtUser">Clave: </label>
            <input style="color: red;" type="text" name="catalogo-clave" class="content__form__box-input" id="txtUser" readonly="true" value="<?php echo $dato->id_producto?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDescripcion">Descripción: </label>
            <input type="text" placeholder="Ingrese su nombre completo" name="catalogo-descripcion" class="content__form__box-input" id="txtDescripcion" value="<?php echo $dato->descripcion?>" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Observaciones: </label>
            <input type="text" name="catalogo-observaciones" class="content__form__box-input" id="txtObservaciones" required value="<?php echo $dato->observaciones?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPrecio">Precio: </label>
            <input type="text"  name="catalogo-precio" class="content__form__box-input" id="txtPrecio" required value="<?php echo $dato->precio?>">
        </div>
            <div class="content__form__box">
            <label class="content__form__box-label" for="txtExistencia">Existencia: </label>
            <input type="text" name="catalogo-existencia" class="content__form__box-input" id="txtExistencia" required value=" <?php echo $dato->existencia?>">
        </div>
       <div class="content__form__box">
            <label class="content__form__box-label" for="txtDomicilio">Email: </label>
            <input type="email"  name="staff_email" class="content__form__box-input" id="txtDomicilio" required value="<?php //echo $dato->email?>">
        </div>
       <!--  <div class="content__form__box">
            <label class="content__form__box-label" for="txtTelefono">Teléfono: </label>
            <input type="tel"  name="staff_telefono" class="content__form__box-input" id="txtTelefono" required maxlength="10" value="<?php //echo $dato->telefono?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Título Universitario: </label>
            <input type="text"  name="staff_TituloUniversitario" class="content__form__box-input" id="txtTituloUniversitario" required value="<?php //echo $dato->titulo_universitario?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Cédula Profesional: </label>
            <input type="text"  name="staff_cedula" class="content__form__box-input" id="txtCedula" value="<?php //echo $dato->cedula?>" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Observaciones: </label>
            <input type="text"  name="staff_Observaciones" class="content__form__box-input input-observaciones" id="txtObservaciones" required value="<?php //echo $dato->observaciones?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPass1">Password: </label>
            <input type="password" placeholder="Password hasta 12 caracteres" name="password1" class="content__form__box-input" id="txtPass1" required maxlength="12">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPass2">Confirmar Password: </label>
            <input type="password" placeholder="Confirmar Password" name="password2" class="content__form__box-input" id="txtPass2" required maxlength="12">
        </div> -->
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta">Modificar</button>

        </div>
        </form>
        <button type="" class="btn-regresar" value="" onclick="regresar()" class="content__form__box-cta">Regresar</button>

        <?php 
        
     }
     include './components/footer-staff.php';
}else{
    echo "Error en el sistema";
}   
include './components/footer-staff.php';

        ?>