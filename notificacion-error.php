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
            <p>Ocurrio un error al procesar la solicitud. Pude ser debido a los siguientes errores: </p>
            <ul>
                <li>Si esta ingresando un producto puede que la clave del producto ya exista</li>
                <li>Revisar que el usuario tenga los permisos suficientes para realizar el registro del producto.</li>
            </ul>
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



echo "Ocurrio un error o el programa ya existe. Favor de intentar más tarde o cambiar el usuario.";