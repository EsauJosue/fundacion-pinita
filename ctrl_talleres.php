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
    <h2 class="title__box__title">Control de Talleres y Conferencias</h2>
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
  #item-talleres {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-talleres a{
    color: #222;
  }
</style>
<div class="content__menu-principal">
       <div class="content__menu-principal__button">
            <button class="btn-abrir-popup" onclick="abrirPopup('#RegTaller')"><img src="/images/Iconos/add-user.png" alt="">Agregar Taller o Conferencia</button>
       </div>
       <div class="content__menu-principal__button">
            <button class="btnPop-lstaff" onclick="abrirPopup('#ListTaller')"><img src="/images/Iconos/edit-user.png" alt="">Ver/Editar Taller o Conferencia</button>
       </div>
</div>


<div class="overlay">
    <div class="content__form" id="RegTaller">
        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegTaller')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
        <form action="insert_eventos.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtNombre">Nombre del taller o conferencia: </label>
            <input type="text" placeholder="Ingrese el nombre del taller o conferencia" name="taller_nombre" class="content__form__box-input" id="txtNombre" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtFecha">Fecha de Inicio: </label>
            <input type="date" placeholder="" name="taller_fecha" class="content__form__box-input" id="txtFecha" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtHora">Hora de Evento: </label>
            <input type="time" placeholder="" name="taller_hora" class="content__form__box-input" id="txtHora" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtLugar">Lugar de evento: </label>
            <input type="text" placeholder="Ingrese la dirección del evento" name="taller_lugar" class="content__form__box-input" id="txtLugar" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectPonente"">Ponente o Encargado: </label>
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
            <input type="number" placeholder="Costo de entrada." name="taller_precio" class="content__form__box-input" id="txtPrecio" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="selectPonente"">Contacto: </label>
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
            <input type="text" placeholder="Ingrese los detalles del evento, como lugares disponibles y/o material necesario" name="tallerDetalles" class="content__form__box-input input-observaciones" id="txtDetalles" required>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta">Registrar el Evento</button>
        </div>
        </form>
    </div>
</div>
   
<div class="overlay"> 
    <div class="content__list__mobile" id="ListTaller">
    <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#ListTaller')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>

    <?php 
    $consulta = $bd->query("SELECT id_taller, nombre, fecha, hora, lugar, ponentes, precio FROM ctrl_talleres ORDER BY id_taller");
      $eventos = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__mobile__section">
      <h3>Listado de Eventos</h3>
 
        <?php 
        if(!$eventos){
            echo 'No existen registros de eventos ';
        }else{
            ?>
            <table class="content__list__mobile__section-table">
              <thead>
                  <tr>
                  <th>No.</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <!-- <th>Hora</th> -->
                  <th>Lugar</th>
                  <!-- <th>Ponente</th> -->
                  <!-- <th>Precio</th> -->
                  <th>Modificar</th>
                  <th>Eliminar</th>
                  </tr>
              </thead>
              <?php
                foreach ($eventos as $dato){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dato->id_taller ?></td>
                            <td><?php echo $dato->nombre ?></td>
                            <td><?php echo $dato->fecha ?></td>
                            <!-- <td><?php //echo $dato->hora ?></td> -->
                            <td><?php echo $dato->lugar ?></td>
                            <!-- <td><?php //echo $dato->ponentes ?></td> -->
                            <!-- <td><?php //echo $dato->precio ?></td> -->
                            <td><a href="editCita.php?id=<?php echo $dato->id_staff?>"><img src="/images/edit.svg" alt=""></a></td>
                            <td><a href="deleteCita.php?id=<?php echo $dato->id_staff?>"><img src="/images/delete.svg" alt=""></a></td>
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