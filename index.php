<?php 
include './components/head.php';
include './components/header.php';
include 'model/conexion.php'

?>



<div class="contentIndex">
<div class="contentIndex__slide">
    <picture class="contentIndex__slide-img">
    <source media="(min-width:1110px)" srcset="/images/slide-Desktop-1920x466.jpg"/>
    <source media="(min-width:768px)" srcset="/images/slideTablet-1028x466.jpg"/>
    <img class="" src="/images/slide-tablet-528x776.jpg" alt="Imgagen de pallets"/>
    </picture>
    <div class="contentIndex__slide-txt">
        <h1>Fundación Pinita</h1>
        <p>Más que <strong>Sonrisas</strong></p>
    </div>

</div>
    <div class="contentIndex__blog">
    <?php
      $consulta = $bd->query("SELECT id_post, titulo, extracto, imagen, tipoimagen, id_staff,fecha FROM blogpost ORDER BY id_post DESC;");
      $post = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($post as $dato){

    ?>
        <div class="contentIndex__blog_box">
            <h2 class="contentIndex__blog_box-title"><?php echo $dato->titulo?></h2>
            <?php 
                $imagen_decodificada = base64_encode($dato->imagen);
            ?>                       
            <img class="contentIndex__blog_box-img" src="data:<?php echo "$dato->tipoimagen"?>;base64,<?php echo $imagen_decodificada;?>" alt="Imagen">
            <p class="contentIndex__blog_box-autor"><strong> Autor: </strong><?php echo $dato->id_staff?></p>
            <p class="contentIndex__blog_box-fecha"><strong>Fecha: </strong> <?php echo $dato->fecha?></p>
            <p class="contentIndex__blog_box-extracto"><?php echo $dato->extracto?></p>

            <a class="contentIndex__blog_box-link" href="single.php?id=<?php echo $dato->id_post?>">Ver más...</a>
        </div>
<?php }?>
    </div>
</div>
   
     
<?php
        
include './components/footer.php';
?>