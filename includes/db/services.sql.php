<?php
require_once "utils.php";

function get_services_by_id($bienId) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("SELECT * FROM services WHERE bienId = :bienId ORDER BY libelle DESC");
    $queryPrepare->bindParam(":bienId", $bienId);
    $queryPrepare->execute();

    return $queryPrepare->fetchAll();
}

function get_one_service_by_id($bienId) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $queryPrepare->bindParam(":id", $bienId);
    $queryPrepare->execute();

    return $queryPrepare->fetch();
}

function create_service($libelle, $prix, $bienId) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("INSERT INTO services (libelle, prix, bienId) VALUES (:libelle, :prix, :bienId)");
    $query->bindParam(":libelle", $libelle);
    $query->bindParam(":prix", $prix);
    $query->bindParam(":bienId", $bienId);
    $query->execute();
}

function update_service($id, $libelle, $prix, $bienId) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("UPDATE services SET libelle = :libelle, prix =:prix, bienId = :bienId WHERE id = :id");

    $query->bindParam(":id", $id);
    $query->bindParam(":libelle", $libelle);
    $query->bindParam(":prix", $prix);
    $query->bindParam(":bienId", $bienId);
    $query->execute();
}

function delete_service($id) {
    $pdo = get_connexion_pdo();
    $query = $pdo->prepare("DELETE FROM services WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
}
