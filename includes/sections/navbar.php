<nav class="p-3 mb-4 border-bottom fixed-top bg-light mb-xs-5">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="<?= ROOT_PATH ?>index.php" class="text-dark text-decoration-none mb-sm-1">
                <span class="fs-6 d-lg-none">Country Park</span>
                <span class="fs-4 d-lg-block d-none">Country Park</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control" placeholder="Recherche..." aria-label="Recherche">
            </form>

            <?php include(ROOT_PATH . "includes/sections/dropdow_menu.php") ?>
        </div>
    </div>
</nav>
