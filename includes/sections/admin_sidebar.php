<?php
function navMenuActive($link) {
    return str_contains(strtolower($_SERVER['REQUEST_URI']), strtolower($link)) ? 'active' : '';
}
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/dashboard.php') ?>" aria-current="page" href="<?= BASE_URL ?>admin/dashboard.php">
                    <i class="fa-solid fa-house-chimney"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/biens.php') ?>" href="<?= BASE_URL ?>admin/biens.php"> 
                <i class="fa-solid fa-dumpster"></i> Biens 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/reservations.php') ?>" href="<?= BASE_URL ?>admin/reservations.php"> <i class="fa-solid fa-hotel"></i> Réservations </a>
            </li>


            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/commentaires.php') ?> " href="<?= BASE_URL ?>admin/commentaires.php">
                    <i class="fa-solid fa-comment"></i>
                    Commentaires
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/utilisateurs.php') ?> " href="<?= BASE_URL ?>admin/utilisateurs.php">
                    <i class="fa-solid fa-users-gear"></i>
                    Utilisateurs
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= navMenuActive('admin/typebiens.php') ?> " href="<?= BASE_URL ?>admin/typebiens.php">
                    <i class="fa-regular fa-rectangle-list"></i>
                    Type de biens
                </a>
            </li>

            <hr />
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>index.php">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Quitter le mode admin
                </a>
            </li>
        </ul>
    </div>
</nav>
