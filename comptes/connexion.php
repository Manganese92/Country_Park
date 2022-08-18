<!doctype html>

<?php 
  session_start(); 
  require "function.php";
?>


			<?php

				if( !empty($_POST['email']) &&  !empty($_POST['password']) && count($_POST)==2 ){

					//Récupérer en bdd le mot de passe hashé pour l'email provenant du formulaire


					$pdo = connectDB();
					$queryPrepared = $pdo->prepare("SELECT * FROM iw_user WHERE email=:email");
					$queryPrepared->execute(["email"=>$_POST['email']]);
					$results = $queryPrepared->fetch();

					if(!empty($results) && password_verify($_POST['password'], $results['password'])){
						

						$token = createToken();
						updateToken($results["id"], $token);
						//Insertion dans la session du token
						$_SESSION['email'] = $_POST['email'];
						$_SESSION['id'] = $results["id"];
						$_SESSION['token'] = $token;
						header("location: connexion.php");

					}else{
						echo "Identifiants incorrects";
					}

				}

?>







<html lang="fr">

  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/connexion.css">
  </head>

<body>

<form method="POST" action="./comptes/login.php">

  <main class="form-signin">
    <form>
      <a  href="../index.html"><img class="form-signin " src="../styles/images/Logo.png" alt="logo_connexion"></a>
      <h1 class="H1">Connexion</h1>
      <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Adresse email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Mot de passe</label>
      </div>
      <button class="w-50 btn btn-lg btn-primary" type="submit">se connecter</button>
      <div class="inscription mb-3">
        <p>Vous n'avez pas encore de compte</p>
        <a href="./register.php" class="redirection"> Cliquez ici</a>
      </div>
    </form>
  </main>

</body>
</html>