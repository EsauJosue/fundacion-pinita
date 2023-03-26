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
  <select name="select_report" id="select_report">
    <option value="beneficiarios">Beneficiarios</option>
    <option value="benefactores">Benefactores</option>
    <option value="apoyos">Apoyos</option>
  </select>
  
  <a target="_blank" id="verReporte">Ver</a>
      
</div>


<div class="overlay">
  <div class="content__list" id="list-apoyos-gral">
      <?php 
      $consulta = $bd->query("SELECT * FROM solicitud_apoyo ORDER BY id_solicitud");
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
</div>
 

<div class="overlay">
  <div class="content__list" id="list-apoyos-autorizados">
      <?php 
      $consulta = $bd->query("SELECT * FROM solicitud_apoyo WHERE estatus='aceptado' ORDER BY id_solicitud");
        $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#list-apoyos-autorizados')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>

        <h3>Solicitudes Autorizadas</h3>
  
          <?php 
          if(!$apoyos){
              echo 'No existen solicitudes de apoyo';
          }else{
              ?>
            <table class="content__list__mobile__section-table">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>usuario</th>
                    <th>Fecha</th>
                    <th>Programa</th>
                    <th>Estatus</th>
                    <!-- <th>Observaciones</th> -->
                    <!-- <th>Aceptar</th> -->
                    <!-- <th>Rechazar</th> -->
                    <th>Ver</th>


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
                              <!-- <td width="50px"><?php //echo $dato->observaciones ?></td> -->
                              <!-- <td><a href="editCita.php?id=<?php //echo $dato->id_usuario?>"><img src="/images/aceptado.svg" alt=""></a></td> -->
                              <!-- <td><a href="deleteCita.php?id=<?php //echo $dato->id_usuario?>"><img src="/images/delete.svg" alt=""></a></td> -->
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
</div>

<div class="overlay">
  <div class="content__list" id="list-apoyos-pendientes">
      <?php 
      $consulta = $bd->query("SELECT * FROM solicitud_apoyo WHERE estatus='pendiente' ORDER BY id_solicitud");
        $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#list-apoyos-pendientes')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>

        <h3>Solicitudes Pendientes</h3>
  
          <?php 
          if(!$apoyos){
              echo 'No existen solicitudes de apoyo';
          }else{
              ?>
            <table class="content__list__mobile__section-table">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>usuario</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <!-- <th>Observaciones</th> -->
                    <th>Aceptar</th>
                    <th>Rechazar</th>
                    <th>Ver</th>


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
                              <!-- <td><?php //echo $dato->id_programa ?></td> -->
                              <td style="color: blue"><?php echo $dato->estatus ?></td>
                              <!-- <td width="50px"><?php // echo $dato->observaciones ?></td> -->
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
</div>
<div class="overlay">
  <div class="content__list" id="list-apoyos-rechazados">
      <?php 
      $consulta = $bd->query("SELECT * FROM solicitud_apoyo WHERE estatus='rechazado' ORDER BY id_solicitud");
        $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#list-apoyos-rechazados')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>

        <h3>Solicitudes Rechazadas</h3>
          <?php 
          if(!$apoyos){
              echo 'No existen solicitudes de apoyo';
          }else{
              ?>
            <table class="content__list__mobile__section-table">
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>usuario</th>
                    <th>Fecha</th>
                    <th>Programa</th>
                    <th>Estatus</th>
                    <!-- <th>Observaciones</th> -->
                    <!-- <th>Aceptar</th> -->
                    <!-- <th>Rechazar</th> -->
                    <th>Ver</th>


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
                              <!-- <td width="50px"><?php //echo $dato->observaciones ?></td> -->
                              <!-- <td><a href="editCita.php?id=<?php //echo $dato->id_usuario?>"><img src="/images/aceptado.svg" alt=""></a></td> -->
                              <!-- <td><a href="deleteCita.php?id=<?php //echo $dato->id_usuario?>"><img src="/images/delete.svg" alt=""></a></td> -->
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
            include 'footer-staff.php';
          ?>
      </div>
  </div>
</div>


<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>