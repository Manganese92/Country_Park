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

function modifier_utilisateur($id, $nom, $profil) {
    $pdo = get_connexion_pdo();

    $userProfil = $profil;
    if (!isset($profil)) {
        $user = get_utilisateur_by_id($id);
        $userProfil = $user['profil'];
    }

    $queryPrepare = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, profil = :profil, datemiseajour = now() WHERE id = :id");
    $queryPrepare->bindParam(':id', $id);
    $queryPrepare->bindParam(':nom', $nom);
    $queryPrepare->bindParam(':profil', $userProfil);
    $queryPrepare->execute();
}

function is_admin_connected() {
	if (!is_user_connected()) {
		return false;
	}

    $ADMIN_ID = 1;
	$user = get_utilisateur_by_id($_SESSION['id']);
    return $user['profil'] == $ADMIN_ID;
}

function liste_utilisateur() {
    $pdo = get_connexion_pdo();

    $queryPrepare = $pdo->prepare("SELECT * FROM utilisateurs");
    $queryPrepare->execute();
    return $queryPrepare->fetchAll();
}

?>