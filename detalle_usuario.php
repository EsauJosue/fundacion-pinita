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
    <h2 class="title__box__title">Detalles del Usuario</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>

<div class="content">
<?php 
include './components/sidebar-menu.php'
?>
  <style>
  #item-usuarios {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-usuarios a{
    color: #222;
  }
</style>
<?php
$usuario = $_GET['id'];
$consulta = $bd->query("SELECT * FROM usuarios WHERE usuario =  '$usuario'");
$beneficiario = $consulta->fetchAll(PDO::FETCH_OBJ);

foreach ($beneficiario as $dato){
?>
<div class="content__detailsBox">

    <ul>
        <li><strong>Usuario:</strong><br><?php echo $dato->usuario;?></li>
        <li><strong>Nombre: </strong><br><?php echo $dato->nombre;?></li>
        <li><strong>Nacionalidad: </strong><br><?php echo $dato->nacionalidad;?></li>
        <li><strong>Fecha de Nacimiento: <br></strong><?php echo $dato->fnacimiento;?></li>
        <li><strong>Domicilio: </strong><br><?php echo $dato->domicilio;?></li>
        <li><strong>Teléfono: </strong><br><?php echo $dato->telefono;?></li>
        <li><strong>Perfil: </strong><br><?php echo $dato->perfil;?></li>
        <li><strong>Observaciones: </strong><br><?php echo $dato->observaciones;?></li>
    </ul>
    <button onclick="regresar()" class="btn-regresar">Regresar</button>
</div>
<?php
                  }
?>  
</div>


<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>