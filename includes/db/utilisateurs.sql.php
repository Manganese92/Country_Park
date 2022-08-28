<?php
require_once "utils.php";

function get_utilisateur($email) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $queryPrepare->bindParam(':email', $email);
    $queryPrepare->execute();

    return $queryPrepare->fetch();
}

function get_utilisateur_by_id($id) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
    $queryPrepare->bindParam(':id', $id);
    $queryPrepare->execute();

    return $queryPrepare->fetch();
}


function creer_nouvel_utilisateur($nom, $email, $motdepasse) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("INSERT INTO utilisateurs (nom, email, motdepasse, cle) values (:nom, :email, :motdepasse, :cle)");
    $queryPrepare->bindParam(':nom', $nom);
    $queryPrepare->bindParam(':email', $email);
    $queryPrepare->bindParam(':cle', $cle);
    $queryPrepare->bindParam(':motdepasse', password_hash($motdepasse, PASSWORD_DEFAULT));
    $queryPrepare->execute();
}


function liste_utilisateur($nom, $email, $statut) {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("INSERT INTO utilisateurs (nom, email, statut) values (:nom, :email, :statut)");
    $queryPrepare->bindParam(':nom', $nom);
    $queryPrepare->bindParam(':email', $email);
    $queryPrepare->bindParam(':cle', $cle);
    $queryPrepare->bindParam(':statut', $statut);
    $queryPrepare->execute();
}

?>