<?php 
    //session_start();

    include 'components/head.php';
    include 'components/header.php';

?>
<section class="content">
<div class="content__operation">
    <?php
        if(!isset($_POST['oculto'])){
            exit();
        }
        include 'model/conexion.php';
        $password = $_POST['password1'];
        
        if (preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,12}$/', $password)) {
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
                        ?>
                            <a href="http://localhost:8888/login.php" id="btn-cerrar-popup-bottom">Iniciar Sesión</a>
                    <?php
                    }else{
                        echo "Ocurrio un error o el usuario ya existe. Favor de intentar más tarde o cambiar el usuario.";
                    }
                }else{
                    echo 'Las contraseñas no coinciden';
                }
            }else {
                echo "La contraseña no cumple con los requisitos, favor de ingresar una contraseña válida.";
                ?>
                    <a href="#" id="btn-cerrar-popup-bottom" onclick="regresar()">Regresar</a>
                <?php
            }

    ?>
     </div>
</section>

<?php include 'components/footer.php';?>