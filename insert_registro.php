<?php 
    //session_start();

    include 'components/head.php';
    include 'components/header.php';

?>
<section class="content">
    <?php
        if(!isset($_POST['oculto'])){
            exit();
        }
        include 'model/conexion.php';
        $longPass = strlen($_REQUEST['password1']);
        if($longPass < 8 || $longPass >12)
            { 
                echo 'La contraseña debe ser mayor a 8 caracteres y menor a 12'; 
            }else{
                $usuario = $_POST['usuario'];
                $nombre = $_POST['nombre'];
                $fnacimiento = $_POST['fnacimiento'];
                $nacionalidad = $_POST['nacionalidad'];
                $domicilio = $_POST['domicilio'];
                $telefono = $_POST['telefono'];
                $tipoUsr = $_POST['tipoUsuario'];
                $observaciones = $_POST['Observaciones'];
                $pass1 = $_POST['password1'];
                $pass2 = $_POST['password2'];
                if($pass1 == $pass2){
                    $pass = $pass1;
                    $sentencia = $bd->prepare("INSERT INTO usuarios(usuario,password,nombre,nacionalidad,fnacimiento,domicilio,telefono,perfil,observaciones) VALUES (?,?,?,?,?,?,?,?,?);");
                    $resultado = $sentencia->execute([$usuario,$pass,$nombre,$nacionalidad,$fnacimiento,$domicilio,$telefono,$tipoUsr,$observaciones]);
                    if($resultado === TRUE){
                        echo "Se ha guardado correctamente el usuario: ".$usuario;
                    }else{
                        echo "Ocurrio un error o el usuario ya existe. Favor de intentar más tarde o cambiar el usuario.";
                    }
                }else{
                    echo 'Las contraseñas no coinciden';
                }
            }
    ?>
</section>

<?php include 'components/footer.php';?>