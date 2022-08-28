<?php
require_once ROOT_PATH."includes/db/utilisateurs.sql.php";
require_once ROOT_PATH."includes/db/reservation.sql.php";

if (is_user_connected()) {
    $user = get_utilisateur($_SESSION['email']);
?>
    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/Manganese92.png" alt="willf80" width="32" height="32" class="rounded-circle">
            <?= $user['nom'] ?>
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="<?= BASE_URL ?>profil.php">Profil</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>reservation.php">Mes réservations</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/dashboard.php">Administration</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>deconnexion.php">Se déconnecter</a></li>
        </ul>
    </div>
<?php
} else {
?>
    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://eyeklinik.com/en/wp-content/uploads/sites/3/2019/10/26-268559_profile-picture-placeholder-round-1.png" alt="willf80" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item fw-bold" href="<?= BASE_URL ?>inscription.php">Inscription</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL ?>connexion.php">Connexion</a></li>
        </ul>
    </div>
<?php
}
?>