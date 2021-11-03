<?php


    $user = $_SESSION['loggedAdmin']; 
    include('top-nav.php'); 



use models\Admin as Admin;
use DAO\AdminDAOPDO as AdminDAO;
?>

<div class="columns" id="app-content">
    <?php include('admin-aside-nav.php'); ?>


    <div class="column is-10" id="page-content">
        <div class="content-header">
            <h4 class="title is-4">Listados</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Estudiantes Registrados</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Listado de Estudiantes</a></li>
                    
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="card">

                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th class="has-text-centered">Id</th>
                                <th class="has-text-centered">Email</th>
                                <th class="has-text-centered">Nombre</th>
                                <th class="has-text-centered">Apellido</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($studentList as $student) {

                                ?>
                                <tr>
                                    <td class="has-text-centered"><?= $student->getStudentId(); ?></td>
                                    <td class="has-text-centered"><?= $student->getEmail(); ?></td>
                                    <td class="has-text-centered"><?= $student->getFirstName(); ?></td>
                                    <td class="has-text-centered"><?= $student->getLastName(); ?></td>
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>