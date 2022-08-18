<?php
session_start();

require "function.php";

// traitement des données que l'utilisateur va entrée 

//Est-ce que je recois ce que j'ai demandé

if(
	empty($_POST["email"]) ||
	!isset($_POST["firstname"]) ||
	!isset($_POST["lastname"]) || 
	empty($_POST["pseudo"]) ||
	empty($_POST["password"]) ||
	empty($_POST["passwordConfirm"]) ||
	!isset($_POST["birthday"])||
	count($_POST)!=7
){

	die("Tentative de Hack ...");

}




//récupérer les données du formulaire
$email = $_POST["email"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$pseudo = $_POST["pseudo"];
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];
$birthday = $_POST["birthday"];



//nettoyer les données

$email = strtolower(trim($email));
$firstname = ucwords(strtolower(trim($firstname)));
$lastname = mb_strtoupper(trim($lastname));
$pseudo = ucwords(strtolower(trim($pseudo)));



//vérifier les données
$errors = [];


//Email OK
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$errors[] = "Email incorrect";
}else{

	//Vérification l'unicité de l'email
	$pdo = connectDB();
	$queryPrepared = $pdo->prepare("SELECT id from iw_user WHERE email=:email");

	$queryPrepared->execute(["email"=>$email]);
	
	if(!empty($queryPrepared->fetch())){
		$errors[] = "L'email existe déjà";
	}


}

//prénom : Min 2, Max 45 ou empty
if( strlen($firstname)==1 || strlen($firstname)>45 ){
	$errors[] = "Votre prénom doit faire plus de 2 caractères";
}

//nom : Min 2, Max 100 ou empty
if( strlen($lastname)==1 || strlen($lastname)>100 ){
	$errors[] = "Votre nom doit faire plus de 2 caractères";
}

//pseudo : Min 4 Max 60
if( strlen($pseudo)<4 || strlen($pseudo)>60 ){
	$errors[] = "Votre pseudo doit faire entre 4 et 60 caractères";
}

//Date anniversaire : YYYY-mm-dd
//entre 16 et 100 ans
$birthdayExploded = explode("-", $birthday);

if( count($birthdayExploded)!=3 || !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0])){
	$errors[] = "date incorrecte";
}else{
	$age = (time() - strtotime($birthday))/60/60/24/365.2425;
	if($age < 16 || $age > 100){
		$errors[] = "Vous êtes trop jeune ou trop vieux";
	}
}


//Mot de passe : Min 8, Maj, Min et chiffre
if(strlen($password) < 8 ||
preg_match("#\d#", $password)==0 ||
preg_match("#[a-z]#", $password)==0 ||
preg_match("#[A-Z]#", $password)==0 
) {
	$errors[] = "Votre mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
}


//Confirmation : égalité
if( $password != $passwordConfirm){
	$errors[] = "Votre mot de passe de confirmation ne correspond pas";
}


if(count($errors) == 0){

	$queryPrepared = $pdo->prepare("INSERT INTO iw_user (email, firstname, lastname, pseudo, birthday, password) 
		VALUES ( :email , :firstname, :lastname, :pseudo, :birthday, :password );");


	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$queryPrepared->execute([
		"email"=>$email,
		"firstname"=>$firstname,
		"lastname"=>$lastname,
		"pseudo"=>$pseudo,
		"birthday"=>$birthday,
		"password"=>$password,
	]);

	header("Location: connexion.php");	

}else{
	
	$_SESSION['errors'] = $errors;
	header("Location: register.php");
}