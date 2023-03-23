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
    <h2 class="title__box__title">Listado de Usuarios</h2>
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
<div class="content__menu-principal">
       <div class="content__menu-principal__button">
            <button class="btn-abrir-popup" onclick="abrirPopup('#list-usuarios')"><img src="/images/Iconos/add-user.png" alt="">Ver Usuarios</button>
       </div>
      
</div>
<div class="overlay">
<div class="content__list__mobile" id="list-usuarios">
    <?php 
    $consulta = $bd->query("SELECT usuario,nombre,perfil FROM usuarios ORDER BY nombre");
      $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__mobile__section">
    <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#list-usuarios')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>

      <h3>Usuarios</h3>
        <?php 
        if(!$apoyos){
            echo 'No existen solicitudes de apoyo';
        }else{
            ?>
          <table class="content__list__mobile__section-table">
              <thead>
                  <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Perfil</th>
                  <th>Ver Información</th>
                  </tr>
              </thead>
              <?php
                foreach ($apoyos as $dato){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dato->usuario ?></td>
                            <td><?php echo $dato->nombre ?></td>
                            <td><?php echo $dato->perfil ?></td>
                            <td><a href="detalle_usuario.php?id=<?php echo $dato->usuario?>"><img src="/images/information.svg" alt=""></a></td>
                        </tr>
                    </tbody>
                <?php
                  }
                ?>  
            </table>
    </section>    
        <?php
          }
          ?>
        <?php
          include 'footer-staff.php';
        ?>
    </div>
</div>
</div>
 
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer.php';
?>