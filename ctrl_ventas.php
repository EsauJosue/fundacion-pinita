<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}elseif(isset($_SESSION['usuario'])){
include 'components/head.php';
include_once 'components/permisos-menu.php';
include './model/conexion.php'

?>
 <div class="title__box">
    <h2 class="title__box__title">Centro Ecommerce</h2>
    <div class="title__box__usr">
        <p class="title__box__usr-name"><strong>Usuario:</strong>  <?php  echo $_SESSION['nombreUsr'] ?></p>
        <p class="title__box__usr-perfil"><strong>Perfil:</strong> <?php  echo $_SESSION['perfilUsr'] ?></p>

    </div>
</div>

    <div class="content">
        <?php include 'sidebar-ecommerce.php';?>
    <div class="content__list">
            <?php 
                $consulta = $bd->query("SELECT * FROM pedidos ORDER BY id_pedido");
                $apoyos = $consulta->fetchAll(PDO::FETCH_OBJ);
            ?>
        <section class="content__list__section">
        <h3>Pedidos</h3>
    
            <?php 
            if(!$apoyos){
                echo 'No existen solicitudes de apoyo';
            }else{
                ?>
            <table class="content__list__section-table">
                <thead>
                    <tr>
                    <th>Pedido</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Envio</th>
                    <th>Total</th>
                    <th>Observaciones</th>
                    <th>Surtir</th>
                    <th>Rechazar</th>
                    <th>Ver Información</th>
                    </tr>
                </thead>
                <?php
                    foreach ($apoyos as $dato){
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $dato->id_pedido ?></td>
                                <td><?php echo $dato->fecha ?></td>
                                <td><?php echo $dato->nombreCliente ?></td>
                                <td><?php echo $dato->direccion_envio ?></td>
                                <td><?php echo $dato->total ?></td>
                                <td width="50px"><?php echo $dato->observaciones ?></td>
                                <td><?php echo $dato->estatus ?></td>
                                <td><a href="#?id=<?php echo $dato->id_usuario?>"><img src="/images/aceptado.svg" alt=""></a></td>
                                <td><a href="#?id=<?php echo $dato->id_usuario?>"><img src="/images/delete.svg" alt=""></a></td>
                                <td><a href="verBeneficiario.php?id=<?php echo $dato->id_usuario?>"><img src="/images/information.svg" alt=""></a></td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>  
                </table>
        </section>    
            <?php
            }
            ?>
            <?php
            include 'footer.php';
            ?>
    </div>
</div>
<?php
}else{
    echo "Error en el Sistema";
}
include './components/footer.php';
?>