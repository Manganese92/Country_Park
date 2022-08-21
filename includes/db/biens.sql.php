<?php
require "utils.php";

function get_all_biens() {
    $pdo = get_connexion_pdo();
    
    $queryPrepare = $pdo->prepare("SELECT * FROM biens");
    $queryPrepare->execute();

    return $queryPrepare->fetchAll();
}

?>