<?php

    $user = $_SESSION['loggedUser']; 
?>

<?php


include('top-nav.php');

use models\Company as Company;
use models\Student as Student;
use DAO\CompanyRepository as CompanyDAO;
?>

<div class="columns" id="app-content">
    <?php include('user-aside-nav.php'); ?>


    <div class="column is-10" id="page-content">
        <div class="content-header">
            <h4 class="title is-4">Listados</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Registro</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Listado de Empresas</a></li>

                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="card">

                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth " id="datatable">
                        <thead>
                            <tr>

                                <th class="has-text-centered">Nombre</th>
                                <th class="has-text-centered">Action</th>
                               

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($companyList as $company) {

                            ?>
                                <tr>
                                    <td class="has-text-centered"><?= $company->getNombre(); ?></td>

                                    <td class="has-text-centered">

                                        <div class="field is-grouped action">
                                            <p class="control">
                                                <!-- <a class="button is-warning btnEdit" value="<?= $company->getCompanyId(); ?>" name="companyId" type="submit">
                                                    Ver Empresa
                                                </a> -->
                                                <form action="<?= FRONT_ROOT ?>Company/ShowCompanyView" method="post">
                                                        <button class="button is-warning btnEdit" value="<?= $company->getCompanyId(); ?>" name="companyId" type="submit">
                                                            Ver Empresa
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

<!------------------ VENTANA MODAL --------------------------------->

<!------------------ FIN VENTANA MODAL -------------------------->

<script type="text/javascript">
    // var button = document.getElementById('modifyButton');
    var modal = document.getElementById('exampleModal');
    //var close = document.getElementById('modal-close');
</script>
