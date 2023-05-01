<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';

?>
 <div class="title__box">
 <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
    <h2 class="title__box__title">Autorización de administrador</h2>
</div>

<div class="content">
    <form action="">
        <label for="txtPassAdmin">Ingresar Contraseña de Administrador</label>
        <input type="password" name="passwordAdmin" id="txtPassAdmin">
        <input type="button" value="Verificar">
    </form>

<?php 

?>

</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>