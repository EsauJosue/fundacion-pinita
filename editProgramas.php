 <?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

include 'components/head.php';
include_once 'components/permisos-menu.php';
include 'model/conexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
$sentencia = $bd->prepare("SELECT nombre,detalles,id_staff FROM programa_social WHERE id_programa = '$id';");
$sentencia->execute([$id]);
$programa = $sentencia->fetchAll(PDO::FETCH_OBJ); 

?>
<div class="content">
    <?php 
        foreach ($programa as $datoProg){
    ?>
<div class="content__form">
    <h3>Editar Programa</h3>
    <form action="updatePrograma.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetallesAportacion">ID: </label>
            <input type="text" value="<?php echo $id?>" name="id_programa" class="content__form__box-input" readonly>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetallesAportacion">Programa: </label>
            <input type="text" value="<?php echo $datoProg->nombre;?>" name="nombre_programa" class="content__form__box-input">

        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectTipoUser">Encargado del Programa: </label>
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
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetallesAportacion">Detalles: </label>
            <input type="text"  name="programa_detalles" class="content__form__box-input input-observaciones" id="txtDetallesAportacion" maxlength="180" value="<?php echo $datoProg->detalles  ?>">
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" name="actualizar_programa" onclick="return confirmacion()">Actualizar Aportación</button>
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