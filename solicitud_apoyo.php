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
    <h2 class="title__box__title">Solicitud de Apoyo </h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>
    </div>
</div>

<div class="content">
    <form action="insertSolicitud.php" class="content__form" method="POST">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtUser">Usuario: </label>
            <input type="text"  name="user" class="content__form__box-input" id="txtUser" readonly='readonly'  value="<?php echo $_SESSION['usuario']?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtFecha">Fecha de solicitud: </label>
            <input type="text"  name="fecha" class="content__form__box-input" id="txtFecha"  readonly='readonly'  value="<?php $hoy = date('d/m/y'); print_r($hoy);?>">
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtUser">Programa Social: </label>
            <select name="programa_id" class="content__form__box-input">
            <?php
                    $consulta = $bd->query("SELECT id_programa,nombre FROM programa_social;");
                    $programa = $consulta->fetchAll(PDO::FETCH_OBJ);
                    foreach ($programa as $dato){
                ?>
                    <option value="<?php echo $dato->id_programa?>"> <?php echo $dato->nombre?></option>
                <?php 
                    }
                ?>
            </select> 
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtUser">Observaciones: </label>
            <input type="text" placeholder="Observaciones del usuario" name="observaciones" class="content__form__box-input input-observaciones" id="txtObservaciones">
        </div>
        <input type="hidden" name="oculto" value=1>
            <div class="content__form__box">
                <button type="submit" value="" class="content__form__box-cta">Registrar</button>
            </div>
    </form>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include 'components/footer.php';
?>