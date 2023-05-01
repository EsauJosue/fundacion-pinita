 
 <?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

include 'components/head.php';
include_once 'components/permisos-menu.php';

include 'model/conexion.php';

$id = $_GET['id'];
$sentencia = $bd->prepare("SELECT * FROM reg_apoyos WHERE id_apoyo = '$id';");
$sentencia->execute([$id]);
$aportacion = $sentencia->fetchAll(PDO::FETCH_OBJ); 

?>
<div class="content">
    <?php 
        foreach ($aportacion as $datoAport){
    
    ?>
<div class="content__form" id="RegAportaciones">
    <h3>Editar Aportación</h3>
    <form action="updateAportacion.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetallesAportacion">Aportación: </label>
            <input type="text" value="<?php echo $id?>" name="id_aportacion" class="content__form__box-input" readonly>
        </div>
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
            <input type="text" placeholder="Observaciones del usuario" name="aportacion_detalles" class="content__form__box-input input-observaciones" id="txtDetallesAportacion" maxlength="180" value="<?php echo $datoAport->detalles  ?>">
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
            <input type="number" placeholder="Cantidad de la aportación" name="cantidad_aportacion" class="content__form__box-input" id="txtCantidad" required maxlength="11" value="<?php echo $datoAport->cantidad;?>">
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
            <button type="submit" value="" class="content__form__box-cta" name="actualizar_aportacion" onclick="return confirmacion()">Actualizar Aportación</button>
            <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Cancelar</a>
        </div>
    </form>
  </div> 
  <?php }?>
</div>


  <?php 

    }else{
   echo "Error en el sistema";
}   
include './components/footer-staff.php';

       ?>