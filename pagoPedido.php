<?php
//session_start();
//if(!isset($_SESSION['usuario'])){
  //  header('Location: login.php');
//}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
//include_once 'components/permisos-menu.php';
include './model/conexion.php';

 $pedido = $_GET['pedido'];
?>
 <div class="title__box">
 <a href="/index.php"><img src="/images/Iconos/home.png" alt=""></a>
    <h2 class="title__box__title">Notificaciones</h2>
</div>
<div class="content-box">
    <div class="content-box__message">
        <div class="content-box__message__title">
            <img src="/images/Iconos/accept.png" alt="">
            <h3>Pedido Registrado</h3>
        </div>
        <div class="content-box__message__text">
            <p> El pedido # <?php echo $pedido?> se ha registrado con éxito</p>
        </div>
    </div>
    <button class="btn-regresar" onclick="regresar()">Regresar</button>
</div>
<?php
// }else{
//     echo "Error en el Sistema";
// }
include './components/footer-staff.php';
?>
