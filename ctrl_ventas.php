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
    <h2 class="title__box__title">Centro Ecommerce</h2>
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
  #item-ventas {
    border-radius: 5px;
    background-color: rgb(255,182,0,100%);
    padding: 5px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

  }
  #item-ventas a{
    color: #222;
  }
</style>
    <div class="content__menu-principal">
        <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#e-catalogoProductos')"><img src="/images/Iconos/catalogo-productos.png" alt="">Catálogo Productos</button>
        </div>
        <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#e-productos')"><img src="/images/Iconos/registro-productos.png" alt="">Registro Productos</button>
        </div>
        <!-- <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#list-usuarios')"><img src="/images/ajusteInventario.svg" alt="">Ajuste de Inventarios</button>
        </div> -->
        <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#list-usuarios')"><img src="/images/Iconos/control-ventas.png" alt="">Control Ventas</button>
        </div>
        <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#e-pedidos')"><img src="/images/Iconos/pedidos.png" alt="">Pedidos</button>
        </div>
        <div class="content__menu-principal__button">
                <button class="btn-abrir-popup" onclick="abrirPopup('#list-usuarios')"><img src="images/Iconos/reportes.png" alt="">Reportes</button>
        </div>
        
    </div>
    <!-- PEDIDOS -->
    <div class="overlay">
    <div class="content__list__mobile" id="e-pedidos">
            <?php 
                $consulta = $bd->query("SELECT * FROM pedidos ORDER BY id_pedido");
                $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
            ?>
        <section class="content__list__mobile__section" >
        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#e-pedidos')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>

        <h3>Pedidos</h3>
            <?php 
            if(!$apoyos){
                echo 'No existen pedidos actualmente';
            }else{
                ?>
            <table class="content__list__mobile__section-table">
                <thead>
                    <tr>
                    <th>Pedido</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Envio</th>
                    <th>Total</th>
                    <th>Observaciones</th>
                    <th>Surtir</th>
                    <th>Rechazar</th>
                    <th>Ver Información</th>
                    </tr>
                </thead>
                <?php
                    foreach ($apoyos as $dato){
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $dato->id_pedido ?></td>
                                <td><?php echo $dato->fecha ?></td>
                                <td><?php echo $dato->nombreCliente ?></td>
                                <td><?php echo $dato->direccion_envio ?></td>
                                <td><?php echo $dato->total ?></td>
                                <td width="50px"><?php echo $dato->observaciones ?></td>
                                <td><?php echo $dato->estatus ?></td>
                                <td><a href="#?id=<?php echo $dato->id_usuario?>"><img src="/images/aceptado.svg" alt=""></a></td>
                                <td><a href="#?id=<?php echo $dato->id_usuario?>"><img src="/images/delete.svg" alt=""></a></td>
                                <td><a href="verBeneficiario.php?id=<?php echo $dato->id_usuario?>"><img src="/images/information.svg" alt=""></a></td>
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
    <!-- REGISTRO DE PRODUCTOS -->
    <div class="overlay">
        <div class="content__form" id="e-productos">
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#e-productos')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
            <h3>Registro de Productos</h3>
            <form action="insert_producto.php" class="content__form" method="POST" enctype="multipart/form-data" id="" accept-charset="utf-8">
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
                    <input type="file" placeholder="" name="foto" class="cta-imagen" id="ctaImagen" accept="image/jpeg, image/png">
                </div>
                <div class="content__form__box">
                    <label class="content__form__box-label" for="txtExistencia">Existencia: </label>
                    <input type="number" placeholder="Cantidad de producto existente" name="existencia-product" class="content__form__box-input input-" id="txtExistencia" required>
                </div>
                <input type="hidden" name="oculto" value=1>
                <div class="content__form__box">
                    <button type="submit" value="" class="content__form__box-cta" name="guardar" onclick="return confirmacion()">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- CATÁLOGO DE PRODUCTOS -->
    <div class="overlay">
        <div class="content__list__mobile" id="e-catalogoProductos">
            <?php 
            $consulta = $bd->query("SELECT id_producto,descripcion,observaciones,precio,existencia,imagen,tipoimagen FROM catalogo");
            $productos = $consulta->fetchAll(PDO::FETCH_OBJ);
            ?>
            <section class="content__list__mobile__section">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#e-catalogoProductos')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>

            <h3>Catálogo de Productos</h3>
        <?php 
        if(!$productos){
            echo 'No existen Productos ';
        }else{
            ?>
          <table class="content__list__mobile__section-table">
              <thead>
                  <tr>
                  <th>Clave</th>
                  <th>Descripción</th>
                  <!-- <th>Observaciones</th> -->
                  <!-- <th>Precio</th> -->
                  <th>Existencia</th>
                  <!-- <th>Imagen</th> -->
                  <th>Ver</th>
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
                            <!-- <td><?php //echo $dato->observaciones ?></td> -->
                            <!-- <td><?php //echo $dato->precio ?></td> -->
                            <td><?php echo $dato->existencia ?></td>
                            <!-- <td>
                                <?php 
                                    //$img = base64_encode($dato->imagen);
                                  
                                ?>
                               
                                <img src="data:<?php //echo $dato->tipoimagen?>;charset=utf8;base64,<?php //echo $img;?>">
                            </td> -->
                            <td><a href="#"><img src="/images/information.svg" alt=""></a></td>
                            <td><a href="editProducto.php?id=<?php echo $dato->id_producto?>"><img src="/images/edit.svg" alt=""></a></td>
                            <td><a href="deleteProducto.php?id=<?php echo $dato->id_producto?>"><img src="/images/delete.svg" alt=""></a></td>
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
    
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer-staff.php';
?>
