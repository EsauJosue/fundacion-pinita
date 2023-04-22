<?php 
include './components/head.php';
include './components/header.php';
include 'model/conexion.php'

?>
  <div class="title__box">
    <h2 class="title__box__title">Tienda</h2>
    <div class="title__box__usr">
    </div>
  </div>

<div class="content">
  <div class="content__tienda">
    <?php
      $consulta = $bd->query("SELECT id_producto, descripcion, observaciones, precio, existencia, imagen, tipoimagen FROM catalogo;");
      $producto = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($producto as $dato){
    ?>
      <div class="content__tienda_box">
        <p class="content__tienda_box-name"><?php echo $dato->descripcion?></p>
        <?php 
            $imagen_decodificada = base64_encode($dato->imagen);
        ?>                       
        <img class="content__tienda_box-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
        <p class="content__tienda_box-fecha"><?php echo $dato->observaciones?></p>
        <span class="content__tienda_box-title"> Precio:</span>
        <p class="content__tienda_box-hora">$<?php  echo $dato->precio?></p>
      <?php 
      $existencia = $dato->existencia;
      if($existencia <= 5){
        echo " No Disponible";
      }else{?>
      <button class="btn-abrir-popup content__form__box-cta" onclick="abrirPopup('#comprar-<?php echo $dato->id_producto?>')">Comprar</button>
        <div class="overlay">

<!-- FORMULARIO PARA REGISTRAR EL PEDIDO -->
        <form action="insert_pedido.php" class="content__tienda_box-form" method="POST" id="comprar-<?php echo $dato->id_producto?>">
        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#comprar-<?php echo $dato->id_producto?>')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
        <h2>Generar Pedido</h2>
            <div class="content__tienda_box-form-title">
            <img class="content__tienda_box-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
              <p><strong>Producto:</strong> </p>
              <p><?php echo $dato->descripcion; ?></p>
              <p><strong>Existencias:</strong> </p>
              <p><?php echo $dato->existencia; ?></p>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtCliente">Producto: </label>
              <input type="text" placeholder="" name="id_producto" class="content__form__box-input" id="txtCliente" readonly="true" value="<?php echo $dato->id_producto?>">
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtCliente">Nombre del cliente: </label>
              <input type="text" placeholder="Ingrese el nombre" name="nombre" class="content__form__box-input" id="txtCliente" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtTelefono">Teléfono: </label>
              <input type="tel" placeholder="123-456-7891" name="telefono" class="content__form__box-input" id="txtTelefono" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtEmail">Email: </label>
              <input type="email" placeholder="name@email.com" name="email" class="content__form__box-input" id="txtEmail" required>
            </div>
            <h4>Datos de Envío</h4>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtCalle">Calle: </label>
              <input type="text" placeholder="Ingrese la calle" name="calle" class="content__form__box-input" id="txtCalle" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtNumero">Número: </label>
              <input type="text" placeholder="Ingrese número exterior e interior" name="numero" class="content__form__box-input" id="txtNumero" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtFeaccionamiento">Fraccionamiento: </label>
              <input type="text" placeholder="Ingrese el fraccionamiento" name="fraccionamiento" class="content__form__box-input" id="txtFeaccionamiento" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtCiudad">Ciudad: </label>
              <input type="text" placeholder="Ingrese Ciudad" name="ciudad" class="content__form__box-input" id="txtCiudad" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtEstado">Estado: </label>
              <input type="text" placeholder="Ingrese Estado" name="estado" class="content__form__box-input" id="txtEstado" required>
            </div>
            <div class="content__tienda_box-form-input">
              <label class="content__form__box-label" for="txtCP">C.P.: </label>
              <input type="text" placeholder="Ingrese Código Postal" name="cp" class="content__form__box-input" id="txtCP" required>
            </div>
            <h4>Datos del producto</h4>

            <div class="content__tienda_box-form-details">
              <div class="content__tienda_box-form-details-img">
                <img class="content__tienda_box-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
              </div>
              <div class="content__tienda_box-form-details-text">
                <ul>
                  <li>
                    <p>Clave:</p>
                    <p><?php echo $dato->id_producto?></p>
                  </li>
                  <li>
                    <p>Descripción:</p>
                    <p><?php echo $dato->descripcion?></p>
                  </li>
                  <li>
                    <p>Observaciones:</p>
                    <p><?php echo $dato->observaciones?></p>
                  </li>
                  <li>

                    <p>Precio:</p>
                    <div class="content__tienda_box-form-precio">
                    <p>$</p> 
                    <p class="content__tienda_box-form-details-text-precio" id="txt-precio"><?php echo $dato->precio?></p>
                     <p>MXN</p>
                    
                    </div>
                   
                  </li>
                  <li>
                    <div class="content__tienda_box-form-input">
                      <label class="content__form__box-label" for="txtCantidad">Cantidad: </label>
                      <input type="number" placeholder="Ingrese Cantidad" name="cantidad" class="content__form__box-input txtCantidad" id="txtCantidad-<?php echo $dato->id_producto?>" value="1" oninput="calcularTotal(<?php echo $dato->precio?>,'txtCantidad-<?php echo $dato->id_producto?>','txtTotal-<?php echo $dato->id_producto?>')" required>
                    </div>
                  </li>
                  <li class="item-total-list">
                    <p><strong>TOTAL:</strong></p>
                    <div class="content__tienda_box-form-total">
                      <p>$</p>
                      <p id="txtTotal-<?php echo $dato->id_producto?>" class="txtTotal"><?php echo $dato->precio?><span></span></p>
                      <p>MXN</p>
                    </div>
                   
                  </li>
                  <li>
                 
                  </li>
                </ul>
              </div>
            </div>
            <div class="content__tienda_box-form-input" >
            <input type="hidden" name="oculto" value=1>
                    <button type="submit" value="" class="content__form__box-cta" onclick="return confirmacion()" name="generar">Generar Pedido</button>

                    <a href="#" id="btn-cerrar-popup-bottom" class="content__form__box-cta" onclick="cerrarPopup('#comprar-<?php echo $dato->id_producto?>')">Cerrar</a>
            </div>
        </form>
        </div>
    <?php
      }
      ?>
      </div>
    <?php 
        }
      ?>  
  </div>
</div>
<?php
include './components/footer.php';
?>