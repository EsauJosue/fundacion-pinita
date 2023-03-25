<?php 
include './components/head.php';
include './components/header.php';
include 'model/conexion.php';
$id_post = $_GET['id'];
?>
<div class="content">
    <div class="content__blog">
    <?php
      $consulta = $bd->query("SELECT id_post, titulo, contenido, imagen, tipoimagen, id_staff,fecha FROM blogpost WHERE id_post = '$id_post'");
      $post = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($post as $dato){

    ?>
        <div class="content__blog_box">
            <h2 class="content__blog_box-title"><?php echo $dato->titulo?></h2>
            <?php 
                $imagen_decodificada = base64_encode($dato->imagen);
            ?>                       
            <img class="content__blog_box-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
            <p class="content__blog_box-autor"><strong> Autor: </strong><?php echo $dato->id_staff?></p>
            <p class="content__blog_box-fecha"><strong>Fecha: </strong> <?php echo $dato->fecha?></p>
            <p class="content__blog_box-extracto"><?php echo $dato->contenido?></p>
        </div>
        <button class="btn-regresar" onclick="regresar()">Regresar</button>

    </div>
</div>
   
     
<?php
        }
include './components/footer.php';
?>
