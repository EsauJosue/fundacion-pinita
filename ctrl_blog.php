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
    <h2 class="title__box__title">Control Blog</h2>
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
  #item-blog {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-blog a{
    color: #222;
  }
</style>
    <div class="content__menu-principal">
       <div class="content__menu-principal__button">
            <button class="btn-abrir-popup" onclick="abrirPopup('#RegBlog')"><img src="/images/Iconos/escribir.png" alt="">Nueva Entrada</button>
       </div>
       <div class="content__menu-principal__button">
            <button class="btnPop-lstaff" onclick="abrirPopup('#ListBlog')"><img src="/images/Iconos/libro-abierto.png" alt="">Ver/Editar Entradas</button>
       </div>
    </div>
    <div class="overlay">
        <div class="content__form" id="RegBlog">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegBlog')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
            <h3>Nuevo Post</h3>
            <!-- Formulario  -->
            <form action="insert_post.php" class="content__form" method="POST" enctype="multipart/form-data" id="" accept-charset="utf-8">
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtTitulo">Título: </label>
                <input type="text" placeholder="Ingrese el título del Post" name="blog_titulo" class="content__form__box-input" id="txtTitulo" required maxlength="80">
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtExtracto">Extracto: </label>
                <textarea  placeholder="Ingrese un extracto del post" name="blog_extracto" class="content__form__box-input" id="txtExtracto" required rows="5" maxlength="350"></textarea>
            </div>
            <div class="content__form__box">
                <label class="content__form__box-label" for="txtContenido">Contenido: </label>
                <textarea  placeholder="Ingrese el contenido del Post" name="blog_contenido" class="content__form__box-input" id="txtContenido" required></textarea>
            </div>
            <div class="content__form__box">
                    <label class="content__form__box-label " for="ctaImagen">Imagen: </label>
                    <input type="file" placeholder="" name="foto" class="cta-imagen" id="ctaImagen" accept="image/jpeg, image/png">
            </div>
            <input type="hidden" name="oculto" value=1>
            <div class="content__form__box">
                <button type="submit" value="" class="content__form__box-cta" name="guardar" onclick="return confirmacion()">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>