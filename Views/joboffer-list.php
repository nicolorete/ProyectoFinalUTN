<?php

    if($_SESSION['loggedAdmin'] == "undefined"){
        $user = $_SESSION['loggedAdmin']; 
    }else{
        $user = $_SESSION['loggedUser']; 
    }

    include('top-nav.php');

    
    use models\JobOffer as jobOffer;
    use DAO\JobOfferDAOPDO as jobOfferDAO;

    $jobOffer = new jobOfferDAO();
    $jobOfferList = $jobOffer->GetAll(); 
?> 

<div class="columns" id="app-content">
    <?php include('user-aside-nav.php');?>

    <div class="column is-10" id="page-content">

    <div class="content-body">
        <h4 class="title is-4">Ofertas de Trabajo </h4>
            

        <div class="content-header">
            <h4 class="title is-4">Propuestas </h4>
            <span class="separator"></span>
            <nav class="breadcrumb has-bullet-separator" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Listar Propuestas</a></li>
                    <li class="is-active"><a href="#" aria-current="page">Propuestas</a></li>
                    <li style="color:red"><b>    </b></li>
                </ul>
            </nav>
        </div>


        <div class="content-body">
            <div class="card">
                <form action="" method="POST">
                    <div class="card-filter">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="table-search" type="text" placeholder="Buscar Por Empresa">
                                <span class="icon is-left">
                                    <i class="fa fa-search"></i>
                                </span>

                            </div>
                        </div>
                        <div class="field">
                            <button class="button is-link has-icons-right" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                <th class="has-text-centered"> Titulo</th>
                                <th class="has-text-centered"> Fecha</th>
                                <th class="has-text-centered"> Empresa</th>
                                <th class="has-text-centered"> Puesto</th>
                                <th class="has-text-centered">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($jobOfferList as $jobOffer) {

                        ?>
                        <tr>
                            <td><?= $jobOffer->getTitle(); ?></td>
                            <td><?= $jobOffer->getDate(); ?></td>
                            <td><?= $jobOffer->getCompany()->getNombre(); ?></td>
                            <td><?= $jobOffer->getJobPosition(); ?></td>
                            <td><?= $jobOffer->getDescription(); ?></td>

                            <!-- <td class="has-text-centered">
                            
                                <div class="field is-grouped action">
                                     <p class="control">
                                        <form action="" method="post">
                                            <button class="button is-warning btnEdit" value=""name=" " type="submit">
                                                Ver Oferta
                                            </button>
                                        </form>
                                    </p>
                                    <form action="" method="post">
                                        <p class="control">
                                            <button class="button is-danger" name="BtnDel" data-id="1" value="">
                                                Aplicar
                                            </button>
                                        </p>
                                    </form> 
                                </div>
                            </td> -->
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>