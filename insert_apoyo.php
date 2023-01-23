<section class="content">
    <?php
        if(!isset($_POST['oculto'])){
            exit();
        }
        include 'model/conexion.php';
                $usuario = $_POST['usuario'];
                $nombre = $_POST['nombre'];
                $fecha = $_POST['fecha'];
                $programa = $_POST['programa'];
                $estatus = 'pendiente';
                $observaciones = $_POST['observaciones'];                
                $sentencia = $bd->prepare("INSERT INTO usuarios(usuario,password,nombre,nacionalidad,fnacimiento,domicilio,telefono,tipo,observaciones) VALUES (?,?,?,?,?,?,?,?,?);");
                $resultado = $sentencia->execute([$usuario,$pass,$nombre,$nacionalidad,$fnacimiento,$domicilio,$telefono,$tipoUsr,$observaciones]);
                if($resultado === TRUE){
                    echo "Se ha guardado correctamente el usuario: ".$usuario;
                }else{
                    echo "Ocurrio un error o el usuario ya existe. Favor de intentar más tarde o cambiar el usuario.";
                }      
    ?>
</section>

<?php include 'components/footer.php';?>