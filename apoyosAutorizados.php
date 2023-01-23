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
    <h2 class="title__box__title">Apoyos Aceptados</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>
<div class="content">
<?php include 'sidebar-apoyos.php'?>
  <div class="content__list">
    <?php 
    $consulta = $bd->query("SELECT * FROM solicitud_apoyo WHERE estatus='aceptado' ORDER BY id_solicitud");
      $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__section">
      <h3>Solicitud de apoyos</h3>
 
        <?php 
        if(!$apoyos){
            echo 'No existen solicitudes de apoyo';
        }else{
            ?>
          <table class="content__list__section-table">
              <thead>
                  <tr>
                  <th>No.</th>
                  <th>usuario</th>
                  <th>Fecha</th>
                  <th>Programa</th>
                  <th>Estatus</th>
                  <th>Observaciones</th>
                  <th>Aceptar</th>
                  <th>Rechazar</th>
                  <th>Ver Información</th>


                  </tr>
              </thead>
              <?php
                foreach ($apoyos as $dato){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dato->id_solicitud ?></td>
                            <td><?php echo $dato->id_usuario ?></td>
                            <td><?php echo $dato->fecha ?></td>
                            <td><?php echo $dato->id_programa ?></td>
                            <td style="color: blue"><?php echo $dato->estatus ?></td>
                            <td width="50px"><?php echo $dato->observaciones ?></td>
                            <td><a href="editCita.php?id=<?php echo $dato->id_usuario?>"><img src="/images/aceptado.svg" alt=""></a></td>
                            <td><a href="deleteCita.php?id=<?php echo $dato->id_usuario?>"><img src="/images/delete.svg" alt=""></a></td>
                            <td><a href="verBeneficiario.php?id=<?php echo $dato->id_usuario?>"><img src="/images/information.svg" alt=""></a></td>
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