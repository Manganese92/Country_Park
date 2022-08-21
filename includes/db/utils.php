<?php
require "constants.php";

function get_connexion_pdo(){
    try{
		$pdo = new PDO( DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT , DB_USER , DB_PWD );
    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(Exception $e){
		die("Erreur SQL ".$e->getMessage());
	}
    
	return $pdo;
}

function is_user_connected() {
    return isset($_SESSION['id']) && isset($_SESSION['email']);
}

?>