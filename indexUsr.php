<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include 'components/permisos-menu.php';
?>
 <div class="title__box">
    <h2 class="title__box__title">Fundación Pinita</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>
<div class="content">
   
 <img src="/images/desk.jpg" alt="">
</div>

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer.php';
?>