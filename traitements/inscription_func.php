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

        // Génération aléatoire d'une clé
        $cle = md5(microtime(TRUE)*100000);
                
        creer_nouvel_utilisateur($nom, $email, $motdepasse, $cle);

        // Préparation du mail contenant le lien d'activation
        $destinataire = $email;
        $sujet = "Activer votre compte" ;
        $entete = "From: mregnaut.esgi@gmail.com" ;

        $message = 'Bienvenue sur Country Park,
        
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur Internet.
        
        http://localhost/Country_park/confirmation.php?nom='.urlencode($nom).'&cle='.urlencode($cle).'
        
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';
        
        mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

        header("location: inscription_valid.php");
    }
    return array();
}

 
