<?php

    $student = $_SESSION['loggedUser']; 
?>
<?php include('top-nav.php'); ?>


<div class="columns" id="app-content">
    <?php include('user-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-header">
            <h4 class="title is-4">Usuario </h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Perfil</a></li>

                    <li style="color:red"><b></b></li>
                </ul>
            </nav>
        </div>


        <div class="content-body">
            <div class="card">
                <form action="" method="POST">

                    <div class="card-content">
                        <div class="field">
                            <label class="label">Apellido </label>
                            <div class="control">
                                <input class="input" type="text" name="apellido" value="<?= $userData->getLastName(); ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Nombre </label>
                            <div class="control">
                                <input class="input" type="text" name="apellido" value="<?= $userData->getFirstName(); ?>">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email </label>
                            <div class="control">
                                <input class="input" type="text" name="apellido" value="<?= $userData->getEmail(); ?>" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Dni </label>
                            <div class="control">
                                <input class="input" type="text" name="apellido" value="<?= $userData->getDni(); ?>">
                            </div>
                        </div>
                        <div class="field is-grouped centered" style="padding-left: 30%">
                            <div class="control">
                                <button class="button is-link" type="submit">Modificar</button>
                            </div>
                            <div class="control">
                                <button class="button is-text" type="reset">Cancelar</button>
                            </div>
                        </div>



                </form>


            </div>
        </div>
    </div>
</div>