<?php
require_once "utils.php";

function get_all_biens() {
    $pdo = get_connexion_pdo();
    
    $queryPrepare = $pdo->prepare("SELECT * FROM biens");
    $queryPrepare->execute();

    return $queryPrepare->fetchAll();
}

function get_bien_by_id($id) {
    $pdo = get_connexion_pdo();
    
    $queryPrepare = $pdo->prepare("SELECT * FROM biens WHERE id = :id");
    $queryPrepare->bindParam(':id', $id);
    $queryPrepare->execute();

    return $queryPrepare->fetch();
}

function create_bien($libelle, $descriptions, $typeBien, $capacite, $dateDebut, $dateFin, $prix) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("INSERT INTO biens (libelle, descriptions, typebien, capacite, datedebut, datefin, prix) 
                            VALUES (:libelle, :descriptions, :typebien, :capacite, :datedebut, :datefin, :prix)");
    $query->bindParam(":libelle", $libelle);
    $query->bindParam(":typebien", $typeBien);
    $query->bindParam(":capacite", $capacite);
    $query->bindParam(":datedebut", $dateDebut);
    $query->bindParam(":datefin", $dateFin);
    $query->bindParam(":prix", $prix);
    $query->bindParam(":descriptions", $descriptions);
    $query->execute();
}

function update_bien($id, $libelle, $descriptions, $typeBien, $capacite, $dateDebut, $dateFin, $prix) {
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("UPDATE biens 
                            SET libelle = :libelle, descriptions =:descriptions, typebien = :typebien, capacite = :capacite, datedebut = :datedebut, datefin = :datefin, prix = :prix
                            WHERE id = :id");

    $query->bindParam(":id", $id);
    $query->bindParam(":libelle", $libelle);
    $query->bindParam(":typebien", $typeBien);
    $query->bindParam(":capacite", $capacite);
    $query->bindParam(":datedebut", $dateDebut);
    $query->bindParam(":datefin", $dateFin);
    $query->bindParam(":prix", $prix);
    $query->bindParam(":descriptions", $descriptions);
    $query->execute();
}

function delete_bien($id) {
    $pdo = get_connexion_pdo();
    $query = $pdo->prepare("DELETE FROM biens WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
}
