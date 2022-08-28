<?php
require_once 'includes/db/utilisateurs.sql.php';

function traiter_connexion($email, $motdepasse) {
    $user = get_utilisateur($email);
    if (empty($user)) {
        return "Nom d'utilisateur ou mot de passe invalide";
    }

    if (!password_verify($motdepasse, $user['motdepasse'])) {
        return "Nom d'utilisateur ou mot de passe invalide";
    }

    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    if (isset($_SESSION['redirect_after_connexion'])) {
        header("location: " . $_SESSION['redirect_after_connexion']);
        unset($_SESSION['redirect_after_connexion']);
    } else {
        header("location: index.php");
    }
}
