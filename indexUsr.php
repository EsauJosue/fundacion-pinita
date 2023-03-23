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
<?php
  $tipoUsr = $_SESSION['perfilUsr'];
  if ($tipoUsr == 'administrador'){
    include 'menu-index-admin.php';
  }
  if($tipoUsr == 'moderador'){
    include 'menu-index-mode.php';
  }

?>     
</section>
   <img src="/images/desk.jpg" alt="" class="content__wallpaper">
</div>

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>