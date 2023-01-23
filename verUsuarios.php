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
  <div class="content__list">
    <?php 
    $consulta = $bd->query("SELECT usuario,nombre,perfil FROM usuarios ORDER BY nombre");
      $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__section">
      <h3>Usuarios</h3>
 
        <?php 
        if(!$apoyos){
            echo 'No existen solicitudes de apoyo';
        }else{
            ?>
          <table class="content__list__section-table">
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
                            <td><a href="verBeneficiario.php?id=<?php echo $dato->usuario?>"><img src="/images/information.svg" alt=""></a></td>
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
          include 'footer.php';
        ?>
    </div>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer.php';
?>