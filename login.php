<?php 
include './components/head.php';
include './components/header.php';
session_start();

?>
  <div class="title__box">
    <h2 class="title__box__title">Inicio de Sesión</h2>
    
</div>
<div class="contentLogin">
  <form action="loginProcess.php" class="contentLogin__form" method="POST">
      <div class="contentLogin__form__box">
          <label class="contentLogin__form__box-label" for="txtUser">Usuario: </label>
          <input type="text" placeholder="Ingrese su usaurio" name="user" class="contentLogin__form__box-input" id="txtUser" required>
      </div>
      <div class="contentLogin__form__box">
          <label class="contentLogin__form__box-label" for="txtPass">Password: </label>
          <input type="password" placeholder="Password" name="password" class="contentLogin__form__box-input" id="txtPass" required>
      </div>
      <input type="hidden" name="oculto" value=1>
      <div class="contentLogin__form__box">
          <button type="submit" value="" class="contentLogin__form__box-cta">Iniciar sesión</button>
      </div>
  </form>
</div>
<?php 
include './components/footer.php';

?>