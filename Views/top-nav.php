<nav class="navbar columns is-fixed-top" role="navigation" aria-label="main navigation" id="app-header" style="
    padding-left: 0px; padding-bottom: 0px; padding-right: 0px; padding-top: 0px;">

    <div class="navbar-brand column is-2 is-paddingless">
        <!-- <?php if (isset($_SESSION['loggedUser'])) {
            $loggedUser = $_SESSION['loggedUser'];
            if ($loggedUser->getRole() == '1') {
                echo "<a class='navbar-item'> ADMINISTRADOR </a>";
            } else {
                echo "<a class='navbar-item'> CLIENTE </a>";
            }
        }
        ?> -->
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="touchMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="touchMenu">


    </div>

    <div id="navMenu" class="navbar-menu column is-hidden-touch">
        <div class="navbar-end">

            <div class="navbar-item">
                <a class="button is-white">
                    <span class="icon">
                        <i class="fa fa-user fa-2x" aria-hidden="true"></i>Perfil
                    </span>
                </a>
            </div>

            <div class="navbar-item">
                <a class="button is-white" href="<?= FRONT_ROOT ?>Home/LogOut"> Cerrar Sesion &nbsp <span class="icon">
                    <i class="fa fa-lg fa-power-off"></i>

                    </span>
                </a>
            </div>

            <div class="navbar-item">

                <figure class="image avatar is-32x32">
                    <img class="is-rounded" src="<?= FRONT_ROOT . VIEWS_PATH ?>images/user1.png">
                </figure>
                &nbsp; Hola <?= $loggedUser->getEmail(); ?>

            </div>

        </div>
    </div>
</nav>