<?php 
include './components/head.php';
include './components/header.php';
include 'model/conexion.php'
?>

<div class="title__box">
    <h2 class="title__box__title">Fundación Pinita</h2>
</div>
<div class="content">
    <div class="content__blog">
    <?php
      $consulta = $bd->query("SELECT id_post, titulo, extracto, imagen, tipoimagen, id_staff,fecha FROM blogpost ORDER BY id_post DESC;");
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
            <p class="content__blog_box-extracto"><?php echo $dato->extracto?></p>

            <a class="content__blog_box-link" href="single.php/">Ver más...</a>
        </div>

    </div>
</div>
   
     
<?php
        }
include './components/footer.php';
?>
Nuestra CDC is delighted to join our partner OppCo in sharing the exciting news that Kathy McGilvray will fill the role of OppCo CEO. Kathy’s experience at MHIC as a manager and leader in the community development finance sector and her deep knowledge of Masschusetts CDCs are strengths that will benefit OppCo’s next phase of growth and development.