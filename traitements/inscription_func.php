<?php
require_once 'includes/db/utilisateurs.sql.php';

function validation_inscription($nom, $email, $mot_de_passe, $mot_de_passe_bis) {
    $erreurs = array();

    if (!isset($nom) || strlen($nom) < 2) {
        $erreurs['nom'] = "Votre nom doit faire plus de 2 caractères";
    }

    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Email invalide";
    }

    if (!isset($mot_de_passe) || empty($mot_de_passe) ||  empty($mot_de_passe_bis)) {
        $erreurs['motdepasse'] = "Veuillez renseigner un mot de passe";
    }

    if (!empty($mot_de_passe) && !empty($mot_de_passe_bis) && $mot_de_passe_bis != $mot_de_passe) {
        $erreurs['motdepassebis'] = "Les mots de passe ne sont pas identique";
    }

    return array('valide' => count($erreurs) == 0, 'erreurs' => $erreurs);
}

function get_message_erreur($key, $erreur_array) {
    return array_key_exists($key, $erreur_array) ? $erreur_array[$key] : '';
}

function is_input_valid($formName, $erreur_array) {
    return array_key_exists($formName, $erreur_array) ? 'is-invalid' : '';
}

function traiter_inscription($nom, $email, $motdepasse) {
    $userExist = get_utilisateur($email);
    if (!empty($userExist)) {
        return array('email' => "L'email existe déjà");
    } else {
        creer_nouvel_utilisateur($nom, $email, $motdepasse);
        $newUser = get_utilisateur($email);

        $_SESSION['id'] = $newUser['id'];
        $_SESSION['email'] = $newUser['email'];

        header("location: index.php");
    }
    return array();
}
