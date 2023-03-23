<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';

?>
 <div class="title__box">
 <a href="/indexUsr.php"><img src="/images/Iconos/home.png" alt=""></a>
    <h2 class="title__box__title">Control de Staff</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
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
  #item-staff {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-staff a{
    color: #222;
  }
</style>
    <div class="content__menu-principal">
       <div class="content__menu-principal__button">
            <button class="btn-abrir-popup" onclick="abrirPopup('#RegStaff')"><img src="/images/Iconos/add-user.png" alt="">Agregar Usuario</button>
       </div>
       <div class="content__menu-principal__button">
            <button class="btnPop-lstaff" onclick="abrirPopup('#ListStaff')"><img src="/images/Iconos/edit-user.png" alt="">Ver/Editar Usuario</button>
       </div>
    </div>
    <div class="overlay">
        <div class="content__form" id="RegStaff">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegStaff')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
            <form action="insert_staff.php" class="content__form" method="POST">
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtUser">Usuario: </label>
                <input type="text" placeholder="Ingrese su usuario" name="staff_usuario" class="content__form__box-input" id="txtUser" required maxlength="12">
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtNombre">Nombre Completo: </label>
                <input type="text" placeholder="Ingrese su nombre completo" name="staff_nombre" class="content__form__box-input" id="txtNombre" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="selectTipoUser"">Perfil de Usuario: </label>
                <select name="staff_perfilUsuario" class="content__form__box-input" id="selectTipoUser">
                    <option value="administrador">Administrador</option>
                    <option value="moderador" >Moderador</option>
                    <option value="profesional">Profesional</option>
                </select>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtfnacimiento">Fecha de Nacimiento: </label>
                <input type="date" placeholder="Ingrese la fecha de nacimiento" name="staff_fnacimiento" class="content__form__box-input" id="txtfnacimiento" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtNacionalidad">Nacionalidad: </label>
                <input type="text" placeholder="Ingrese su nacionalidad" name="staff_nacionalidad" class="content__form__box-input" id="txtNacionalidad" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtDomicilio">Domicilio: </label>
                <input type="text" placeholder="Ingrese su domicilio" name="staff_domicilio" class="content__form__box-input" id="txtDomicilio" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtDomicilio">Email: </label>
                <input type="email" placeholder="Ingrese su correo electrónico" name="staff_email" class="content__form__box-input" id="txtDomicilio" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtTelefono">Teléfono: </label>
                <input type="tel" placeholder="Ingrese su telefono a 10 digitos sin espacios" name="staff_telefono" class="content__form__box-input" id="txtTelefono" required maxlength="10">
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtObservaciones">Título Universitario: </label>
                <input type="text" placeholder="Observaciones del usuario" name="staff_TituloUniversitario" class="content__form__box-input" id="txtTituloUniversitario" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtObservaciones">Cédula Profesional: </label>
                <input type="text" placeholder="Observaciones del usuario" name="staff_cedula" class="content__form__box-input" id="txtCedula" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtObservaciones">Observaciones: </label>
                <input type="text" placeholder="Observaciones del usuario" name="staff_Observaciones" class="content__form__box-input input-observaciones" id="txtObservaciones" required>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtPass1">Password: </label>
                <input type="password" placeholder="Password hasta 12 caracteres" name="password1" class="content__form__box-input" id="txtPass1" required maxlength="12">
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtPass2">Confirmar Password: </label>
                <input type="password" placeholder="Confirmar Password" name="password2" class="content__form__box-input" id="txtPass2" required maxlength="12">
            </div>
            <input type="hidden" name="oculto" value=1>
            <div class="content__form__box">
                <button type="submit" value="" class="content__form__box-cta">Registrar</button>
               
            </div>
            </form>

        </div>
    </div>
    <div class="overlay">
        <div class="content__list__mobile " id="ListStaff">
            <?php 
            $consulta = $bd->query("SELECT id_staff, nombre, perfil, email, telefono FROM staff ORDER BY id_staff");
            $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
            ?>
            <section class="content__list__mobile__section">
            <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#ListStaff')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>
            <h3>Personal Staff</h3>
        
                <?php 
                if(!$staff){
                    echo 'No existen personal de staff ';
                }else{
                    ?>
                <table class="content__list__mobile__section-table">
                    <thead>
                        <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                        </tr>
                    </thead>
                    <?php
                        foreach ($staff as $dato){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $dato->id_staff ?></td>
                                    <td><?php echo $dato->nombre ?></td>
                                    <td><?php echo $dato->perfil ?></td>
                                    <td><a href="editStaff.php?id=<?php echo $dato->id_staff?>"><img src="/images/edit.svg" alt=""></a></td>
                                    <td><a href="deleteStaff.php?id=<?php echo $dato->id_staff?>"><img src="/images/delete.svg" alt=""></a></td>
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
    
    
  
  <div class="content__list__desktop">
    <?php 
    $consulta = $bd->query("SELECT id_staff, nombre, perfil, email, telefono FROM staff ORDER BY id_staff");
      $staff = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__section">
      <h3>Personal Staff</h3>
 
        <?php 
        if(!$staff){
            echo 'No existen personal de staff ';
        }else{
            ?>
          <table class="content__list__section-table">
              <thead>
                  <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Perfil</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                  </tr>
              </thead>
              <?php
                foreach ($staff as $dato){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dato->id_staff ?></td>
                            <td><?php echo $dato->nombre ?></td>
                            <td><?php echo $dato->perfil ?></td>
                            <td><?php echo $dato->email ?></td>
                            <td><?php echo $dato->telefono ?></td>
                            <td><a href="editStaff.php?id=<?php echo $dato->id_staff?>"><img src="/images/edit.svg" alt=""></a></td>
                            <td><a href="deleteStaff.php?id=<?php echo $dato->id_staff?>"><img src="/images/delete.svg" alt=""></a></td>
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
include './components/footer-staff.php';
?>