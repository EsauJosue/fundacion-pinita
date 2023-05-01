<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){

include 'components/head.php';
include_once 'components/permisos-menu.php';
include 'model/conexion.php';

$id = $_GET['id'];
$sentencia = $bd->prepare("SELECT * FROM ctrl_talleres WHERE id_taller = '$id';");
$sentencia->execute([$id]);
$taller = $sentencia->fetchAll(PDO::FETCH_OBJ); 

?>
<div class="content">
<?php 
        foreach ($taller as $datoTaller){
    
    ?>
    <div class="content__form">
        <h3>Editar Conferencia o Taller</h3>
        <form action="updateTaller.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNombre">Evento: </label>
            <input type="text" value="<?php echo $datoTaller->id_taller;?>" name="id_taller" class="content__form__box-input" id="txtNombre" readonly>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNombre">Nombre del taller o conferencia: </label>
            <input type="text" value="<?php echo $datoTaller->nombre;?>" name="taller_nombre" class="content__form__box-input" id="txtNombre" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtFecha">Fecha de Inicio: </label>
            <input type="date" value="<?php echo $datoTaller->fecha;?>" name="taller_fecha" class="content__form__box-input" id="txtFecha" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtHora">Hora de Evento: </label>
            <input type="time" value="<?php echo $datoTaller->hora;?>" name="taller_hora" class="content__form__box-input" id="txtHora" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtLugar">Lugar de evento: </label>
            <input type="text" value="<?php echo $datoTaller->lugar;?>" name="taller_lugar" class="content__form__box-input" id="txtLugar" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectPonente">Ponente o Encargado: </label>
            <select name="taller_ponente" class="content__form__box-input" id="selectPonente">
            <?php
                        $consulta = $bd->query("SELECT id_staff, nombre FROM staff;");
                        $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($staff as $dato){
                    ?>
                        <option value="<?php echo $dato->id_staff?>"> <?php echo $dato->nombre?></option>
                    <?php 
                        }
                    ?>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectTipoEvento">Tipo de Evento: </label>
            <select name="taller_tipo" class="content__form__box-input"  id="selectTipoEvento">
                <option value="Taller"> Taller</option>
                <option value="Conferencia"> Conferencia</option>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPrecio">Precio: </label>
            <input type="number" value="<?php echo $datoTaller->precio;?>"  name="taller_precio" class="content__form__box-input" id="txtPrecio" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectPonente">Contacto: </label>
            <select name="taller_contacto" class="content__form__box-input" id="selectPonente">
            <?php
                        $consulta = $bd->query("SELECT id_staff, nombre, telefono FROM staff;");
                        $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
                        foreach ($staff as $dato){
                    ?>
                        <option value="<?php echo $dato->nombre." ". $dato->telefono ?>"> <?php echo $dato->nombre?></option>
                    <?php 
                        }
                    ?>
            </select>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetalles">Detalles del Evento: </label>
            <input type="text" value="<?php echo $datoTaller->detalles;?>" name="taller_detalles" class="content__form__box-input input-observaciones" id="txtDetalles" required>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" onclick="return confirmacion()">Actualizar el evento</button>
            <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Cerrar</a>
        </div>
    </form>
    </div>
   
</div>
<?php }?>
                    </div>


    <?php 

}else{
   echo "Error en el sistema";
}   
include './components/footer-staff.php';

       ?>