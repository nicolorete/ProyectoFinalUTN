<?php

    $user = $_SESSION['loggedUser']; 
    use DAO\CareerDAOPDO as CareerDAOPDO;
    $career = new CareerDAOPDO;
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

                    <div class="card-content">
                        <div class="field">
                            <label class="label">Apellido: </label>
                            <?= $user->getLastName(); ?>
                        </div>
                        <div class="field">
                            <label class="label">Nombre </label>
                            <?= $user->getFirstName(); ?>
                        </div>

                        <div class="field">
                            <label class="label">Email </label>
                            <?= $user->getEmail(); ?>
                        </div>

                        <div class="field">
                            <label class="label">Dni </label>
                            <?= $user->getDni(); 
                            ?>
                        </div>

                        <div class="field">
                            <label class="label">Carrera </label>
                            <?php echo $career->GetCareer($user->getCareer()) ?>


                        </div>

                        <div class="field">
                            <label class="label">fileNumber: </label>
                            <?= $user->getFileNumber(); ?>
                        </div>

                        <div class="field">
                            <label class="label">Gender </label>
                            <?= $user->getGender(); ?>
                        </div>

                        <div class="field">
                            <label class="label">BirthDate </label>
                            <?= $user->getBirthDate();?>
                        </div>

                        <div class="field">
                            <label class="label">Phone Number </label>
                            <?= $user->getPhoneNumber(); ?>
                        </div>
            </div>
        </div>
    </div>
</div>