<?php
include 'components/head.php';
include './model/conexion.php';
include './components/header.php';
$pedido = $_GET['pedido'];
?>

  <div class="title__box">
    <h2 class="title__box__title">Pago de pedido</h2>
    <!-- <div class="title__box__usr">
      <h3>Orden #: <?php //echo $pedido; ?></h3>
    </div> -->
  </div>
  <div class="content">
    <div class="content__pasarela">
      <?php
       $consulta = $bd->query("SELECT id_pedido, fecha, nombreCliente,id_producto, cantidad, total FROM pedidos WHERE id_pedido = '$pedido';");
       $pedido = $consulta->fetchAll(PDO::FETCH_OBJ);
         foreach ($pedido as $dato){
          $producto = $dato -> id_producto;
      ?>
      <div class="content__pasarela_box">
        <p class="content__pasarela_box-pedido">
          <strong>Pedido: </strong><?php echo $dato -> id_pedido?>
        </p>
        <p class="content__pasarela_box-fecha">
          <strong>Fecha: </strong><?php echo $dato -> fecha?>
        </p>
        <p class="content__pasarela_box-nombreCliente">
          <strong>Cliente: </strong><?php echo $dato -> nombreCliente?>
        </p>
        <h3 class="content__pasarela_box-titleProducto">Detalles del producto</h3>

        <div class="content__pasarela_box_producto">

          <p class="content__pasarela_box-producto-id">
            <strong></strong><?php echo $producto?>
          </p>
          <p class="content__pasarela_box-producto-descripcion">
            <strong></strong><?php 
            $consultaProd = $bd->query("SELECT descripcion, imagen, tipoimagen FROM catalogo WHERE id_producto = '$producto';");
            $articulo = $consultaProd->fetchAll(PDO::FETCH_OBJ);
            foreach ($articulo as $datoArticulo){
            echo $datoArticulo -> descripcion;
            $imagen_decodificada = base64_encode($datoArticulo->imagen);
            ?>
          </p>
          <img class="content__pasarela_box_producto-imagen" src="data:<?php echo "$datoArticulo->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
          <?php
            }
          ?>
        </div>
      
        <p class="content__pasarela_box-cantidad">
          <strong>Cantidad: </strong><?php echo $dato -> cantidad?>
        </p>
        <p class="content__pasarela_box-total">
          <strong>Total a Pagar: </strong>$<?php echo $dato -> total?>
        </p>
      </div>
      <script data-sdk-integration-source="integrationbuilder_sc"></script>
    <div id="paypal-button-container"></div>
    <script src="https://www.paypal.com/sdk/js?client-id=AQRQKhJPYEIZbfiHFUNxja3OccWYaGPYt2DFCNWnS4qGdbBYM4FbeoEGQZadPlWsqON1uYRZOpH_VC3I"></script>
    <script>
      paypal
        .Buttons({
          createOrder: async (data, actions) => {
            const response = await fetch("/orders", {
              method: "POST",
            });
            const details = await response.json();
            return details.id;
          },
          onApprove: async (data, actions) => {
            const response = await fetch(`/orders/${data.orderID}/capture`, {
              method: "POST",
            });
            const details = await response.json();
            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you

            // This example reads a v2/checkout/orders capture response, propagated from the server
            // You could use a different API or structure for your 'orderData'

            const errorDetail =
              Array.isArray(details.details) && details.details[0];
            if (errorDetail && errorDetail.issue === "INSTRUMENT_DECLINED") {
              return actions.restart(); // Recoverable state, per:
              // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
            }

            if (errorDetail) {
              let msg = "Sorry, your transaction could not be processed.";
              if (errorDetail.description)
                msg += "\n\n" + errorDetail.description;
              if (details.debug_id) msg += " (" + details.debug_id + ")";
              return alert(msg); // Show a failure message (try to avoid alerts in production environments)
            }

            // Successful capture! For demo purposes:
            console.log(
              "Capture result",
              details,
              JSON.stringify(details, null, 2)
            );
            const transaction = details.purchase_units[0].payments.captures[0];
            alert(
              "Transaction " +
                transaction.status +
                ": " +
                transaction.id +
                "\n\nSee console for all available details"
            );
          },
        })
        .render("#paypal-button-container");
    </script>
    </div>
  </div>
<?php
}
include './components/footer.php';
?>
