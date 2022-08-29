<?php
require_once '../includes/page_header.php';
require_once '../includes/sections/admin_navbar.php';
require_once '../includes/db/utilisateurs.sql.php';
?>

<?php
if (!is_admin_connected()) {
  header('location: '.ROOT_PATH.'403.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['edit']) && $_GET['edit'] > 0) {
  $id = $_POST['id'];
  $nom = htmlspecialchars(trim($_POST['nom']));
  $profil = null;
  if (isset($_POST['profil'])) {
    $profil = $_POST['profil'];
  }

  modifier_utilisateur($id, $nom, $profil);
  header('location: utilisateurs.php');
}

$utilisateurs = liste_utilisateur();
?>
<div class="container-fluid">
  <div class="row">
    <?php include_once('../includes/sections/admin_sidebar.php')
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
          <th>Profil</th>
          <th>Statut</th>
          <th></th>
        </thead>
        <tbody>
          <?php
          $compte = 1;
          foreach ($utilisateurs as $utilisateur) {
          ?>
            <tr>
              <td><?= $compte ?></td>
              <td><?= $utilisateur['nom'] ?></td>
              <td><?= $utilisateur['email'] ?></td>
              <td><?= $utilisateur['profil'] == 1 ? 'Admin' : 'Utilisateur' ?></td>
              <td><?= $utilisateur['statut'] == 1 ? '<i class="fa-solid fa-user-unlock"></i> actif' : '<i class="fa-solid fa-lock"></i> inactif' ?></td>
              <td>
                <div class="btn-group" role="group">
                  <button id="openEditModal" type="button" data-id="<?= $utilisateur['id'] ?>" data-profil="<?= $utilisateur['profil'] ?>" data-nom="<?= $utilisateur['nom'] ?>" data-email="<?= $utilisateur['email'] ?>" data-statut="<?= $utilisateur['statut'] == 1 ? 'Actif' : 'Inactif' ?>" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#UserModal">
                    <i class="fa-solid fa-user-pen"></i> Editer
                  </button>
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


<div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="userForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="UserModalLabel">Infos profil </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 mb-3">
              <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" />
                <input type="hidden" id="id" name="id" class="form-control" />
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" disabled />
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="statut">Statut</label>
                <input type="text" id="statut" name="statut" class="form-control" disabled />
              </div>
            </div>
            
            <div class="col-12">
              <div class="form-outline flex-fill mb-0 mt-3">
                <label class="form-label mb-1" for="profil">Profil</label>
                <select id="profil" name="profil" class="form-control" >
                  <option value="0">Utilisateur</option>
                  <option value="1">Admin</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" id="validerEditUserModal" class="btn btn-danger">Valider les modifications</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  (function() {
    document.querySelector("#openEditModal").onclick = function() {
      document.querySelector("#id").value = this.dataset.id;
      document.querySelector("#nom").value = this.dataset.nom;
      document.querySelector("#email").value = this.dataset.email;
      document.querySelector("#statut").value = this.dataset.statut;
      document.querySelector("#userForm").setAttribute('action', `?edit=${this.dataset.id}`)

      const profilElem = document.querySelector("#profil");
      profilElem.value = this.dataset.profil;
      if (+this.dataset.id === <?= $_SESSION['id'] ?>) {
        profilElem.setAttribute('disabled', true);
      } else {
        profilElem.removeAttribute('disabled');
      }
    }
  })();
</script>

<?php require_once '../includes/page_footer.php' ?>