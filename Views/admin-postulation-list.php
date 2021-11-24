<?php

$user = $_SESSION['loggedAdmin'];
require_once("validate-session-admin.php");

use models\Postulation as postulation;
use models\JobOffer as jobOffer;
use models\Student as student;
use DAO\PostulationDAOPDO as postulationDAO;
use models\File as File;
use DAO\StudentDAOPDO as StudentDAOPDO;


$alumno = new StudentDAOPDO;

?>
<?php include('top-nav.php'); ?>


<div class="columns" id="app-content">
    <?php include('admin-aside-nav.php'); ?>

    <div class="column is-10" id="page-content">

        <div class="content-header">
            <h4 class="title is-4">Postulaciones </h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Mis postulaciones</a></li>

                    <li style="color:red"><b></b></li>
                </ul>
            </nav>
        </div>
        <?php
        foreach ($postulationList as $postulation) {
           
        ?>
            <div class="card">


                <div class="content-body">

                    <div class="card-content">
                        <div class="field">
                            <label class="label">Oferta de trabajo: </label>
                            <?php echo $postulation->getJobOffer()->getTitle(); ?>
                        </div>
                        <div class="field">
                            <label class="label">Estudiante </label>
                            
                            <?php echo $studentFound->getFirstName(); ?>
                            
                        </div>

                        <div class="field">
                            <label class="label">Fecha </label>
                            <?= $postulation->getDatePostulation(); ?>
                        </div>

                        <div class="field">
                            <label class="label">Presentacion </label>
                            <?= $postulation->getPresentation();
                            ?>
                        </div>

                        <div class="field">
                            <label class="label">Archivo </label>
                            <?php
                            foreach ($fileList as $file) {
                                if ($postulation->getStudent() == $file->getFileId()) {

                                ?>
                                    <tr>
                                    <?= $file->getName();?>
                                        <td><a href="<?php echo FRONT_ROOT ?>Postulation/ShowFile/<?php echo $file->getFileId() ?>">Descargar</a></td>
                                    </tr>
                                    
                                    <?php }
                                ?> 

                                <?php
                            }

                                ?>

                        </div>

                        <div class="field ">

                            <label class="label">Estado: </label>
                            <form class="container" action="<?= FRONT_ROOT ?>Postulation/Delete" method="post">
                                <p class="control container">
                                    <button class="button is-rounded is-text action-delete" name="BtnDel" data-id="1" value="<?= $postulation->getPostulationId(); ?>">
                                        <span class="icon">
                                            <?php if ($postulation->getIsActive() == 0) {
                                                echo "<i class='fa fa-toggle-off'></i>";
                                            ?> <label class="label ">Rechazada</label><?php
                                                                                        } else {
                                                                                            echo "<i class='fa fa-toggle-on'></i>";
                                                                                            ?> <label class="label">Activa</label> <?php
                                                                                        }
                                                                                        ?>

                                        </span>
                                    </button>
                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>