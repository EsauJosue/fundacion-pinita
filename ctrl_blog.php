<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php';
include 'confirm.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
      <button class="btn-abrir-popup" onclick="abrirPopup('#RegBlog')"><img src="/images/Iconos//entrada.png" alt="">Nueva Entrada</button>
    </div>
    <div class="content__menu-principal__button">
      <button class="btnPop-lstaff" onclick="abrirPopup('#listBlog')"><img src="/images/Iconos/libro-abierto.png" alt="">Ver/Editar Entradas</button>
    </div>
  </div>
  <div class="overlay">
    <div class="content__form" id="RegBlog">
      <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#RegBlog')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
      <h3>Nuevo Post</h3>
      <!-- Formulario  -->
      <form action="insert_post.php" class="content__form form_insert_post" method="POST" enctype="multipart/form-data" id="" accept-charset="utf-8">
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
            <textarea  placeholder="Ingrese el contenido del Post" wrap="soft" name="blog_contenido" class="content__form__box-input" id="txtContenido" required></textarea>
        </div>
        <div class="content__form__box">
                <label class="content__form__box-label " for="ctaImagen">Imagen: </label>
                <input type="file" placeholder="" name="foto" class="cta-imagen" id="ctaImagen" accept="image/jpeg, image/png">
        </div>
        <input type="hidden" name="oculto" value=1 id="hidden">
      
        <div class="content__form__box">
          <button type="submit" value="" class="content__form__box-cta" name="guardar" onclick="return confirmacion()">Guardar</button>
          <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Cancelar</a>
          <?php include 'confirm.php';?>
        </div>
      </form>
    </div>
  </div>
  <div class="overlay">
    <div class="content__list" id="listBlog">
    <?php 
    $consulta = $bd->query("SELECT id_post,titulo,fecha FROM blogpost ORDER BY id_post");
      $posts = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__mobile__section">
      <a href="#" id="btn-cerrar-popup-staffList" class="btn-cerrar-popup" onclick="cerrarPopup('#listBlog')"><img src="/images/Iconos/xmark-solid.svg" alt="" ></a>

      <h3>Lista de Posts</h3>
        <?php 

        if(!$posts){
            echo 'No existen Posts';
        }else{
            ?>
          <table class="content__list__mobile__section-table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Fecha</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>
                </tr>
            </thead>
            <?php
              foreach ($posts as $dato){
                  ?>
            <tbody>
                <tr>
                    <td><?php echo $dato->id_post ?></td>
                    <td><?php echo $dato->titulo ?></td>
                    <td><?php echo $dato->fecha ?></td>
                    <td><a href="editPost.php?id=<?php echo $dato->id_post?>"><img src="/images/edit.svg" alt=""></a></td>
                    <td><a href="#" onclick="abrirPopupConfirm('#confirm-update','deletePost.php?id=',<?php echo $dato->id_post?>,'Eliminar Registro')"><img src="/images/delete.svg" alt=""></a></td>
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
  </div>
</div>
</div>

<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>