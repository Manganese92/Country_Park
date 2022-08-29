<?php
require_once '../includes/page_header.php';
require_once ROOT_PATH . 'includes/sections/admin_navbar.php';
require_once ROOT_PATH . 'includes/db/type-biens.sql.php';
require_once ROOT_PATH . 'includes/db/utilisateurs.sql.php';

if (!is_admin_connected()) {
  header('location: '.ROOT_PATH.'403.php');
}
?>
<div class="container-fluid">
  <div class="row">
    <?php include_once(ROOT_PATH . 'includes/sections/admin_sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <?php
      if (isset($_GET['action']) && $_GET['action'] == "edit") {
        require_once 'includes/type-bien-editer.inc.php';
      } else if (isset($_GET['action']) && $_GET['action'] == "creer") {
        require_once 'includes/type-bien-creer.inc.php';
      } else {
        require_once 'includes/type-bien-liste.inc.php';
      }
      ?>
    </main>
  </div>
</div>
<?php require_once '../includes/page_footer.php' ?>
