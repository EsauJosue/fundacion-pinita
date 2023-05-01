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
    <h2 class="title__box__title">Reportes</h2>
</div>
<div class="content">
  <?php
  $perfilUsr = $_SESSION['perfilUsr'];
  if($perfilUsr == 'administrador'){
    include './components/sidebar-menu-admin.php';
  }
  if($perfilUsr == 'moderador'){
    include './components/sidebar-menu-mode.php';
  }

  ?>
  <style>
    #item-reportes {
      border-radius: 5px;
      background-color: rgb(255,182,0,100%);
      padding: 5px;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

    }
    #item-reportes a{
      color: #222;
    }
  </style>
  <div class="content__select-report">
    <p class="content__select-report__title">Seleccionar Reporte</p>
    <select name="select_report" class="content__select-report__options" id="select_report">
      <option value="beneficiarios">Beneficiarios</option>
      <option value="benefactores">Benefactores</option>
      <option value="apoyos">Apoyos</option>
    </select>
    
    <a target="_blank" id="verReporte">Ver</a>
        
  </div>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>