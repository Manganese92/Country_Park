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

    $queryPrepare = $pdo->prepare("INSERT INTO utilisateurs (nom, email, motdepasse) values (:nom, :email, :motdepasse)");
    $queryPrepare->bindParam(':nom', $nom);
    $queryPrepare->bindParam(':email', $email);
    $queryPrepare->bindParam(':motdepasse', password_hash($motdepasse, PASSWORD_DEFAULT));
    $queryPrepare->execute();
}

?>