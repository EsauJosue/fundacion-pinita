<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php'
?>
 <div class="title__box">
    <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
    <h2 class="title__box__title">Notificaciones</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>
<div class="content-box">
    <div class="content-box__message">
        <div class="content-box__message__title">
            <img src="/images/Iconos/cross.png" alt="">
            <h3>Error</h3>
        </div>
        <div class="content-box__message__text">
        <p>La contraseña debe contener al menos una mayuscula, una minuscula, un caracter especial y un número. Debe tener entre 8 y 12 caracteres. Asegurese que las ambas contraseñas coincidan.</p>
        </div>
    </div>
    <button class="btn-regresar" onclick="regresar()">Regresar</button>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>