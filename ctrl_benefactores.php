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
    <h2 class="title__box__title">Control de Benefactores</h2>
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
  #item-benefactores {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-benefactores a{
    color: #222;
  }
</style>
<div class="content__menu-principal">
  <div class="content__menu-principal__button">
     <button class="btn-abrir-popup" onclick="abrirPopup('#RegAportaciones')"><img src="/images/Iconos/money-transfer.png" alt="">Registro aportaciones</button>
  </div>
  <div class="content__menu-principal__button">
     <button class="btnPop-lstaff" onclick="abrirPopup('#ListAportaciones')"><img src="/images/Iconos/service.png" alt="">Ver/Editar aportaciones</button>
  </div>
  <div class="content__menu-principal__button">
     <button class="btnPop-lstaff" onclick="abrirPopup('#ListBenefactores')"><img src="/images/Iconos/agenda-de-contactos.png" alt="">Ver benefactores</button>
  </div>
</div>
<div class="overlay">
  <div class="content__form" id="RegAportaciones">
  <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegAportaciones')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
    <form action="insert_aportacion.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectBenefactor">Benefactor: </label>
            <select name="benefactor" class="content__form__box-input" id="selectBenefactor">
                  <?php
                      $consulta = $bd->query("SELECT usuario, nombre FROM usuarios WHERE perfil = 'benefactor' ORDER BY 'nombre';");
                      $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
                      foreach ($staff as $dato){
                  ?>
                      <option value="<?php echo $dato->usuario ?>"> <?php echo $dato->nombre?></option>
                  <?php 
                      }
                  ?>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectTipoAportacion">Tipo de Aportación: </label>
            <select name="tipo_aportacion" class="content__form__box-input" id="selectTipoAportacion">
                <option value="especie">Especie</option>
                <option value="economico">Económico</option>
                <option value="presencial">Presencial (voluntariado)</option>

            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetallesAportacion">Detalles: </label>
            <input type="text" placeholder="Observaciones del usuario" name="aportacion_detalles" class="content__form__box-input input-observaciones" id="txtDetallesAportacion" maxlength="180">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectPrograma">Programa destino: </label>
            <select name="programa_destino" class="content__form__box-input" id="selectPrograma">
                  <?php
                      $consulta = $bd->query("SELECT id_programa, nombre FROM programa_social;");
                      $programa = $consulta->fetchAll(PDO::FETCH_OBJ);
                      foreach ($programa as $dato){
                  ?>
                      <option value="<?php echo $dato->id_programa ?>"> <?php echo $dato->nombre?></option>
                  <?php 
                      }
                  ?>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtCantidad">Cantidad: </label>
            <input type="number" placeholder="Cantidad de la aportación" name="cantidad_aportacion" class="content__form__box-input" id="txtCantidad" required maxlength="11">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="select-divisa">DIVISA: </label>
            <select name="aportacion_divisa" class="content__form__box-input" id="select-divisa">
                <option value="MXN">MXN Peso Mexicano</option>
                <option value="USD">USD Dolar Estadounidense</option>
            </select>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" name="guardar_aportacion">Registrar Aportación</button>
            <a href="#" id="btn-cerrar-popup-bottom" onclick="cerrarPopup('#RegAportaciones')">Cancelar</a>
        </div>
    </form>
  </div>
</div>
 
<div class="overlay">
  <div class="content__list" id="ListAportaciones">
      <?php 
        $consulta = $bd->query("SELECT id_apoyo, id_usuario, tipo_apoyo, cantidad, divisa FROM reg_apoyos ORDER BY id_apoyo");
        $aportaciones = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#ListAportaciones')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
        <h3>Aportaciones Sociales</h3>
        <?php 
        ?>
          <?php 
          if(!$aportaciones){
              echo 'No existen Aportaciones ';
          }else{
              ?>
            <table class="content__list__mobile__section-table"">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Divisa</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        <th>Imprimir</th>

                    </tr>
                </thead>
                <?php
                  foreach ($aportaciones as $dato){
                      ?>
                      <tbody>
                          <tr>
                              <td><?php echo $dato->id_apoyo ?></td>
                              <td><?php echo $dato->tipo_apoyo ?></td>
                              <!-- <td><?php //echo $dato->detalles ?></td> -->
                              <td><?php echo $dato->cantidad ?></td>
                              <td><?php echo $dato->divisa ?></td>
                              <td><a href="editAportaciones.php?id=<?php echo $dato->id_apoyo?>"><img src="/images/edit.svg" alt=""></a></td>
                              <td><a href="#" onclick="abrirPopupConfirm('#confirm-update','deleteAportacion.php?id=','<?php echo $dato->id_apoyo?>','Eliminar Registro')"><img src="/images/delete.svg" alt=""></a></td>
                              <td><a href="reports/report-aportacion.php?id=<?php echo $dato->id_apoyo?>" target="_blank"><img src="./images/Iconos/pdf.png" alt=""></a></td>
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
  <div class="content__list" id="ListBenefactores">
      <?php 
        $consulta = $bd->query("SELECT usuario,nombre,telefono FROM usuarios WHERE perfil = 'benefactor' ORDER BY nombre");
        $programas = $consulta->fetchAll(PDO::FETCH_OBJ);
      ?>
      <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#ListBenefactores')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
        <h3>Lista de Benefactores</h3>
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
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    </tr>
                </thead>
                <?php
                  foreach ($programas as $dato){
                      ?>
                      <tbody>
                          <tr>
                              <td><?php echo $dato->usuario ?></td>
                              <td><?php echo $dato->nombre ?></td>
                              <td><?php echo $dato->telefono ?></td>
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