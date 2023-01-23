<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
    $perfil = $_SESSION['perfilUsr'];

    switch($perfil){
        case 'beneficiario':
            include 'components/headerUsr-beneficiario.php';
            break;
        case 'benefactor':
            include 'components/headerUsr-benefactor.php';
            break;
        case 'invitado':
            include 'components/headerUsr-invitado.php';
            break;
        case 'voluntario':
            include 'components/headerUsr-invitado.php';
            break;
        case 'administrador':
            include 'components/headerUsr-admin.php';
            break;
        case 'moderador':
            include 'components/headerUsr-moderador.php';
            break;
        case 'profesional':
            include 'components/headerUsr-moderador.php';
            break;
    }

    // if($perfil == "administrador"){
    //     include 'components/headerUsr-admin.php';
    //     echo $perfil;
    // }

}