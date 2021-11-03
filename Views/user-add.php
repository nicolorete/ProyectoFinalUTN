<?php

namespace Views;

include('top-nav.php'); ?>

<div class="columns" id="app-content">

    <?php include('admin-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-header">
            <h4 class="title is-4">Forms</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Administrar Usuarios</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Agregar Usuario</a></li>
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-4">Formulario</p>
                            <p style="color: red;font-size:18px"> </p>
                            <form action="<?= FRONT_ROOT ?>User/Add" method="POST">

                                <div class="field">
                                    <label class="label">Email: </label>
                                    <div class="control">
                                        <input class="input" name="email" type="text" placeholder="Email" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Contraseña: </label>
                                    <div class="control">
                                        <input class="input" name="password" type="text" placeholder="Nombre de la Empresa" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Nombre</label>
                                    <div class="control">
                                        <input class="input" name="firstName" type="text" placeholder="Direccion" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Apellido: </label>
                                    <div class="control">
                                        <input class="input" name="lastName" type="text" placeholder="" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Dni: </label>
                                    <div class="control">
                                        <input class="input" name="dni" type="text" placeholder="" required="">
                                    </div>
                                </div>


                                

                               

                               



                               






                                <div class="field is-grouped centered" style="padding-left: 30%">
                                    <div class="control">
                                        <button class="button is-link" type="submit">Registrar</button>
                                    </div>
                                    <div class="control">
                                        <button class="button is-text" type="reset">Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>