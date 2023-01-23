<?php 
include './components/head.php';
include './components/header.php';
include 'model/conexion.php'

?>
   <div class="title__box">
    <h2 class="title__box__title">Tienda</h2>
    <div class="title__box__usr">
    </div>
</div>

<div class="content">
<div class="content__tienda">
    <?php
      $consulta = $bd->query("SELECT * FROM catalogo;");
      $taller = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach ($taller as $dato){
    ?>
      <div class="content__tienda_box">
        <p class="content__tienda_box-name"><?php echo $dato->descripcion?></p>
        <?php 
          $img = base64_encode($dato->imagen);                          
        ?>                       
        <img src="data:<?php echo $dato->tipoimagen?>;charset=utf8;base64,<?php echo $img;?>">
        <p class="content__tienda_box-fecha"><?php echo $dato->observaciones?></p>
        <span class="content__tienda_box-title"> Precio:</span>
        <p class="content__tienda_box-hora">$<?php  echo $dato->precio?></p>
      <?php 
      $existencia = $dato->existencia;
      if($existencia<=0){
        echo "No disponible";

      }else{?>
        <form action="insert_reg_taller.php" class="content__form content__form__taller" method="GET">
            <div class="content__form__box">
                <button type="submit" value="" class="content__form__box-cta">Comprar</button>
            </div>
        </form>
    <?php
      }
      ?>
       
      </div>
    <?php 
        }
      ?>  
  </div>
</div>
<?php
include './components/footer.php';
?>