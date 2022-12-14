<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Type biens</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="?action=creer" class="btn btn-sm btn-outline-primary">
            Nouveau type
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</div>

<?php
$typeBiens = get_all_type_biens();

if(isset($_GET['action']) && $_GET['action'] == "supp" && isset($_GET['supp']) && $_GET['supp'] > 0) {
    delete_type_bien($_GET['supp']);
    header('location: typebiens.php');
    return;
}
?>

<table class="table table-hover caption-top align-middle table-striped">
    <caption>Liste des types de biens</caption>
    <thead>
        <th>Libelle</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        foreach ($typeBiens as $typeBien) {
            $link = '?action=supp&supp='.$typeBien['id'];
        ?>
            <tr>
                <td class="col-11"><?= $typeBien['libelle'] ?></td>
                <td class="col-1">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="?action=edit&edit=<?= $typeBien['id'] ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-pencil"></i></a>
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
                Voulez-vous supprimer ce type de bien ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a id="deleteModal" href="#" class="btn btn-sm btn-primary">Valider</a>
            </div>
        </div>
    </div>
</div>
