<?php 
        if(isset($_REQUEST['guardar'])){
            if(isset($_FILES['foto']['name'])){
                $tipoArchivo = $_FILES['foto']['type'];
                $nombreArchivo=$_FILES['foto']['name'];
                $tamanoArchivo=$_FILES['foto']['size'];
                $imagen=fopen($_FILES['foto']['tmp_name'],'r');
                $binarios=fread($imagen,$tamanoArchivo);
            }
        }
    
    ?>