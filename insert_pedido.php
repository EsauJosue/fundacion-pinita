<?php 
    //session_start();

    include 'components/head.php';
    include 'components/header.php';
    include './model/conexion.php';
?>
<?php
if(!isset($_POST['oculto'])){
    exit();
}
    $id_producto = $_POST['id_producto'];
    $fecha = date("Y/m/d");
    $nombreCliente = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $fraccionamiento = $_POST['fraccionamiento'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $cp = $_POST['cp'];
    $status = 'pendiente';
    $cantidad = $_POST['cantidad'];

    //Se realiza una consulta para los detalles del producto

    $consultaProducto = $bd->query("SELECT descripcion, observaciones, precio FROM catalogo WHERE id_producto = '$id_producto';");
    $producto = $consultaProducto->fetchAll(PDO::FETCH_OBJ);
    foreach ($producto as $dato){
    
        $precio = $dato->precio;
        $descripcion = $dato->descripcion;
        $observaciones = $dato->observaciones;
    
     }
        $total = $precio * $cantidad; 

        $sentenciam = $bd->prepare("INSERT INTO pedidos(fecha,nombreCliente,telefono,email,calle,numero,fraccionamiento,ciudad,estado,cp,id_producto,cantidad,total,estatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);"); 
        $res = $sentenciam->execute([$fecha,$nombreCliente,$telefono,$email,$calle,$numero,$fraccionamiento,$ciudad,$estado,$cp,$id_producto,$cantidad,$total,$status]);      
        if($res === TRUE){
            echo "Éxito";
            $id_generado = $bd->lastInsertId();
            //echo "El id de este pedido es: " . $id_generado;
            header("Location: pagoPedido.php?pedido=".$id_generado, true, 303);
        }else{
            echo "Error";
            header('Location: notificacion-error.php',true,303);
           
        }
?>
