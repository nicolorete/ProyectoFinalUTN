<?php


    $user = $_SESSION['loggedAdmin']; 
    include('top-nav.php');
    require_once("validate-session-admin.php");
    



use models\Company as Company;
use Models\Admin as Admin;
use DAO\CompanyRepository as CompanyDAO;
?>

<div class="columns" id="app-content">
    <?php include('admin-aside-nav.php'); ?>


    <div class="column is-10" id="page-content">
        <div class="content-header">
            <h4 class="title is-4">Listados</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Administrar Empresas</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Listado de Empresas</a></li>
                    
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="card">

                <div class="card-content">
                
                <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" id="table-search" type="text" placeholder="Ingrese nombre de la Empresa">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>                       
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" href="#">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Buscar</span>
                                </a>
                            </p>
                        
                        </div>
                        
                </div>



                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th class="has-text-centered">Id Empresa</th>
                                <th class="has-text-centered">Cuit</th>
                                <th class="has-text-centered">Nombre</th>
                                <th class="has-text-centered">Direccion</th>
                                <th class="has-text-centered">Link</th>
                                <th class="has-text-centered">Activo </th>
                                <th class="has-text-centered">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($companyList as $company) {

                                ?>
                                <tr>
                                    <td class="has-text-centered"><?= $company->getCompanyId(); ?></td>
                                    <td class="has-text-centered"><?= $company->getCuit(); ?></td>
                                    <td class="has-text-centered"><?= $company->getNombre(); ?></td>
                                    <td class="has-text-centered"><?= $company->getAddress(); ?></td>
                                    <td class="has-text-centered"><?= $company->getLink(); ?></td>

                                    <td class="has-text-centered">
                                        <form action="<?= FRONT_ROOT ?>Company/Delete" method="post">
                                            <p class="control has-text-centered">
                                                <button class="button is-rounded is-text action-delete" name="BtnDel" data-id="1" value="<?= $company->getCompanyId(); ?>">
                                                    <span class="icon">
                                                        <?php if ($company->getIsActive() == 0) {
                                                                echo "<i class='fa fa-toggle-off'></i>";
                                                                } else {
                                                                echo "<i class='fa fa-toggle-on'></i>";
                                                                }
                                                        ?>

                                                    </span>
                                                </button>
                                            </p>
                                        </form>
                                    </td>
                                    <td class="has-text-centered">

                                        <div class="field is-grouped action">
                                            <p class="control">
                                                <form action="<?= FRONT_ROOT ?>Company/ShowCompanyEditView" method="post">
                                                            <button class="button is-warning btnEdit" id="modifyButton2<?= $company->getCompanyId(); ?>" value="<?= $company->getCompanyId(); ?>" name="companyId" type="submit">
                                                                Editar
                                                </form>
                                                 <!-- <a class="button is-rounded is-text btnEdit"  onclick="">
                                                    <span class="icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>  -->
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
<!-- <div class="modal" id="exampleModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Modificar Empresa</p>
            <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button>
        </header>

        <section class="modal-card-body">
            <form action="<?= FRONT_ROOT ?>Company/Modify" method="POST">
                <div class="field">
                    
                    <div class="control">
                        <input class="input" name="idCompany" type="number" placeholder="" id="id" hidden="true">
                    </div>
                </div>

          

                <div class="field">
                    <label class="label">Cuit </label>
                    <div class="control">
                        <input class="input" name="cuit" type="text" placeholder="Cuit" id="name" value="<?php echo $company->getCuit()?>">
                    </div>
                </div>


                <div class="field"> 
                    <label class="label">Nombre </label>
                    <div class="control">
                        <input class="input" name="nombre" type="text" placeholder="" id="name" value="<?php echo $company->getNombre()?>">
                    </div>
                </div>

               
                <div class="field">
                    <label class="label">Direccion</label>
                    <div class="control">
                        <input class="input" name="address" type="text" placeholder="Direccion" id="address" value="<?php echo $company->getAddress()?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Link</label>
                    <div class="control">
                        <input class="input" name="link" type="text" placeholder="Direccion" id="address" value="<?php echo $company->getLink()?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Empresa activa?: </label>
                    <div class="control">
                        <select class="select" id="active" name="active">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>

                    </div>
                </div>


        </section>

        <footer class="modal-card-foot">
            <button class="button is-success" type="submit">Modificar</button>
            </form>
            <button class="button" onclick="document.getElementById('exampleModal').style.display='none'">Cancel</button>
        </footer>


    </div>
</div> -->
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
        echo "boton" . $value->getCompanyId() . ".onclick = function(){
                    modal.style.display = 'block';
                    };";
    }
    ?>
</script>


<script type="text/javascript">
    var button = document.getElementById('modifyButton');
    // var botoncito =  document.getElementById('modifyButton2');
    var modal = document.getElementById('exampleModal');
    var close = document.getElementById('modal-close');
</script>

<script type="text/javascript">
    var fila;
    // Codigo para boton editar
    $(document).on("click", ".btnEdit", function() {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        name = fila.find('td:eq(1)').text();
        //capacity = parseInt(fila.find('td:eq(2)').text());
        //ticketPrice = parseInt(fila.find('td:eq(3)').text());
        address = fila.find('td:eq(2)').text();
        active = fila.find('td:eq(3)').text();


        $("#id").val(id);
        $("#cuit").val(cuit);
        $("#nombre").val(nombre);
       
        $("#address").val(address);
        $("#active").val(active);


    });
</script>
<!-- --------------- < SCRIPTS > ------------------------->