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
    <h2 class="title__box__title">Control de Programas Sociales</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>
    </div>
</div>
<div class="content">
  <div class="content__form">
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
            <button type="submit" value="" class="content__form__box-cta">Registrar Programa</button>
        </div>
    </form>
  </div>
  <div class="content__list">
    <?php 
      $consulta = $bd->query("SELECT * FROM programa_social ORDER BY id_programa");
      $programas = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__section">
      <h3>Programas Sociales</h3>
      <?php 
      ?>
        <?php 
        if(!$programas){
            echo 'No existen programas ';
        }else{
            ?>
          <table class="content__list__section-table">
              <thead>
                  <tr>
                  <th>ID Programa</th>
                  <th>Nombre</th>
                  <th>Detalles</th>
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
                            <td><?php echo $dato->detalles ?></td>
                            <td><?php echo $dato->id_staff ?></td>
                            <td><a href="editProgramas.php?id=<?php echo $dato->id_programa?>"><img src="/images/edit.svg" alt=""></a></td>
                            <td><a href="deleteProgramas.php?id=<?php echo $dato->id_programa?>"><img src="/images/delete.svg" alt=""></a></td>
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