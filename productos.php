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
    <h2 class="title__box__title">Catálogo de Productos</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>
    </div>
</div>
<div class="content">
    <?php include 'sidebar-ecommerce.php'?>
  <div class="content__form">
    <form action="insert_producto.php" class="content__form" method="POST" enctype="multipart/form-data">
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtClave">Clave: </label>
            <input type="text" placeholder="Ingrese la clave del producto" name="clave-product" class="content__form__box-input" id="txtClave" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDescripcion">Descripción: </label>
            <input type="text" placeholder="Descripción del producto" name="descripcion-product" class="content__form__box-input" id="txtDescripcion" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtDetalles">Detalles adicionales: </label>
            <input type="text" placeholder="Descripción del producto" name="detalles-product" class="content__form__box-input observaciones" id="txtDetalles" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtPrecio">Precio: </label>
            <input type="number" placeholder="Descripción del producto" name="precio-product" class="content__form__box-input" id="txtPrecio" required>
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label " for="ctaImagen">Imagen: </label>
            <input type="file" placeholder="" name="foto" class="cta-imagen id="ctaImagen" >
        </div>
        <div class="content__form__box">
            <label class="content__form__box-label" for="txtExistencia">Existencia: </label>
            <input type="number" placeholder="Cantidad de producto existente" name="existencia-product" class="content__form__box-input input-" id="txtExistencia" required>
        </div>
        <input type="hidden" name="oculto" value=1>
        <div class="content__form__box">
            <button type="submit" value="" class="content__form__box-cta" name="guardar">Registrar</button>
        </div>
    </form>
   
  </div>
  <div class="content__list">
    <?php 
      $consulta = $bd->query("SELECT id_producto,descripcion,observaciones,precio,existencia,imagen,tipoimagen FROM catalogo");
      $productos = $consulta->fetchAll(PDO::FETCH_OBJ);
    ?>
    <section class="content__list__section">
      <h3>Catálogo de Productos</h3>
      <?php 
      ?>
        <?php 
        if(!$productos){
            echo 'No existen Productos ';
        }else{
            ?>
          <table class="content__list__section-table">
              <thead>
                  <tr>
                  <th>Clave</th>
                  <th>Descripción</th>
                  <th>Observaciones</th>
                  <th>Precio</th>
                  <th>Existencia</th>
                  <th>Imagen</th>
                  <th>Modificar</th>
                  <th>Eliminar</th>

                  </tr>
              </thead>
              <?php
                foreach ($productos as $dato){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $dato->id_producto ?></td>
                            <td><?php echo $dato->descripcion ?></td>
                            <td><?php echo $dato->observaciones ?></td>
                            <td><?php echo $dato->precio ?></td>
                            <td><?php echo $dato->existencia ?></td>
                            <td>
                                <?php 
                                    $img = base64_encode($dato->imagen);
                                  
                                ?>
                               
                                <img src="data:<?php echo $dato->tipoimagen?>;charset=utf8;base64,<?php echo $img;?>">

                            <td><a href="editCita.php?id=<?php echo $dato->id_producto?>"><img src="/images/edit.svg" alt=""></a></td>
                            <td><a href="deleteCita.php?id=<?php echo $dato->id_producto?>"><img src="/images/delete.svg" alt=""></a></td>
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