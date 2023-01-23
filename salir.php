<?php
session_start();
session_destroy();
include 'components/head.php';
include 'components/header.php';
?>

<section class="content">
    <h2 class="content__message">Se ha cerrado sesión exitosamente.</h2>
</section>

<?php 
header('Location: login.php');
include 'components/footer.php';
?>