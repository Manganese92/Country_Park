<?php
require 'includes/page_header.php';
require 'includes/sections/navbar.php';
require 'includes/db/biens.sql.php';
require 'includes/db/type-biens.sql.php';
?>

<div class="container">
  <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
  <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>
  <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
    <?php
    $biens = get_all_biens();

    foreach ($biens as $bien) {
    ?>
      <a href="bien.php?id=<?= $bien['id'] ?>" class="div col mb-4 text-decoration-none text-dark">
        <div class="card h-100">
          <img src="assets/imgs/placeholder-500x500-1.jpeg" class="card-img-top" alt="<?= $bien['libelle'] ?>">
          <div class="card-body">
            <p class="card-title text-truncate mb-0 fw-bold p-0"><?= $bien['libelle'] ?></p>
            <p class="card-subtitle p-0 m-0">
              <?php
              $typeBien = get_type_bien_by_id($bien['typebien']);
              if (!empty($typeBien)) {
                echo $typeBien['libelle'];
              }
              ?>
            </p>
            <p class="text-muted p-0 m-0"><?= $bien['datedebut'] . ' - ' . $bien['datefin'] ?></p>
            <p class="text-muted p-0 m-0">
              <span class="text-dark"><?= $bien['prix'] ?> €</span> nuit
            </p>
          </div>
        </div>
      </a>
    <?php
    }
    ?>

  </div>
</div>

<?php require 'includes/page_footer.php' ?>