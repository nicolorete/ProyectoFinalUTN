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
                    <li><a href="#">Administrar Usuarios</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Listado de Administradores</a></li>
                    
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
                                <th class="has-text-centered">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($userList as $admin) {

                                ?>
                                <tr>
                                    <td class="has-text-centered"><?= $admin->getAdminId(); ?></td>
                                    <td class="has-text-centered"><?= $admin->getEmail(); ?></td>
                                    <td class="has-text-centered">
                                        <div class="field is-grouped action">
                                            <p class="control">
                                                <form action="<?= FRONT_ROOT ?>Admin/Delete" method="post">
                                                    <button class="button is-warning btnEdit"  name="adminId" type="submit">
                                                    Delete
                                                </form>
                                            </p>
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