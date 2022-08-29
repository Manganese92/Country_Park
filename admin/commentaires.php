<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require_once ROOT_PATH . 'includes/db/utilisateurs.sql.php';

if (!is_admin_connected()) {
  header('location: '.ROOT_PATH.'403.php');
}
?>
<div class="container-fluid">
  <div class="row">
    <?php include_once(ROOT_PATH . 'includes/sections/admin_sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Commentaires</h1>
      </div>

      
    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>