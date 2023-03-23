<?php 
include './components/head.php';
include './components/header.php';
?>
<div class="title__box">
    <h2 class="title__box__title">Registro de Usuario</h2>
</div>
<div class="content">
    <?php 
    $perfilUsr = $_SESSION['perfilUsr'];
    if($perfilUsr == 'administrador'){
      include './components/sidebar-menu-admin.php';
    }
    if($perfilUsr == 'moderador'){
      include './components/sidebar-menu-mode.php';
    }
    ?>
  <form action="insert_registro.php" class="content__form" method="POST">
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtUser">Usuario: </label>
          <input type="text" placeholder="Ingrese su usaurio" name="usuario" class="content__form__box-input" id="txtUser" required maxlength="12">
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtNombre">Nombre Completo: </label>
          <input type="text" placeholder="Ingrese su nombre completo" name="nombre" class="content__form__box-input" id="txtNombre" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtfnacimiento">Fecha de Nacimiento: </label>
          <input type="date" placeholder="Ingrese la fecha de nacimiento" name="fnacimiento" class="content__form__box-input" id="txtfnacimiento" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtNacionalidad">Nacionalidad: </label>
          <input type="text" placeholder="Ingrese su nacionalidad" name="nacionalidad" class="content__form__box-input" id="txtNacionalidad" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtDomicilio">Domicilio: </label>
          <input type="text" placeholder="Ingrese su domicilio" name="domicilio" class="content__form__box-input" id="txtDomicilio" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtTelefono">Teléfono: </label>
          <input type="tel" placeholder="Ingrese su telefono a 10 digitos sin espacios" name="telefono" class="content__form__box-input" id="txtTelefono" required maxlength="10">
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="selectTipoUser"">Tipo de Usuario: </label>
          <select name="tipoUsuario" class="content__form__box-input" id="selectTipoUser">
            <option value="beneficiario">Beneficiario</option>
            <option value="benefactor" >Benefactor</option>
            <option value="voluntario">Voluntario</option>
            <option value="invitado" selected>Invitado</option>
          </select>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtObservaciones">Observaciones: </label>
          <input type="text" placeholder="Observaciones del usuario" name="Observaciones" class="content__form__box-input input-observaciones" id="txtObservaciones" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtPass1">Password: </label>
          <input type="password" placeholder="Password hasta 12 caracteres" name="password1" class="content__form__box-input" id="txtPass1" required maxlength="12">
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtPass2">Confirmar Password: </label>
          <input type="password" placeholder="Confirmar Password" name="password2" class="content__form__box-input" id="txtPass2" required maxlength="12">
      </div>
      <input type="hidden" name="oculto" value=1>
      <div class="content__form__box">
          <button type="submit" value="" class="content__form__box-cta">Registrar</button>
      </div>
  </form>
</div>
<?php
include './components/footer.php';
?>