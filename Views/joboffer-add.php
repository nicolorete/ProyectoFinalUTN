<?php
$user = $_SESSION['loggedAdmin'];
include('top-nav.php');

?>

<div class="columns" id="app-content">

    <?php include('admin-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-header">
            <h4 class="title is-4">Forms</h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Propuestas</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Agregar Propuesta</a></li>
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
                            <form action="<?= FRONT_ROOT ?>JobOffer/Add" method="POST">

                                <div class="field">
                                    <label class="label">Titulo </label>
                                    <div class="control">
                                        <input class="input" name="title" type="text" placeholder="Titulo de la publicacion" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Fecha de Publicacion</label>
                                    <div class="control">
                                        <input class="input" name="date" type="date" placeholder="" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Descripcion </label>
                                    <div class="control">
                                        <input class="input" name="description" type="text" placeholder="Breve descripcion" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="jobPositionId">Puesto de Trabajo: </label>
                                    <div class="control">
                                        <select class="select" name="jobPositionId">
                                        <?php
                                        foreach ($jobPositionList as $jobPosition) 
                                        {
                                             ?><option value="<?php echo $jobPosition->getJobPositionId() ?>"><?php echo $jobPosition->getDescription() ?></option><?php
                                        } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="companyId">Puesto de Trabajo: </label>
                                    <div class="control">
                                        <select class="select" name="companyId">
                                        <?php
                                            foreach ($companyList as $company)
                                            { 
                                                ?><option value="<?php echo $company->getCompanyId() ?>"><?php echo $company->getName() ?></option><?php
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Publicacion activa? </label>
                                    <div class="control">
                                        <select class="select" id="active" name="active">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="field is-grouped centered" style="padding-left: 30%">
                                    <div class="control">
                                        <button class="button is-link" type="submit">Cargar</button>
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