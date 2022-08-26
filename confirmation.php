<?php

require_once 'includes/page_header.php';
require_once 'includes/sections/navbar.php';
require_once 'traitements/inscription_func.php';

$pdo = get_connexion_pdo();

// Récupération des variables nécessaires à l'activation
$nom = $_GET['nom'];
$cle = $_GET['cle'];

// Récupération de la clé correspondant au compte dans la base de données
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE cle = :cle ");
if ($stmt->execute(array(':cle' => $cle)) && $row = $stmt->fetch()) {
    $actif = $row['statut']; // $actif contiendra alors 0 ou 1
    // On teste la valeur de la variable $actif récupérée dans la BDD
    if ($actif == '1') {
        echo "Votre compte est déjà actif !";
    } else {
        // Si elles correspondent on active le compte !    
        echo "Votre compte a bien été activé !";

        // La requête qui va passer notre champ actif de 0 à 1
        $stmt = $pdo->prepare("UPDATE utilisateurs SET statut = 1 WHERE email like :email ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }
} else // Si les deux clés sont différentes on provoque une erreur...
{
    echo "Erreur ! Votre compte ne peut être activé...";
}
