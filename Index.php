<?php
require 'includes/page_header.php';
require 'includes/sections/navbar.php';
require 'includes/db/biens.sql.php';
?>

<div class="container">
  <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
  <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>
  <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
    <?php
    $biens = get_all_biens();
    
    foreach ($biens as $bien) {
    ?>
      <div class="col mb-4">
        <div class="card h-100">
          <img src="https://a0.muscache.com/im/pictures/333e3ef0-9334-4d9b-95e8-622db0216afe.jpg?im_w=720" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title text-truncate mb-0 fw-bold p-0"><?= $bien['libelle'] ?></p>
            <p class="card-subtitle p-0 m-0">Mobile home</p>
            <p class="text-muted p-0 m-0"><?= $bien['datedebut'] . ' - ' . $bien['datefin'] ?></p>
            <p class="text-muted p-0 m-0">
              <span class="text-dark"><?= $bien['prix'] ?> €</span> nuit
            </p>
          </div>
        </div>
      </div>
    <?php
    }
    ?>

  </div>
</div>

<?php require 'includes/page_footer.php' ?>
