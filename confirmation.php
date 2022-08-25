<?php

require_once 'includes/page_header.php';
require_once 'includes/sections/navbar.php';
require_once 'traitements/inscription_func.php';

$pdo = get_connexion_pdo();

// Récupération des variables nécessaires à l'activation
$nom = $_GET['nom'];
$cle = $_GET['cle'];

// Récupération de la clé correspondant au $login dans la base de données
$stmt = $pdo->prepare("SELECT cle,actif FROM utilisateurs WHERE nom like :nom ");
if ($stmt->execute(array(':nom' => $nom)) && $row = $stmt->fetch()) {
    $clebdd = $row['cle'];    // Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
}


// On teste la valeur de la variable $actif récupérée dans la BDD
if ($actif == '1'){
    echo "Votre compte est déjà actif !";
} else {
    if ($cle == $clebdd) // On compare nos deux clés    
    {
        // Si elles correspondent on active le compte !    
        echo "Votre compte a bien été activé !";

        // La requête qui va passer notre champ actif de 0 à 1
        $stmt = $pdo->prepare("UPDATE utilisateurs SET actif = 1 WHERE nom like :nom ");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
    } else // Si les deux clés sont différentes on provoque une erreur...
    {
        echo "Erreur ! Votre compte ne peut être activé...";
    }
}
