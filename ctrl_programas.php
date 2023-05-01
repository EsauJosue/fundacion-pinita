<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';
include 'confirm.php';

?>
 <div class="title__box">
    <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
    <h2 class="title__box__title">Control de Programas Sociales</h2>
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
  #item-programas {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-programas a{
    color: #222;
  }
</style>
<div class="content__menu-principal">
  <div class="content__menu-principal__button">
     <button class="btn-abrir-popup" onclick="abrirPopup('#RegPrograms')"><img src="/images/Iconos/registrar-progarmas.png" alt="">Registrar Programa</button>
  </div>
  <div class="content__menu-principal__button">
     <button class="btnPop-lstaff" onclick="abrirPopup('#ListPrograms')"><img src="/images/Iconos/edit-user.png" alt="">Ver/Editar Programas</button>
  </div>
</div>

<!-- Registrar -->
<div class="overlay">
  <div class="content__form" id="RegPrograms">
  <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegPrograms')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
    <form action="insert_programas.php" class="content__form" method="POST">

        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNombre">Nombre del Programa: </label>
            <input type="text" placeholder="Ingrese el nombre del programa" name="psocial_nombre" class="content__form__box-input" id="txtNombre" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetalles">Detalles del Programa: </label>
            <input type="text" placeholder="Observaciones del usuario" name="psocial_detalles" class="content__form__box-input input-observaciones" id="txtDetalles" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectTipoUser"">Encargado del Programa: </label>
            <select name="psocial_encargado" class="content__form__box-input" id="selectTipoUser">
                  <?php
                      $consulta = $bd->query("SELECT id_staff, nombre FROM staff;");
                      $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
                      foreach ($staff as $dato){
                  ?>
                      <option value="<?php echo $dato->id_staff ?>"> <?php echo $dato->nombre?></option>
                  <?php 
                      }
                  ?>
            </select>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" onclick="return confirmacion()">Registrar Programa</button>
            <a href="#" id="btn-cerrar-popup-bottom" onclick="cerrarPopup('#RegPrograms')">Cancelar</a>
        </div>
    </form>
  </div>
</div>
 <!-- Listado -->
<div class="overlay">
  <div class="content__list" id="ListPrograms">
      <?php 
        $consulta = $bd->query("SELECT * FROM programa_social ORDER BY id_programa");
        $programas = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__section">
      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#ListPrograms')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
        <h3>Programas Sociales</h3>
        <?php 
        ?>
          <?php 
          if(!$programas){
              echo 'No existen programas ';
          }else{
              ?>
            <table class="content__list__mobile__section-table"">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <!-- <th>Detalles</th> -->
                    <th>Staff</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                    </tr>
                </thead>
                <?php
                  foreach ($programas as $dato){
                      ?>
                      <tbody>
                          <tr>
                              <td><?php echo $dato->id_programa ?></td>
                              <td><?php echo $dato->nombre ?></td>
                              <!-- <td><?php //echo $dato->detalles ?></td> -->
                              <td><?php echo $dato->id_staff ?></td>
                              <td><a href="editProgramas.php?id=<?php echo $dato->id_programa?>"><img src="/images/edit.svg" alt=""></a></td>
                              <td><a href="#" onclick="abrirPopupConfirm('#confirm-update','deleteProgramas.php?id=','<?php echo $dato->id_programa?>','Eliminar Registro')"><img src="/images/delete.svg" alt=""></a></td>
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

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>