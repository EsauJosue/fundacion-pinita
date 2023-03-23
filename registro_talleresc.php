<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include 'model/conexion.php'
?>
 <div class="title__box">
    <h2 class="title__box__title">Fundación Pinita</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>
    </div>
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
  <div class="content__talleres">
    <?php
      $consulta = $bd->query("SELECT id_taller,nombre,fecha,hora,lugar,tipo,ponentes,detalles,precio,contacto FROM ctrl_talleres;");
      $taller = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($taller as $dato){
    ?>
      <div class="content__talleres_box">
        <p class="content__talleres_box-name"><?php echo $dato->nombre?></p>
        <span class="content__talleres_box-title">Fecha:</span>
        <p class="content__talleres_box-fecha"><?php echo $dato->fecha?></p>
        <span class="content__talleres_box-title"> Hora:</span>
        <p class="content__talleres_box-hora"><?php echo $dato->hora?></p>
        <span class="content__talleres_box-title">Ponente:</span>
        <p class="content__talleres_box-ponente">
          <?php 
            $id_ponente = $dato->ponentes;
            $consulta_ponente = $bd->query("SELECT nombre FROM staff WHERE id_staff = '$id_ponente';");
            $nombrePonente = $consulta_ponente->fetchAll(PDO::FETCH_OBJ);
            foreach ($nombrePonente as $datoPonente){
            echo $datoPonente->nombre;
            } 
          ?>
        </p>
        <span class="content__talleres_box-title">Lugar:</span>
        <p class="content__talleres_box-lugar"><?php echo $dato->lugar?></p>
        <span class="content__talleres_box-title">Precio:</span>
        <p class="content__talleres_box-precio">$<?php echo $dato->precio?></p>
        <span class="content__talleres_box-title">Detalles:</span>
        <p class="content__talleres_box-detalles"><?php echo $dato->detalles?></p>
        <span class="content__talleres_box-title">Contacto:</span>
        <p class="content__talleres_box-contacto"><?php echo $dato->contacto?></p>
        <form action="insert_reg_taller.php" class="content__form content__form__taller" method="GET">
            <div class="content__form__box">
                <button type="submit" value="" class="content__form__box-cta">Registrarse</button>
            </div>
        </form>
      </div>
    <?php 
        }
      ?>  
  </div>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include 'components/footer.php';
?>