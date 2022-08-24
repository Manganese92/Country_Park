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


// Récupération des variables nécessaires au mail de confirmation    
$email = $_POST['mail'];
$login = $_POST['login'];
 
// Génération aléatoire d'une clé
$cle = md5(microtime(TRUE)*100000);
 
 
// Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
$stmt = $dbh->prepare("UPDATE membres SET cle=:cle WHERE nom like :nom");
$stmt->bindParam(':cle', $cle);
$stmt->bindParam(':nom', $nom);
$stmt->execute();
 
 
// Préparation du mail contenant le lien d'activation
$destinataire = $mail;
$sujet = "Activer votre compte" ;
$entete = "From: mregnaut.esgi@gmail.com" ;

$message = 'Bienvenue sur Country Park,
 
Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
ou copier/coller dans votre navigateur Internet.
 
http://votresite.com/activation.php?log='.urlencode($nom).'&cle='.urlencode($cle).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail