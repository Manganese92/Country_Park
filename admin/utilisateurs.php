<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require_once '../includes/db/utilisateurs.sql.php';

$utilisateurs = liste_utilisateur();
?>
<div class="container-fluid">
  <div class="row">
    <?php //include_once(ROOT_PATH . 'includes/sections/admin_sidebar.php') 
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Utilisateurs</h1>
      </div>
      <table class="table table-striped">
        <thead>
          <th>#</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Statut</th>
          <th></th>
        </thead>
        <tbody>
          <?php
          $compte= 1;
          foreach ($utilisateurs as $utilisateur) {
          ?>
            <tr>
              <td><?=$compte?></td>
              <td><?= $utilisateur['nom'] ?></td>
              <td><?= $utilisateur['email'] ?></td>
              <td><?= $utilisateur['statut'] == 1 ? "Actif" : "Inactif" ?></td>
              <td>
              <div class="btn-group" role="group">
                <a href="?supp=<?= $utilisateur['id'] ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-trash-can"></i></a>
              </div>
              </td>
            </tr>
          <?php
      
          $compte++;
          }
          ?>
        </tbody>
      </table>



    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>