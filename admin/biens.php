<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require ROOT_PATH . 'includes/db/biens.sql.php';
?>
<div class="container-fluid">
  <div class="row">
    <?php include_once(ROOT_PATH . 'includes/sections/admin_sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Biens</h3>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-primary">
            Nouveau bien
            <i class="fa-solid fa-plus"></i>
          </button>
        </div>
      </div>

      <?php
      $biens = get_all_biens();
      ?>

      <table class="table table-hover caption-top align-middle table-striped">
        <caption>Liste des biens</caption>
        <thead>
          <th>Nom</th>
          <th>Type</th>
          <th>Date debut</th>
          <th>Date fin</th>
          <th>Prix</th>
          <th></th>
        </thead>
        <tbody>
          <?php
          foreach ($biens as $bien) {
          ?>
            <tr>
              <td class="text-dark"><?= $bien['libelle'] ?></td>
              <td class="text-dark">Mobile home</td>
              <td class="text-dark"><?= $bien['datedebut'] ?></td>
              <td class="text-dark"><?= $bien['datefin'] ?></td>
              <td class="text-dark">
                <span class="text-dark"><?= $bien['prix'] ?> €</span> nuit
              </td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                  <button type="button" class="btn btn-sm btn-light"><i class="fa-solid fa-pencil"></i></button>
                  <button type="button" class="btn btn-sm btn-light"><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>