<?php
$typeBien = get_type_bien_by_id($_GET['edit']);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Modification </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="typebiens.php" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-chevron-left"></i>
            Retour
        </a>
    </div>
</div>

<form method="POST" action="typebiens.php">
    <div class="row">
        <div class="col-6">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="nom">Libelle</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?= $typeBien['libelle'] ?>" required />
                <input type="hidden" id="id" name="id" class="form-control" value="<?= $typeBien['id'] ?>" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3">
            <button type="submit" class="btn btn-primary ">Valider</button>
        </div>
    </div>
    </div>
</form>