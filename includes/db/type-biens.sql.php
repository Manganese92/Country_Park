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

function create_type_bien($nom) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("INSERT INTO typebiens (libelle) VALUES (:libelle)");
    $query->bindParam(":libelle", $nom);
    $query->execute();
}

function update_type_bien($id, $nom) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("UPDATE typebiens SET libelle = :nom, datemiseajour = now() WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->bindParam(":nom", $nom);
    $query->execute();
}

function delete_type_bien($id) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("DELETE FROM typebiens WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
}


?>
