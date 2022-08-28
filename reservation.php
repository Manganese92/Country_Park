<?php
require_once 'includes/page_header.php';
require_once 'includes/sections/navbar.php';
require_once 'includes/db/biens.sql.php';
require_once 'includes/db/type-biens.sql.php';
?>

<?php
if (!is_user_connected()) {
    header('location: index.php');
    return;
}

$myReservations = get_current_user_reservations();
?>

<div class="container">
    <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
    <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>

    <h3 class="mb-4">Mes réservations</h3>

    <table class="table ">
        <thead>
            <th>#</th>
            <th>Libelle</th>
            <th>Du</th>
            <th>Au</th>
            <th>Voyageurs</th>
            <th>Prix</th>
            <th>Statut</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $count = 1;
            foreach ($myReservations as $reservation) {
                $now = date_create();
                $dateArrivee = date_create($reservation['arrivee']);
                $dateDepart = date_create($reservation['depart']);
                
            ?>
                <tr>
                    <td><?= $count ?></td>
                    <td>
                    <?php
                        $bien = get_bien_by_id($reservation['bienId']);
                    ?>
                    <a class="text-decoration-none text-dark" href="<?= 'bien.php?id='.$bien['id'] ?>"><?= $bien['libelle']; ?> <i class="fa-solid fa-up-right-from-square"></i></a>
                    </td>
                    <td><?= date_format(date_create($reservation['arrivee']), 'd M Y') ?></td>
                    <td><?= date_format(date_create($reservation['depart']), 'd M Y') ?></td>
                    <td><?= $reservation['voyageurs'] ?></td>
                    <td><?= $reservation['prixTotal'] ?> €</td>
                    <td>
                        <?php if ($now < $dateArrivee) { ?><span class="badge bg-info"> Non demarrée</span> <?php } ?>
                        <?php if ($now >= $dateArrivee && $now <= $dateDepart) { ?><span class="badge bg-success">En cours...</span> <?php } ?>
                        <?php if ($now > $dateDepart) { ?><span class="badge bg-dark">Terminée</span> <?php } ?>
                    </td>
                    <td></td>
                </tr>
            <?php
            $count++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php require 'includes/page_footer.php' ?>