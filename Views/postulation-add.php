<?php 
    $user = $_SESSION['loggedUser']; 
    include('top-nav.php'); 

?>

<div class="columns" id="app-content">

    <?php include('user-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-header">
            <h4 class="title is-4">Fomrulario</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Postulacion</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Aplicar una Postulacion</a></li>
                </ul>
            </nav>
        </div>

        <div class="content-body">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <p class="title is-4">Mis Datos</p>
                            <p style="color: red;font-size:18px"> </p>
                            <form action="<?= FRONT_ROOT ?>Postulacion/Add  <?php echo FRONT_ROOT ?>File/Upload" method="POST">

                                <div class="field">
                                    <label class="label">Oferta de Trabajo </label>
                                    <div class="control">
                                        <input class="input" name="jobOffer" type="text" placeholder="" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Estudiante</label>
                                    <div class="control">
                                        <input class="input" name="student" type="text" placeholder="" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Fecha</label>
                                    <div class="control">
                                        <input class="input" name="date" type="date" placeholder="date" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Presentacion</label>
                                    <div class="control">
                                        <input class="input" name="presentation" type="text" placeholder="Breve presentacion de vos" required="">
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Carga tu Curriculum</label>
                                    <div class="control">
                                        <input class="form-control-file" name="cv" type="file" placeholder="" required="">
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