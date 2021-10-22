<?php

namespace Views;

include('top-nav.php');

use models\User as User;
use DAO\UserDAO as UserDAO;
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
                    <li class="is-active"><a href="#" aria-current="page">Listado de Usuarios</a></li>
                    
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="card">

                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th>Id Usuario</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Dni</th>
                                <th>Rol </th>
                                <th class="has-text-centered">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($userList as $user) {

                                ?>
                                <tr>
                                    <td><?= $user->getId(); ?></td>
                                    <td><?= $user->getEmail(); ?></td>
                                    <td><?= $user->getFirstName(); ?></td>
                                    <td><?= $user->getLastName(); ?></td>
                                    <td><?= $user->getDni(); ?></td>
                                    <!-- <td><?= $user->getRole(); ?></td> -->
                                    <td class="has-text-centered">

                                        <div class="field is-grouped action">
                                            <p class="control">

                                                <a class="button is-rounded is-text btnEdit" id="modifyButton2<?= $user->getId(); ?>" onclick="">
                                                    <span class="icon">
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                            </p>

                                            <form action="<?= FRONT_ROOT ?>User/Delete" method="post">
                                                <p class="control">
                                                    <button class="button is-rounded is-text action-delete" name="BtnDel" data-id="1" value="<?= $user->getId(); ?>">
                                                        <span class="icon">
                                                            <?php if ($company->getRole() == 0) {
                                                                    echo "<i class='fa fa-toggle-off'></i>";
                                                                } else {
                                                                    echo "<i class='fa fa-toggle-on'></i>";
                                                                }
                                                                ?>

                                                        </span>
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
<!------------------ VENTANA MODAL --------------------------------->
<div class="modal" id="exampleModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Modificar Usuario</p>
            <button class="delete" aria-label="close" onclick="document.getElementById('exampleModal').style.display='none'"></button>
        </header>

        <section class="modal-card-body">
            <form action="<?= FRONT_ROOT ?>User/Modify" method="POST">
                <div class="field">
                    <!-- Id Cine (hidden) -->
                    <div class="control">
                        <input class="input" name="id" type="number" placeholder="Id Usuario" id="id" hidden="true">
                    </div>
                </div>

          

                <div class="field">
                    <label class="label">Email </label>
                    <div class="control">
                        <input class="input" name="email" type="text" placeholder="Cuit" id="name">
                    </div>
                </div>


                <div class="field">
                    <label class="label">Nombre </label>
                    <div class="control">
                        <input class="input" name="firstName" type="text" placeholder="Nombre de la Empresa" id="name">
                    </div>
                </div>

               
                <div class="field">
                    <label class="label">Apellido</label>
                    <div class="control">
                        <input class="input" name="lastName" type="text" placeholder="Direccion" id="address">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Dni</label>
                    <div class="control">
                        <input class="input" name="dni" type="text" placeholder="Direccion" id="address">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Dni</label>
                    <div class="control">
                        <input class="input" name="dni" type="text" placeholder="Direccion" id="address">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Nueva Pass</label>
                    <div class="control">
                        <input class="input" name="password" type="text" placeholder="Direccion" id="address">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Es Admin?: </label>
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