<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include 'components/permisos-menu.php';
?>
 <div class="title__box">
    <h2 class="title__box__title">Sistema Web Fundación Pinita</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>
<div class="content">
<section class="content__buttons">
      <ul class="content__buttons__items">
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/teamwork.png" alt="">Staff
          </a>
        </li>
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/social.png" alt="">Programas Sociales
          </a>
        </li>
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/agreement.png" alt="">Aceptación de apoyos
          </a>
        </li>
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/report.png"" alt="">Reportes
          </a>
        </li>
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/online-shop.png" alt="">Ecommerce
          </a>
        </li>
        <li class="content__buttons__items-item">
          <a href="">
            <img src="/images/Iconos/group.png" alt="">Usuarios
          </a>
        </li>
      </ul>
    </section>
   <img src="/images/desk.jpg" alt="" class="content__wallpaper">
</div>

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>