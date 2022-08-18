<?php session_start(); 
require "function.php";
?>

<?php
// On récupère les informations de l'utilisateur connecté
  $afficher_profil = $DB->query("SELECT * 
    FROM iw_user
    WHERE id = ?", 
  array($_SESSION['id']));
  
  $afficher_profil = $afficher_profil->fetch(); 

?>


<!doctype html>

<html lang="fr">

  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/compte.css">
    <link rel="icon" type="image/png" href="../styles/images/logo_vert.png">
    <title>Mon profil</title>
  </head>



  <body>
    <h2>Voici le profil de <?= $afficher_profil['nom'] . $afficher_profil['prenom']; ?></h2>
    <div>Quelques informations sur vous : </div>
    <ul>
      <li>Votre id est : <?= $afficher_profil['id'] ?></li>
      <li>Votre mail est : <?= $afficher_profil['email'] ?></li>
    </ul>
  </body>


</html>