<?php
include 'components/head.php';
include './components/header.php';
include 'model/conexion.php';

$id_solicitud = $_GET['id'];
?>
<?php
    $consulta = $bd->query("SELECT estatus FROM solicitud_apoyo WHERE id_solicitud = '$id_solicitud';");
    $statusAct = $consulta->fetchAll(PDO::FETCH_OBJ);

      foreach ($statusAct as $dato){

       if($statusAct == 'rechazado'){
        echo 'La solicitud ya está rechazada';
       }else{
        $sentencia = $bd->prepare("UPDATE solicitud_apoyo SET estatus = ? WHERE id_solicitud = ?;");
        $resultado = $sentencia->execute(['rechazado',$id_solicitud]);
        if($resultado === TRUE){
            echo "Se ha actualizado correctamente la solicitud: ".$id_solicitud;
            header("Location: notificacion-confirmacion.php", true, 303);
        }else{
            echo "Ocurrio un error en la transacción.";
        }

       }  
    }  
include 'components/footer-staff.php';
    ?>