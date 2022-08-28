<?php
require_once "utils.php";
require_once "utilisateurs.sql.php";

function reserver($arrivee, $depart, $voyageurs, $bien, $services)
{
    $pdo = get_connexion_pdo();
    $user = get_utilisateur($_SESSION['email']);
    try {
        $pdo->beginTransaction();

        $query = $pdo->prepare("INSERT INTO reservations(arrivee, depart, voyageurs, prix, bienId, userId) VALUES (:arrivee, :depart, :voyageurs, :prix, :bienId, :userId)");
        $query->bindValue(":arrivee", $arrivee);
        $query->bindValue(":depart", $depart);
        $query->bindValue(":voyageurs", $voyageurs);
        $query->bindValue(":prix", $bien['prix']);
        $query->bindValue(":bienId", $bien['id']);
        $query->bindValue(":userId", $user['id']);
        $query->execute();
        
        $reservationLastId = $pdo->lastInsertId();

        foreach ($services as $serviceId) {
            $query = $pdo->prepare("INSERT INTO reservation_services(reservationId, serviceId) VALUES (:reservationId, :serviceId)");
            $query->bindValue(":reservationId", $reservationLastId);
            $query->bindValue(":serviceId", $serviceId);
            $query->execute();
        }

        $pdo->commit();
    } catch (Exception) {
        $pdo->rollback();
    }
}

function get_all_reservations()
{
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("SELECT *, prix * DATEDIFF(depart, arrivee) as prixTotal FROM reservations ORDER BY arrivee DESC");
    $query->execute();

    return $query->fetchAll();
}

function get_current_user_reservations()
{
    $pdo = get_connexion_pdo();

    $query = $pdo->prepare("SELECT *, prix * DATEDIFF(depart, arrivee) as prixTotal FROM reservations WHERE userId = :userId");
    $query->bindValue(":userId", $_SESSION['id']);
    $query->execute();

    return $query->fetchAll();
}
