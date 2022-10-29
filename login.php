<?php 
include './components/head.php';
include './components/header.php';
?>
<div class="content">
  <h2 class="content__title">Inicio de Sesión</h2>
  <form action="loginProcess.php" class="content__form" method="POST">
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtUser">Usuario: </label>
          <input type="text" placeholder="Ingrese su usaurio" name="user" class="content__form__box-input" id="txtUser" required>
      </div>
      <div class="content__form__box">
          <label class="content__form__box-label" for="txtPass">Password: </label>
          <input type="password" placeholder="Password" name="password" class="content__form__box-input" id="txtPass" required>
      </div>
      <input type="hidden" name="oculto" value=1>
      <div class="content__form__box">
          <button type="submit" value="" class="content__form__box-cta">Iniciar sesión</button>
      </div>
  </form>
</div>
<?php 
include './components/footer.php';

?>