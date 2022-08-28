<?php
require 'includes/page_header.php';
require 'includes/sections/navbar.php';
require_once 'includes/db/utilisateurs.sql.php';


$utilisateur = get_utilisateur_by_id($_SESSION['id']);
?>

<div>
    <div class="container">
        <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
        <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>

        <h2>Voici le profil de <?= $utilisateur['nom']; ?></h2>
        <div>Quelques informations sur vous : </div>
        <ul>
            <li>Votre id est : <?= $utilisateur['id'] ?></li>
            <li>Votre mail est : <?= $utilisateur['email'] ?></li>
            <li>Votre compte a été crée le : <?= $utilisateur['datecreation'] ?></li>
        </ul>
    </div>
</div>
<?php require 'includes/page_footer.php' ?>