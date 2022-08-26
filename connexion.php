<?php
require_once 'includes/page_header.php';
require_once 'includes/sections/navbar.php';
require_once 'traitements/connexion_func.php';
?>

<?php
$erreur = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    
    $erreur = traiter_connexion($email, $motdepasse,);
}
?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="mb-sm-4 d-lg-none" style="margin-top: 130px;"></div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <h3 class="text-center fw-bold mb-4 mx-1 mx-md-4 mt-2">Se connecter</h3>
                                <form class="mx-1 mx-md-4" method="POST" action="connexion.php">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="email" name="email" class="form-control" required />
                                            <label class="form-label text-muted mb-0" for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="motdepasse" name="motdepasse" class="form-control" required />
                                            <label class="form-label text-muted mb-0" for="motdepasse">Mot de passe</label>
                                            <div class="text-danger mt-2"><?= $erreur ?></div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mb-5">
                                        <p class="m-0 p-0 fw-bold">Pas de compte ? &nbsp;<a href="inscription.php">Créer un compte</a></p>
                                    </div>

                                    <div class="d-grid gap-2 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary ">Se connecter</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-10 gap-2 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require 'includes/page_footer.php' ?>