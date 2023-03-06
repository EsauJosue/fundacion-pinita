<?php
$dbname='pinitadb';
$user='useradmin';
$password='TjITGMl61u6Lpn9U';
$db_host="localhost";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
try{
    $bd = new PDO(
        'mysql:host=localhost;
        dbname='.$dbname,
        $user,
        $password,
        $options
    );

    }catch(Exception $e){
        
        echo "Error de conexión ". $e->getMessage();
    }

?>  