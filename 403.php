<?php
require 'includes/page_header.php';
require 'includes/sections/navbar.php';
?>

<div>
    <div class="container text-center">
        <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
        <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>

        <h2 class="text-center">Accès non autorisé !</h2>
        <img src="<?= ROOT_PATH. 'assets/imgs/403.png' ?>" alt="403"></img>

        <a href="index.php" class="text-dark d-block mt-4">Retour à la page d'accueil</a>
    </div>
</div>

<?php require 'includes/page_footer.php' ?>