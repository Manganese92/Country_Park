<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Nouveau bien </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="biens.php" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-chevron-left"></i>
            Retour
        </a>
    </div>
</div>

<?php
$libelle = isset($_POST['libelle']) ? $_POST['libelle'] : '';
$typeBienId = isset($_POST['typeBien']) ? $_POST['typeBien'] : '';
$dateDebut = isset($_POST['dateDebut']) ? $_POST['dateDebut'] : '';
$dateFin = isset($_POST['dateFin']) ? $_POST['dateFin'] : '';
$capacite = isset($_POST['capacite']) ? $_POST['capacite'] : '';
$prix = isset($_POST['prix']) ? $_POST['prix'] : '';
$descriptions = isset($_POST['descriptions']) ? $_POST['descriptions'] : '';
$typeBiens = get_all_type_biens();
$erreurs = array();

function get_error($key, $erreurs)
{
    return array_key_exists($key, $erreurs) ? $erreurs[$key] : '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libelle = htmlspecialchars(trim($libelle));
    $descriptions = htmlspecialchars(trim($descriptions));
    if (empty($libelle)) $erreurs['libelle'] = 'Libelle invalide';
    if (strlen($descriptions) < 100) $erreurs['descriptions'] = 'Description invalide invalide. Il faut au moins 100 caractères';
    if ($prix <= 0) $erreurs['prix'] = 'Prix invalide';
    $origin = date_create($dateDebut);
    $target = date_create($dateFin);
    $now = date_modify(date_create('now'), '-1 day');

    if ($origin < $now) {
        $erreurs['dateDebut'] = 'Date de debut invalide';
    }

    if ($origin >= $target) {
        $erreurs['dateFin'] = 'Date de fin invalide';
    }

    // Validation de la création des biens
    if (empty($erreurs)) {
        create_bien($libelle, $descriptions, $typeBienId, $capacite, $dateDebut, $dateFin, $prix);
        header('location: biens.php');
    }
}
?>

<form method="POST" action="biens.php?action=creer">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="libelle">Libelle</label>
                <input type="text" id="libelle" name="libelle" class="form-control <?= empty($erreurs['libelle']) ? '' : 'is-invalid' ?>" value="<?= $libelle ?>" required />
                <div class="invalid-feedback"><?= get_error('libelle', $erreurs) ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="description">Descriptions</label>
                <textarea class="form-control <?= empty($erreurs['descriptions']) ? '' : 'is-invalid' ?>" rows="10" name="descriptions" required><?= $descriptions ?></textarea>
                <div class="invalid-feedback"><?= get_error('descriptions', $erreurs) ?></div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-lg-6 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="typebien">Type</label>
                <select class="form-control <?= empty($erreurs['typebien']) ? '' : 'is-invalid' ?>" name="typeBien" required>
                    <?php
                    foreach ($typeBiens as $typeBien) {
                    ?>
                        <option <?= $typeBienId == $typeBien['id'] ? 'selected' : '' ?> value="<?= $typeBien['id'] ?>"><?= $typeBien['libelle'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="invalid-feedback"><?= get_error('typebien', $erreurs)  ?></div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-lg-3 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="capacite">Capacité</label>
                <input type="number" min="1" id="capacite" name="capacite" class="form-control <?= empty($erreurs['capacite']) ? '' : 'is-invalid' ?>" value="<?= $capacite ?>" required />
                <div class="invalid-feedback"><?= get_error('capacite', $erreurs) ?></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="prix">Prix</label>
                <input type="number" min="1" id="prix" step="0.01" name="prix" class="form-control <?= empty($erreurs['prix']) ? '' : 'is-invalid' ?>" value="<?= $prix ?>" required />
                <div class="invalid-feedback"><?= get_error('prix', $erreurs) ?></div>
            </div>
        </div>
    </div>
    
    <div class="row pt-3">
        <div class="col-lg-3 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="dateDebut">Date de debut</label>
                <input type="date" id="dateDebut" name="dateDebut" class="form-control <?= empty($erreurs['dateDebut']) ? '' : 'is-invalid' ?>" value="<?= $dateDebut ?>" required />
                <div class="invalid-feedback"><?= get_error('dateDebut', $erreurs) ?></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="form-outline flex-fill mb-0">
                <label class="form-label mb-1" for="dateFin">Date de fin</label>
                <input type="date" id="dateFin" name="dateFin" class="form-control <?= empty($erreurs['dateFin']) ? '' : 'is-invalid' ?>" value="<?= $dateFin ?>" required />
                <div class="invalid-feedback"><?= get_error('dateFin', $erreurs) ?></div>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-6 mt-3">
            <button type="submit" class="btn btn-primary ">Valider</button>
        </div>
    </div>
    </div>
</form>