<?php 
require 'includes/page_header.php';
require 'includes/db/biens.sql.php';

$biens = get_all_biens();

include 'includes/sections/navbar.php';
?>

<div class="container">
  <!-- <h1>Liste des biens</h1> -->

  <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
    
    <?php
    foreach ($biens as $bien) {
    ?>
      <div class="col mb-4">
        <div class="card h-100">
          <img src="https://a0.muscache.com/im/pictures/333e3ef0-9334-4d9b-95e8-622db0216afe.jpg?im_w=720" class="card-img-top" alt="...">
          <div class="card-body">
            <h6 class="card-title text-truncate"><?= $bien['libelle'] ?></h6>
            <p class="card-text p-0 m-0">Mobile home</p>
            <p class="card-text p-0 m-0"><?= $bien['datedebut'].' - '.$bien['datefin'] ?></p>
            <p class="card-text">
            <span class="text-success"><?= $bien['prix'] ?> €</span>
            nuit
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
