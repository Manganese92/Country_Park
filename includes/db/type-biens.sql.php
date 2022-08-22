<?php 
require_once "utils.php";

function get_all_type_biens() {
    $pdo = get_connexion_pdo();

    $queryPrepared = $pdo->prepare("SELECT * FROM typebiens");
    $queryPrepared->execute();

    return $queryPrepared->fetchAll();
}

function get_type_bien_by_id($id) {
    $pdo = get_connexion_pdo();

    $queryPrepared = $pdo->prepare("SELECT * FROM typebiens WHERE id = :id");
    $queryPrepared->bindParam(":id", $id);
    $queryPrepared->execute();

    return $queryPrepared->fetch();
}


?>
