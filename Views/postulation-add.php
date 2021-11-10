<?php 
    $user = $_SESSION['loggedUser']; 
    include('top-nav.php'); 

?>

<div class="columns" id="app-content">

    <?php include('user-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">
    <?php if ($jobOfferFound != null) { ?>
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
                            <p class="title is-4">Aplicar a <?= $jobOfferFound->getTitle(); ?>!</p>
                            <p style="color: red;font-size:18px"> </p>
                            <form action=" <?php echo FRONT_ROOT ?>Postulation/Add " method="POST">

                               

                                <div class="field">
                                    <label class="label">Estudiante: <?= $user->getFirstName(); $user->getLastName();?></label>
                                    <div class="control">
                                        <div style="font-weigth: 700;">Id</div>
                                        <input readonly class="input" name="student" type="text" value="<?= $user->getStudentId()?>" required="">
                                    </div>
                                </div>
                                
                                <div class="field">
                                    <label class="label">Fecha</label>
                                    <div class="control">
                                        <input readonly class="input" name="date" type="text" value="<?php $fechaActual = date('d-m-Y'); echo $fechaActual;?>" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Id de la oferta</label>
                                    <div class="control">
                                        <input readonly class="input" name="joboffer" type="text" value="<?=  $jobOfferFound->getJobOfferId()?>" required="">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Presentacion</label>
                                    <div class="control">
                                        <textarea class="input" name="presentation" type="text" placeholder="Breve presentacion de vos" required="" size="200"></textarea>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Carga tu Curriculum</label>
                                    <div class="control">
                                        <input class="form-control-file" name="cv" type="file" placeholder="" required="">
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Postulacion activa! </label>
                                    <div class="control">
                                        <select class="select" id="active" name="active">
                                            <option value="1">Si</option>
                                            <option value="1">Si</option>
                                            
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
            <?php } ?>
        </div>
        
    </div>
</div>