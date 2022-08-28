<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Biens</h3>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="?action=creer" class="btn btn-sm btn-outline-primary">
            Nouveau bien
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</div>

<?php
$biens = get_all_biens();

if(isset($_GET['action']) && $_GET['action'] == "supp" && isset($_GET['supp']) && $_GET['supp'] > 0) {
    delete_bien($_GET['supp']);
    header('location: biens.php');
    return;
}
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
            $link = '?action=supp&supp='.$bien['id'];
        ?>
            <tr>
                <td class="text-dark"><?= $bien['libelle'] ?></td>
                <td class="text-dark">
                <?php
                    $typeBien = get_type_bien_by_id($bien['typebien']);
                    if (!empty($typeBien)) {
                        echo $typeBien['libelle'];
                    }
                ?>
                </td>
                <td class="text-dark"><?= $bien['datedebut'] ?></td>
                <td class="text-dark"><?= $bien['datefin'] ?></td>
                <td class="text-dark">
                    <span class="text-dark"><?= $bien['prix'] ?> €</span> nuit
                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="?action=edit&edit=<?= $bien['id'] ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-pencil"></i></a>
                        <a onclick="openModal('<?= $link ?>', '#deleteModal')" href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez-vous supprimer ce bien ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a id="deleteModal" href="#" class="btn btn-sm btn-primary">Valider</a>
            </div>
        </div>
    </div>
</div>
