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