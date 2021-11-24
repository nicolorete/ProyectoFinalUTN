<?php
    if($_SESSION['logged'] == "s"){
        $user = $_SESSION['loggedUser']; 
    }else{
        $user = $_SESSION['loggedAdmin']; 
    }
    
    include('top-nav.php');

    
    use models\JobOffer as jobOffer;
    use DAO\JobOfferDAOPDO as jobOfferDAO;

    $jobOffer = new jobOfferDAO();
    $jobOfferList = $jobOffer->GetAll(); 
?> 



<div class="columns" id="app-content">

    <?php if($_SESSION['logged'] == "s"){
        include('user-aside-nav.php');
        }else {include('admin-aside-nav.php');} ?>

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
                <div class="card-content">
                    <table class="table is-hoverable is-bordered is-fullwidth" id="datatable">
                        <thead>
                            <tr>
                                
                                <th class="has-text-centered"> Titulo</th>
                                <th class="has-text-centered"> Empresa</th>
                                <th class="has-text-centered"> Puesto</th>
                                <th class="has-text-centered">Descripción</th>
                                <th class="has-text-centered">Estado</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($jobOfferList as $jobOffer) {

                        ?>
                        <tr>
                            
                            <td><?= $jobOffer->getTitle(); ?></td>
                            <td><?= $jobOffer->getCompany()->getNombre(); ?></td>
                            <td><?= $jobOffer->getJobPosition()->getDescription(); ?></td>
                            <td><?= $jobOffer->getDescription(); ?></td>
                            <td><?php 
                                if($jobOffer->getActive() == 1){
                                    ?>Activa<?php 
                                }else{ ?>Finalizada<?php }
                            ?></td>
                            

                            <td class="has-text-centered">
                            
                                <?php if($_SESSION['logged'] == "s"){?>
                                    <form action="<?= FRONT_ROOT ?>Postulation/ShowAddView" method="post">
                                        <p class="control">
                                            <button class="button is-danger" name="BtnDel" data-id="1" value="<?= $jobOffer->getJobOfferId(); ?>">
                                                Aplicar
                                            </button>
                                        </p>
                                    </form> 
                                <?php }elseif($jobOffer->getActive() == 1) {?>
                                    <form action="<?= FRONT_ROOT ?>Mailer/SendMail" method="post">
                                        <p class="control">
                                            <button class="button is-danger" name="BtnDel" data-id="1" value="<?= $jobOffer->getJobOfferId(); ?>">
                                                Finalizar
                                            </button>
                                        </p>
                                    </form> 
                                    <?php } ?>
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