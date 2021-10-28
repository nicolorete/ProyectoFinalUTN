<?php

namespace Views;

include('top-nav.php');

use models\Company as Company;
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
                                <!--<th>Capacidad</th>
                                        <th>Precio de la entrada</th>-->

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
                                                <a class="button  is-warning btnEdit" id="modifyButton2<?= $company->getCompanyId(); ?>" onclick="">

                                                    Ver Empresa

                                                </a>

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
<div class="modal" id="exampleModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Detalle de la Empresa</p>
            <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button>
        </header>

        <section class="modal-card-body">
            <form action="" method="POST">

           

                <div class="field">

                    <div class="control">
                        <input class="input" name="idCompany" type="number" placeholder="" id="id" hidden="true">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Cuit </label>
                    <div class="control">
                        <label> <?php echo $company->getCuit() ?></label>
                    </div>
                </div>


                <div class="field">
                    <label class="label">Nombre </label>
                    <div class="control">
                        <label> <?php echo $company->getNombre() ?></label>
                    </div>
                </div>


                <div class="field">
                    <label class="label">Direccion</label>
                    <div class="control">
                        <label> <?php echo $company->getAddress() ?></label>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Link</label>
                    <div class="control">
                        <label><?php echo $company->getLink() ?>"</label>
                    </div>
                </div>




        </section>


        <!-- <button class="button is-success" type="submit">Modificar</button> -->
        </form>
        <footer class="modal-card-foot">
            <button class="button" onclick="document.getElementById('exampleModal').style.display='none'">Aceptar</button>
        </footer>


    </div>
</div>
<!------------------ FIN VENTANA MODAL -------------------------->

<!---------------- < SCRIPTS > -------------------------->

<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            dom: "<'columns table-wrapper'<'column is-12'tr>><'columns table-footer-wrapper'<'column is-5'i><'column is-7'p>>"
        });

        $('#table-search').on('keyup', function() {
            let value = $(this).val();
            table.search(value).draw();
        });

        $('#table-length').on('change', function() {
            let value = $(this).val();
            table.page.len(value).draw();
        });

        $('#table-reload').on('click', function() {
            table.draw();
        });
    });
</script>

<!-- SCRIPT PARA CREAR MODALES DINAMICOS -->
<script type="text/javascript">
    <?php
    foreach ($companyList as $value) {
        echo "var boton" . $value->getCompanyId() . "= document.getElementById('modifyButton2" . $value->getCompanyId() . "');";
        echo "boton" . $value->getCompanyId() . ".onclick = function(){ modal.style.display = 'block'; };";
        
    }
    ?>
</script>


<script type="text/javascript">
    var button = document.getElementById('modifyButton');
    //var botoncito =  document.getElementById('modifyButton2');
    var modal = document.getElementById('exampleModal');
    var close = document.getElementById('modal-close');
</script>



<!-- --------------- < SCRIPTS > ------------------------->