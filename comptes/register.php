<?php
	session_start();
	require "function.php";
?>


<!doctype html>
<html lang="fr">
    
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <!-- CSS -->
    <link rel="stylesheet" href="../styles/register.css">

    <link rel="icon" type="image/png" href="../styles/images/logo_vert.png">
    <title> Inscription </title>
  </head>


  <body>
    <div class="head">
      <header  class="container-fluid">      
        <nav class="container">
          <div>
            <ul class="row nav">
              <li class="col-lg-2 col-md-4 text-center"><a href="../prestations/prestations.html" id="selecteur_1" class="nav-link text-light"> Nos prestations</a></li>
              <li class="col-lg-2 col-md-4 text-center"><a href="../prestataires/" id="selecteur_2" class="nav-link text-light"> Nos prestataires</a></h6>
              <li class="col-lg-1 col-md-4 text-center"><a href="https://www.mozilla.org/fr/" id="selecteur_3" class="nav-link text-light">Notre forum</a></h6>
              <li class="col-lg-1 col-md-12 text-center"><a href="../index.html" class="d-inline nav-link text-light" id="selecteur_4">
                <img id="logo img-fluid" style="background-color: blur;" src="../styles/images/Logo.png">
                  </a></li>
              <li class="col-lg-2 col-md-4 text-center"><a href="https://www.mozilla.org/fr/" id="selecteur_5" class="nav-link text-light">Nous contacter</a></li>
              <li class="col-lg-2 col-md-4 text-center"><a href="https://www.mozilla.org/fr/" id="selecteur_6" class="nav-link text-light">Mon panier</a></li>
              <li class="col-lg-2 col-md-4 text-center"><a href="../comptes/connexion.php" id="selecteur_7" class="nav-link text-light">Mon compte</a></li>
            </ul>
          </div>
        </nav>
      </header>

	<div class="container">
		<div class="row mt-4">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php
					if(!empty($_SESSION['errors'])){
						print_r( $_SESSION['errors'] );
						unset($_SESSION['errors']);
						//session_destroy();
					}
				?>

				<form method="POST" action="new_user.php">

					<input type="email" class="form-control" name="email" placeholder="Votre email" required="required"><br>

					<input type="text" class="form-control" name="firstname" placeholder="Votre prénom"><br>
					<input type="text" class="form-control" name="lastname" placeholder="Votre nom"><br>

					<input type="password" class="form-control" name="password" placeholder="Votre mot de passe"  required="required"><br>
					<input type="password" class="form-control" name="passwordConfirm" placeholder="confirmation" required="required"><br>

					<input type="submit" class="btn btn-primary" value="S'inscrire">

				</form>
			</div>
		</div>
	</div>
</body>


</html>