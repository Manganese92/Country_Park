<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require_once ROOT_PATH . 'includes/db/reservation.sql.php';
require_once ROOT_PATH . 'includes/db/biens.sql.php';
require_once ROOT_PATH . 'includes/db/utilisateurs.sql.php';

if (!is_admin_connected()) {
  header('location: '.ROOT_PATH.'403.php');
}
?>
<div class="container-fluid">
  <div class="row">
    <?php require_once ROOT_PATH . 'includes/sections/admin_sidebar.php' ?>

    <?php
    if (!is_user_connected()) {
      header('location: index.php');
      return;
    }

    $allReservations = get_all_reservations();
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Réservations</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <th>#</th>
          <th>De</th>
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
          foreach ($allReservations as $reservation) {
            $now = date_create();
            $dateArrivee = date_create($reservation['arrivee']);
            $dateDepart = date_create($reservation['depart']);
            $user = get_utilisateur_by_id($reservation['userId']);
          ?>
            <tr>
              <td><?= $count ?></td>
              <td><?= $user['nom'] ?></td>
              <td>
                <?php
                $bien = get_bien_by_id($reservation['bienId']);
                ?>
                <a class="text-decoration-none text-dark" href="<?= BASE_URL.'bien.php?id=' . $bien['id'] ?>"><?= $bien['libelle']; ?> <i class="fa-solid fa-up-right-from-square"></i></a>
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
    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>