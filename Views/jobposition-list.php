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

        <div class="content-header">
            <h4 class="title is-4">General </h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Buscador</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Propuestas</a></li>
                    <li style="color:red"><b>    </b></li>
                </ul>
            </nav>
        </div>


        <div class="content-body">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="table-search" type="text" placeholder="Ingrese Empresa">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>

                            </div>
                        </div>


                       
                       
                        <div class="field">
                            <button class="button is-link has-icons-right" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th class="has-text-centered"> Empresa</th>
                                <th class="has-text-centered"> Carrera</th>
                                <th class="has-text-centered"> Puesto</th>
                                <th class="has-text-centered">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($jobPositionList as $jobPosition) {

                        ?>
                        <tr>
                            <td><?= $jobPosition->getjobPositionId(); ?></td>
                            <td><?= $jobPosition->getCareerId(); ?></td>
                            <td><?= $jobPosition->getDescription(); ?></td>
                            <td class="has-text-centered">
                            
                                <div class="field is-grouped action">
                                    <p class="control">
                                        <form action="" method="post">
                                            <button class="button is-warning btnEdit" value=""name=" " type="submit">
                                                Ver Empresa
                                            </button>
                                        </form>
                                    </p>
                                    <form action="" method="post">
                                        <p class="control">
                                            <button class="button is-danger" name="BtnDel" data-id="1" value="">
                                                Aplicar
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php   ?>
