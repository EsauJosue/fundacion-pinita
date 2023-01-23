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
                $usuario = $_POST['staff_usuario'];
                $nombre = $_POST['staff_nombre'];
                $fnacimiento = $_POST['staff_fnacimiento'];
                $nacionalidad = $_POST['staff_nacionalidad'];
                $domicilio = $_POST['staff_domicilio'];
                $email = $_POST['staff_email'];
                $telefono = $_POST['staff_telefono'];
                $perfil = $_POST['staff_perfilUsuario'];
                $observaciones = $_POST['staff_Observaciones'];
                $pass1 = $_POST['password1'];
                $pass2 = $_POST['password2'];
                $tuniversitario = $_POST['staff_TituloUniversitario'];
                $cedula = $_POST['staff_cedula'];
                if($pass1 == $pass2){
                    $pass = $pass1;
                    $sentencia = $bd->prepare("UPDATE staff SET password = ?,nombre = ?, perfil =?, direccion = ?,email = ?,telefono = ?,fecha_nacimiento = ?,nacionalidad = ?,observaciones = ?,titulo_universitario = ?,cedula = ? WHERE id_staff = ?;");
                    $resultado = $sentencia->execute([$pass,$nombre,$perfil,$domicilio,$email,$telefono,$fnacimiento,$nacionalidad,$observaciones,$tuniversitario,$cedula,$usuario]);
                    if($resultado === TRUE){
                        echo "Se ha guardado correctamente el usuario: ".$usuario;
                        header("Location: ctrl_staff.php", true, 303);
                    }else{
                        echo "Ocurrio un error en la transacción o el usuario ya existe. Favor de intentar más tarde o cambiar el usuario.";
                    }
                }else{
                    echo 'Las contraseñas no coinciden';
                }
            }
    ?>