<?php
require_once "includes/db/utilisateurs.sql.php";

if (is_user_connected()) {
    $user = get_utilisateur($_SESSION['email']);
?>
    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/willf80.png" alt="willf80" width="32" height="32" class="rounded-circle">
            <?= $user['nom'] ?>
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="inscription.php">Profil</a></li>
            <li><a class="dropdown-item" href="inscription.php">Mes reservations</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="inscription.php">A propos</a></li>
            <li><a class="dropdown-item" href="deconnexion.php">Se déconnecter</a></li>
        </ul>
    </div>
<?php
} else {
?>
    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/willf80.png" alt="willf80" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item fw-bold" href="inscription.php">Inscription</a></li>
            <li><a class="dropdown-item" href="connexion.php">Connexion</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">A propos</a></li>
        </ul>
    </div>
<?php
}
?>