<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require_once '../includes/db/utilisateurs.sql.php';

$utilisateurs = liste_utilisateur($nom, $email, $statut);
?>
<div class="container-fluid">
  <div class="row">
    <?php //include_once(ROOT_PATH . 'includes/sections/admin_sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Utilisateurs</h1>
      </div>

      <tr>
        <td><?=$utilisateurs['nom']?></td>
        <td><?=$utilisateurs['email']?></td>
        <td><?=$utilisateurs['statut']?></td>
      </tr>
      
    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>