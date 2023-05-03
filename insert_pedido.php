<?php 
    //session_start();

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'email/phpmailer/src/PHPMailer.php';
require 'email/phpmailer/src/SMTP.php';
require 'email/phpmailer/src/Exception.php';

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
        $total = $precio * $cantidad; 


        $sentenciam = $bd->prepare("INSERT INTO pedidos(fecha,nombreCliente,telefono,email,calle,numero,fraccionamiento,ciudad,estado,cp,id_producto,cantidad,total,estatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);"); 
        $res = $sentenciam->execute([$fecha,$nombreCliente,$telefono,$email,$calle,$numero,$fraccionamiento,$ciudad,$estado,$cp,$id_producto,$cantidad,$total,$status]);      
        if($res === TRUE){
            echo "Éxito";
            $id_generado = $bd->lastInsertId();
            //echo "El id de este pedido es: " . $id_generado;
            $mail = new PHPMailer(true);
                try{
                    //$mail ->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail ->isSMTP();
                    $mail ->Host = 'mail.fundacionpinita.org';
                    $mail ->SMTPAuth = true;
                    $mail ->Username = 'contacto@fundacionpinita.org';
                    $mail ->Password = 't1(}@DXB903R';
                    $mail ->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail ->Port = 587;
                    $mail -> CharSet = 'UTF-8';
                    $mail->addCustomHeader('Content-Type: text/html; charset=UTF-8');
                    $mail->setFrom('contacto@fundacionpinita.org','FUNDACIÓN PINITA'); 
                    $mail->addAddress($email,'FUNDACIÓN PINITA');
                    $mail->addCC('contacto@fundacionpinita.org');
                    $mail->isHTML(true);
                    $mail->Subject = 'Pedido Generado Exitosamente';
                    $mail->Body = '
                                <h1>Se ha registrado su pedido</h1>
                                <hr>
                                <h2>Datos del cliente: </h2>
                                <p> Nombre: '. $nombreCliente . '</p>
                                <p> Pedido: '. $id_generado . '</p>
                                <h2>Datos de envío: </h2>
                                <p> Dirección: '. $calle . ' '. $numero. ' ' .$fraccionamiento. '</p>
                                <h2>Datos del artículo: </h2>
                                <p>'. $descripcion . '</p>
                                <p> Cantidad: '. $cantidad . '</p>
                                <p> Total: $'. $total . 'MXN</p>
                                <hr>
                                <a style="background-color: #2980b9; color: #ecf0f1; width: 125px; border-radius: 10px; margin: 10px auto; text-align: center; display:block; height: 35px; padding: 5px; display:flex; justify-content: center; align-items: center;" href="http://localhost:8888/pasarela-pago.php?pedido='.$id_generado.'">Pagar pedido</a>

                                  ';
                    $mail->send();
                    header("Location: pagoPedido.php?pedido=".$id_generado, true, 303);
                }catch(GlobalException $e){
                    echo 'Mensaje ' . $mail->ErrorInfo;
                }

        }else{
            echo "Error";
            header('Location: notificacion-error.php',true,303);
           
        }
    
     }

       
?>

