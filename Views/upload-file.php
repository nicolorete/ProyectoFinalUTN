<?php
$user = $_SESSION['loggedUser'];
include('top-nav.php');
require_once("validate-session.php");

?>

<div class="columns" id="app-content">

    <?php include('user-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-body">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="field">
                                <p class="title is-4">Primero Carga tu Curriculum:</p>
                                <form action=" <?php echo FRONT_ROOT ?>Postulation/Upload" enctype="multipart/form-data" method="POST">
                                    <div class="field">
                                        <label class="label">Selecciona un archivo .doc o .pdf</label>

                                        <div class="control">
                                            <input class="form-control-file" name="cv" type="file" placeholder="" required="">
                                           

                                        </div>
                                    </div>
                                    <div class="field is-grouped centered" style="padding-left: 30%">
                                        <div class="control">
                                            <button class="button is-link" type="submit">Subir</button>
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
</div>