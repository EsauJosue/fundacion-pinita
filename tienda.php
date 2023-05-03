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
<!-- FORMULARIO PARA REGISTRAR EL PEDIDO -->
        <div class="overlay">
          <div class="form" id="comprar-<?php echo $dato->id_producto?>">
            <h2>Generar Pedido</h2>
            <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup" onclick="cerrarPopup('#comprar-<?php echo $dato->id_producto?>')"><img src="/images/Iconos/xmark-solid.svg" alt=""></a>
            
            <form action="insert_pedido.php" class="form__small" method="POST" id="comprar-<?php echo $dato->id_producto?>">
            <!-- Columna 1 -->
            <div class="form__small__box">
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtCliente">Nombre del cliente: </label>
                <input type="text" placeholder="Ingrese el nombre" name="nombre" class="form__small__box__item-input" id="txtCliente" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtTelefono">Teléfono: </label>
                <input type="tel" placeholder="123-456-7891" name="telefono" class="form__small__box__item-input" id="txtTelefono" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtEmail">Email: </label>
                <input type="text" placeholder="name@email.com" name="email" class="form__small__box__item-input" id="txtEmail" required>
              </div>
          <h4>Datos de Envío</h4>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtCalle">Calle: </label>
                <input type="text" placeholder="Ingrese la calle" name="calle" class="form__small__box__item-input" id="txtCalle" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtNumero">Número: </label>
                <input type="text" placeholder="Ingrese número exterior e interior" name="numero" class="form__small__box__item-input" id="txtNumero" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtFraccionamiento">Fraccionamiento: </label>
                <input type="text" placeholder="Ingrese el fraccionamiento" name="fraccionamiento" class="form__small__box__item-input" id="txtFraccionamiento" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtCiudad">Ciudad: </label>
                <input type="text" placeholder="Ingrese Ciudad" name="ciudad" class="form__small__box__item-input" id="txtCiudad" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtEstado">Estado: </label>
                <input type="text" placeholder="Ingrese Estado" name="estado" class="form__small__box__item-input" id="txtEstado" required>
              </div>
              <div class="form__small__box__item">
                <label class="form__small__box__item-label" for="txtCP">C.P.: </label>
                <input type="text" placeholder="Ingrese Código Postal" name="cp" class="form__small__box__item-input" id="txtCP" required>
              </div>
            </div>
            <!-- Columna 2 -->
            <div class="form__small__box">
              <h4>Datos del producto</h4> 
              <div class="form__small__box__item content__tienda_box-form-details">
                <label class="form__small__box__item-label" for="idProd">Producto: </label>
                <input type="text" placeholder="Ingrese Código Postal" name="id_producto" class="form__small__box__item-input" id="idProd" value="<?php echo $dato->id_producto?>" readonly>
              
                <img class="content__box-img content__tienda_box-form-details-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
                <div class="content__tienda_box-form-details-text">
                  <ul>
                    <li>
                      <p>Descripción:</p>
                      <p><?php echo $dato->descripcion?></p>
                    </li>
                    <li>
                      <p>Observaciones:</p>
                      <p><?php echo $dato->observaciones?></p>
                    </li>
                    <li class="">
                      <p>Precio:</p>
                      <p>$</p> 
                      <p class="content__box-form-details-text-precio" id="txt-precio"><?php echo $dato->precio?></p>
                      <p>MXN</p>
                    </li>
                    <li>
                      
                        <p class="" for="txtCantidad">Cantidad: </p>
                        <input type="number" placeholder="Ingrese Cantidad" name="cantidad" class="form__small__box__item-input txtCantidad" id="txtCantidad-<?php echo $dato->id_producto?>" value="1" oninput="calcularTotal(<?php echo $dato->precio?>,'txtCantidad-<?php echo $dato->id_producto?>','txtTotal-<?php echo $dato->id_producto?>')" required>
                      
                    </li>
                    <li class="item-total-list">
                      <p><strong>TOTAL:</strong></p>
                        <p>$</p>
                        <p id="txtTotal-<?php echo $dato->id_producto?>" class="txtTotal"><?php echo $dato->precio?><span></span></p>
                        <p>MXN</p>
                    </li>
                  </ul>
                </div>
              </div>
              <input type="hidden" name="oculto" value=1>
              <div class="form__small__box__item">
                <button type="submit" value="" class="content__form__box-cta" onclick="return confirmacion()" name="generar">Generar Pedido</button>
                <a href="#" id="btn-cerrar-popup-bottom" onclick="cerrarPopup('#comprar-<?php echo $dato->id_producto?>')">Cerrar</a>
              </div>
            
            </div>
       
           
        </form>
      </div>  
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