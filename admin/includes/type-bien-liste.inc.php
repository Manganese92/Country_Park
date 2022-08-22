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
        ?>
            <tr>
                <td class="col-11"><?= $typeBien['libelle'] ?></td>
                <td class="col-1">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="?edit=<?= $typeBien['id'] ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-pencil"></i></a>
                        <a href="?supp=<?= $typeBien['id'] ?>" class="btn btn-sm btn-light"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>