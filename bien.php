<?php
require_once 'includes/page_header.php';
require_once 'includes/sections/navbar.php';
require_once 'includes/db/biens.sql.php';
require_once 'includes/db/type-biens.sql.php';
require_once 'includes/db/reservation.sql.php';
require_once 'includes/db/services.sql.php';
?>

<?php
if (!isset($_GET['id']) || $_GET['id'] < 1) {
    header('location: index.php');
    return;
}

$bien = get_bien_by_id($_GET['id']);
if (!isset($bien)) {
    header('location: index.php');
    return;
}
$typeBien = get_type_bien_by_id($bien['typebien']);
$arrivee = '';
$depart = '';
$voyageurs = 1;
$servicesSelected = array();
$services = get_services_by_id($bien['id']);
$reservationOk = false;

if (isset($_SESSION['reservation'])) {
    $arrivee = $_SESSION['reservation']['dateDebut'];
    $depart = $_SESSION['reservation']['dateFin'];
    $voyageurs = $_SESSION['reservation']['voyageurs'];
    $servicesSelected = isset($_SESSION['reservation']['services']) ? $_SESSION['reservation']['services'] : array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!is_user_connected()) {
        $_SESSION['redirect_after_connexion'] = 'bien.php?id=' . $bien['id'];
        $_SESSION['reservation'] = $_POST;
        header('location: connexion.php');
    } else {
        $arrivee = $_POST['dateDebut'];
        $depart = $_POST['dateFin'];
        $voyageurs = $_POST['voyageurs'];
        $servicesSelected = isset($_POST['services']) ? $_POST['services'] : array();

        reserver($arrivee, $depart, $voyageurs, $bien, $servicesSelected);
        unset($_SESSION['reservation']);
        $reservationOk = true;
    }
}
?>

<?php
if ($reservationOk) {
?>
    <div class="container">
        <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
        <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>

        <h3>Votre réservation a été effectuée avec succès !</h3>
        <p><i class="fa-solid fa-calendar-days"></i> Annulation gratuite avant le <?= date_format(date_modify(date_create($depart), '-2 days'), 'd-m-Y') ?></p>

        <a href="index.php" class="btn btn-danger"><i class="fa-solid fa-chevron-left"></i> Page d'accueil</a>
    </div>
<?php
} else {
?>
    <div class="container">
        <div class="mb-sm-4 d-lg-none" style="padding-bottom: 100px;"></div>
        <div class="mb-sm-4 d-block" style="padding-bottom: 80px;"></div>
        <section class="row">
            <div class="col-12 text-center" style="max-height: 400px; overflow: hidden;">
                <img width="100%" src="assets/imgs/placeholder-500x500-1.jpeg" />
            </div>
        </section>
        <section class="row mt-4">
            <div class="col-lg-8 col-md-12">
                <h3><?= $bien['libelle'] ?></h3>
                <h6><?= $bien['capacite'] ?> voyageurs • <?= $typeBien['libelle'] ?></h6>
                <hr />

                <div>
                    <h5>À propos de ce logement</h5>
                    <div><?= nl2br($bien['descriptions'])  ?></div>
                </div>
                <hr />
                <div class="mt-4">
                    <h5>Services ajoutés</h5>
                    <ul>
                        <?php
                        if (empty($services)) {
                        ?>
                            <p class="badge bg-secondary">Aucun service ajouté</p>
                        <?php
                        }
                        foreach ($services as $service) {
                        ?>
                            <li><?= $service['libelle'] ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card p-4 shadow">
                    <div class="card-body">
                        <form action="bien.php?id=<?= $_GET['id'] ?>" method="POST">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <p><span class="h4"><?= $bien['prix'] ?> €</span> nuit</p>
                                <p><i class="fa-solid fa-star"></i> <span class="fw-bold">4,3</span> • <span>19 commentaires</span></p>
                            </div>

                            <div>
                                <div class="row mb-4">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label mb-1 fw-bold" for="dateDebut">Arrivée</label>
                                            <input type="date" id="dateDebut" name="dateDebut" min="<?= date_format(date_create('now'), 'Y-m-d') ?>" max="<?= $bien['datefin'] ?>" class="form-control" value="<?= $arrivee ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label mb-1 fw-bold" for="dateFin">Départ</label>
                                            <input type="date" id="dateFin" name="dateFin" min="<?= date_format(date_create('now'), 'Y-m-d') ?>" max="<?= $bien['datefin'] ?>" class="form-control" value="<?= $depart ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label mb-1 fw-bold" for="voyageurs">Nombre de voyageurs</label>
                                            <input type="number" min="1" max="<?= $bien['capacite'] ?>" id="voyageurs" name="voyageurs" step="1" class="form-control" value="<?= $voyageurs ?>" required />
                                        </div>
                                    </div>
                                </div>


                                <ul class="list-group list-group-flush">
                                    <?php
                                    if (empty($services)) {
                                    ?>
                                        <p class="badge bg-secondary">Aucun service ajouté</p>
                                    <?php
                                    } else {
                                    ?>
                                        <p class="fw-bold">Services ajoutés</p>
                                    <?php
                                    }
                                    foreach ($services as $service) {
                                    ?>
                                        <label class="li list-group-item" for="<?= 'service' . $service['id'] ?>">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="checkbox" <?= isset($servicesSelected) && in_array($service['id'], $servicesSelected) ? 'checked' : '' ?> id="<?= 'service' . $service['id'] ?>" class="me-2 services" name="services[]" value="<?= $service['id'] ?>" data-prix="<?= $service['prix'] ?>" />
                                                    <span><?= $service['libelle'] ?></span>
                                                </div>
                                                <span><?= $service['prix'] ?> €</span>
                                            </div>
                                        </label>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="d-grid gap-2 mb-4 mt-4">
                                <button type="submit" id="btnReserver" class="btn btn-lg btn-danger">Réserver</button>
                            </div>
                            <p class="text-center">Aucun montant ne vous sera débité pour le moment</p>

                            <div class="mb-4 mt-4">
                                <div class="d-flex flex-row justify-content-between mb-3"><span class="text-decoration-underline" id="prix" data-prix="<?= $bien['prix'] ?>"><?= $bien['prix'] ?> x <span id="nbreNuits">0 nuits</span></span><span id="totalPrix">0 €</span></div>
                                <div class="d-flex flex-row justify-content-between mb-3"><span class="text-decoration-underline">Services ajoutés</span><span id="serviceTotal">0 €</span></div>
                            </div>

                            <hr class="mb-3" />
                            <div class="d-flex flex-row justify-content-between fw-bold h5"><span>Total</span><span id="total">0 €</span></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <hr />
        <section class="row mb-5">
            <div class="col-12">
                <div class="mb-4">
                    <h3>
                        <i class="fa-solid fa-star"></i>
                        <span>4,3</span> • <span>19 commentaires</span>
                    </h3>
                    <p class="text-muted">Seuls les voyageurs ayant effectué une réservation peuvent laisser un commentaire.
                        Country Park modère les commentaires et supprime ceux étant contraires à ses politiques.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 mt-4">
                        <div class="d-flex flex-row">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/Manganese92.png" alt="Manganese92" width="48" height="48" class="rounded-circle">
                            </a>
                            <div class="ms-2 align-self-center">
                                <p class="h6 m-0 mb-1">Morgane</p>
                                <p class="m-0 text-muted">août 2022</p>
                            </div>
                        </div>
                        <p class="pt-3">
                            Emplacement privilégié, nous y avons dormi avec les rideaux ouverts, nous n'avons pas pu nous lasser de la vue à couper le souffle. Endroit calme, accueil sympathique et dans et au chalet nous avons pu profiter d'une intimité suffisante.
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-4">
                        <div class="d-flex flex-row">
                            <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/Manganese92.png" alt="Manganese92" width="48" height="48" class="rounded-circle">
                            </a>
                            <div class="ms-2 align-self-center">
                                <p class="h6 m-0 mb-1">Morgane</p>
                                <p class="m-0 text-muted">août 2022</p>
                            </div>
                        </div>
                        <p class="pt-3">
                            Emplacement privilégié, nous y avons dormi avec les rideaux ouverts, nous n'avons pas pu nous lasser de la vue à couper le souffle. Endroit calme, accueil sympathique et dans et au chalet nous avons pu profiter d'une intimité suffisante.
                        </p>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script>
        (function() {
            const dateDebutElem = document.querySelector("#dateDebut");
            const dateFinElem = document.querySelector("#dateFin");
            const voyageursElem = document.querySelector("#voyageurs");
            const nbreNuits = document.querySelector("#nbreNuits");
            const prix = document.querySelector("#prix");
            const totalPrix = document.querySelector("#totalPrix");
            const btnReserver = document.querySelector("#btnReserver");
            document.querySelectorAll(".services").forEach(s => s.onchange = update);

            let dateDebut, dateFin, nbreVoyageurs;
            update();

            dateDebutElem.onchange = update;
            dateFinElem.onchange = update;
            voyageursElem.onchange = update;

            function update() {
                let valid = false;
                let nuits = 0;

                dateDebut = new Date(dateDebutElem.value);
                dateFin = new Date(dateFinElem.value);
                nbreVoyageurs = new Date(voyageursElem.value);

                const totalServices = [...document.querySelectorAll(".services")]
                    .filter(x => x.checked)
                    .map(x => +x.dataset.prix)
                    .reduce((sum, x) => sum + x, 0);

                if ([dateDebut.toString(), dateFin.toString()].every(x => !x.includes('Invalid'))) {
                    const dateDiff = dateFin.getTime() - dateDebut.getTime();
                    nuits = dateDiff / 24 / 60 / 60 / 1000;
                    valid = dateDiff > 0;

                    nbreNuits.textContent = `${nuits > 0 ? nuits : 0} nuits`;
                    const totalPrixNuits = Math.floor(+prix.getAttribute('data-prix') * nuits * 100) / 100;
                    totalPrix.textContent = `${totalPrixNuits > 0 ? totalPrixNuits : 0} €`;
                    document.querySelector("#serviceTotal").textContent = `${+totalServices} €`;

                    const totaux = Math.floor((totalPrixNuits + totalServices) * 100) / 100;
                    document.querySelector("#total").textContent = `${totaux  > 0 ? totaux : 0} €`;
                }

                valid = valid && nbreVoyageurs > 0 && nuits > 0;

                if (valid) btnReserver.removeAttribute('disabled')
                else btnReserver.setAttribute('disabled', true)
            }
        })();
    </script>
<?php
}
?>
<?php require 'includes/page_footer.php' ?>