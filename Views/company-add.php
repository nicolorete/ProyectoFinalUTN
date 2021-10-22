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
                    <li><a href="#">Administrar Empresas</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Agregar Empresa</a></li>
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
                            <form action="<?= FRONT_ROOT ?>Company/Add" method="POST">

                                <div class="field">
                                    <label class="label">Cuit </label>
                                    <div class="control">
                                        <input class="input" name="cuit" type="text" placeholder="Cuit del Cine" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Nombre</label>
                                    <div class="control">
                                        <input class="input" name="nombre" type="text" placeholder="Nombre de la Empresa" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Direccion</label>
                                    <div class="control">
                                        <input class="input" name="address" type="address" placeholder="Direccion" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Link</label>
                                    <div class="control">
                                        <input class="input" name="link" type="text" placeholder="" required="">
                                    </div>
                                </div>


                                <!-- AGREGAMOS UN INPUT FIJO PARA QUE SI O SI AGREGUE AL MENOS UNA SALA CON CAMPOS REQUERIDOS PARA VALIDAR EL INGRESO DE DATOS  -->

                               

                                <!-- campo = '<u><li id="labelName'+nextinput+'" style="font-size:20px">sala '+nextinput+':</u>	<input class="input"  type="text" size="20" id="nameSala' + nextinput + '"&nbsp; name="nameSala[]" value="SALA '+nextinput+'"  /></li><br><li id="labelCapacidad'+nextinput+'">Capacidad sala '+nextinput+':<input class="input" type="text" size="20" id="capacidadSala' + nextinput + '"&nbsp; name="capacidad[]"/></li><br><li id="labelPrecio'+nextinput+'">Precio ticket sala '+nextinput+':<input class="input" type="text" size="20" id="precioSala' + nextinput + '"&nbsp; name="precio[]" /></li><br>'; -->




                                <label class="label"><a href="#" onclick="AgregarCampos();">Agregar Empresa</a></label>
                                <div id="campos">
                                </div>






                                <!--<div class="field">
                                        <label class="label">Capacidad máxima</label>
                                        <div class="control">
                                            <input class="input" name="capacity" type="number" placeholder="Capacidad del cine" min="1" required="">

                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Precio de la entrada</label>
                                        <div class="control">
                                            <input class="input" name="ticketPrice" type="number" placeholder="Precio" step=".10" required="">
                                        </div>
                                    </div>-->



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