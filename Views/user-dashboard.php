<?php

    $user = $_SESSION['loggedUser']; 
?>
<?php
    include('top-nav.php');
    use models\jobPosition as jobPosition;
    use DAO\JobPositionDAOPDO as jobPositionDAOPDO;
?> 

<div class="columns" id="app-content">
    <?php include('user-aside-nav.php');?>

    <div class="column is-10" id="page-content">

    <div class="content-body">
        <h4 class="title is-4">Datos del estudiante </h4>
            <div class="card">
                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th class="has-text-centered"> Nombre</th>
                                <th class="has-text-centered"> Apellido</th>
                                <th class="has-text-centered"> Correo</th>
                                <th class="has-text-centered"> DNI</th>

                                

                                <th class="has-text-centered">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="has-text-centered">
                                    <?php echo $user->getFirstName() ?>
                                </td>
                                <td class="has-text-centered">
                                    <?php echo $user->getLastName() ?>
                                </td>
                                <td class="has-text-centered">
                                    <?php echo $user->getEmail() ?>
                                </td>
                                <td class="has-text-centered">
                                    <?php echo $user->getDni() ?>
                                </td>
                                <td class="has-text-centered">
                                    <?php echo $user->getStudentId() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

       

       

        <div class="content-body">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Ver Empresas Postuladas</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/165-1652604_png-file-company-clipart.png" alt="Image">
                                            
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <div class="field">
                                                
                                                <li> <a class="button is-dark is-4" href="<?= FRONT_ROOT ?>Company/ShowListViewUser">Listar Empresas</a> </li>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Propuestas</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/150-1509399_png-file-query-results-icon-clipart.png" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="media-content">

                                            <div class="content">
                                                <div class="field">
                                                    <li><a class="button is-dark is-4" href="<?= FRONT_ROOT ?>JobOffer/ShowListView">Listar Propuestas</a><br><br></li>

                                                    <li><a class="button is-dark is-4">Mis Postulaciones </a> </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-2">Mi Perfil</p>
                            <div class="box">
                                <article class="media">
                                    <div class="media-left">
                                        <figure class="image is-64x64">
                                            <img src="https://www.pinclipart.com/picdir/big/67-675105_search-log-in-to-your-teach-california-account.png" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="media-content">
                                        <div class="content">
                                            <li><a class="button is-dark is-4" href="<?= FRONT_ROOT ?>Student/ShowProfileView">Ver Mis Datos</a><br><br></li>

                                            
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<?php   ?>


<!--<script type="text/javascript">
       <?php
        
        ?> 
</script> -->
