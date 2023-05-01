<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

include 'components/head.php';
include_once 'components/permisos-menu.php';
include 'model/conexion.php';

$id = $_GET['id'];
$sentencia = $bd->prepare("SELECT * FROM staff WHERE id_staff = '$id';");
$sentencia->execute([$id]);
$staff = $sentencia->fetchAll(PDO::FETCH_OBJ); 
?>
 <div class="title__box">
    <h2 class="title__box__title">Editar Staff</h2>
    <div class="title__box__usr">
        <!-- <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  //echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  //echo $_SESSION['perfilUsr'] ?></p> -->

    </div>
</div>
<div class="content">
    <?php
     foreach ($staff as $dato){
        ?>

    <form action="updateStaff.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtUser">Usuario: </label>
            <input style="color: red;" type="text" placeholder="Ingrese su usuario" name="staff_usuario" class="content__form__box-input" id="txtUser" readonly="true" value="<?php echo $dato->id_staff?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNombre">Nombre Completo: </label>
            <input type="text" placeholder="Ingrese su nombre completo" name="staff_nombre" class="content__form__box-input" id="txtNombre" value="<?php echo $dato->nombre?>" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectTipoUser"">Perfil de Usuario: </label>
            <select name="staff_perfilUsuario" class="content__form__box-input" id="selectTipoUser">
                <option value="administrador">Administrador</option>
                <option value="moderador" >Moderador</option>
                <option value="profesional">Profesional</option>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtfnacimiento">Fecha de Nacimiento: </label>
            <input type="date" name="staff_fnacimiento" class="content__form__box-input" id="txtfnacimiento" required value="<?php echo $dato->fecha_nacimiento?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNacionalidad">Nacionalidad: </label>
            <input type="text"  name="staff_nacionalidad" class="content__form__box-input" id="txtNacionalidad" required value="<?php echo $dato->nacionalidad?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDomicilio">Domicilio: </label>
            <input type="text" name="staff_domicilio" class="content__form__box-input" id="txtDomicilio" required value=" <?php echo $dato->direccion?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtEmail">Email: </label>
            <input type="email"  name="staff_email" class="content__form__box-input" id="txtEmail" required value="<?php echo $dato->email?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtTelefono">Teléfono: </label>
            <input type="tel"  name="staff_telefono" class="content__form__box-input" id="txtTelefono" required maxlength="10" value="<?php echo $dato->telefono?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Título Universitario: </label>
            <input type="text"  name="staff_TituloUniversitario" class="content__form__box-input" id="txtTituloUniversitario" required value="<?php echo $dato->titulo_universitario?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Cédula Profesional: </label>
            <input type="text"  name="staff_cedula" class="content__form__box-input" id="txtCedula" value="<?php echo $dato->cedula?>" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtObservaciones">Observaciones: </label>
            <input type="text"  name="staff_Observaciones" class="content__form__box-input input-observaciones" id="txtObservaciones" required value="<?php echo $dato->observaciones?>">
        </div>
        <div class="content__form__box">
            <span class="content__form__box-span">La contraseña debe contener al menos una mayuscula, una minuscula, un caracter especial y un número. Debe tener entre 8 y 12 caracteres</span>
            <label class="content__form__box-label" for="txtPass1">Password: </label>
            <input type="password" placeholder="Password hasta 12 caracteres" name="password1" class="content__form__box-input" id="txtPass1" required maxlength="12">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPass2">Confirmar Password: </label>
            <input type="password" placeholder="Confirmar Password" name="password2" class="content__form__box-input" id="txtPass2" required maxlength="12">
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" onclick="return confirmacion()" class="content__form__box-cta">Modificar</button>
        </div>
        <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Cancelar</a>
    </form>
</div>
        <?php 
        
     }
}else{
    echo "Error en el sistema";
}   
include('./components/footer-staff.php');

        ?>