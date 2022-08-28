<?php
require 'includes/page_header.php';
require 'includes/sections/navbar.php';
require'includes/db/utilisateurs.sql.php';


$afficher_profil= get_utilisateur_by_id ();
?>

<div class=" bg-secondary">
    <div class="container">
        <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
        <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
        </div>

        <?php
          foreach ($afficher_profil as $infos_profil) {
        ?>
        <body>
            <h2>Voici le profil de <?= $infos_profil['nom']; ?></h2>
            <div>Quelques informations sur vous : </div>
            <ul>
                <li>Votre id est : <?= $infos_profil['id'] ?></li>
                <li>Votre mail est : <?= $infos_profil['mail'] ?></li>
                <li>Votre compte a été crée le : <?= $infos_profil['datecreation'] ?></li>
            </ul>
        </body>

        <?php
          }
        ?>

        <?php require 'includes/page_footer.php' ?>