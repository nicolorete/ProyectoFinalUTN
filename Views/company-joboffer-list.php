<?php
    if($_SESSION['logged'] == "s"){
        $user = $_SESSION['loggedUser']; 
    }else{
        $user = $_SESSION['loggedCompany']; 
    }
    
    include('top-nav.php');

    
    use models\JobOffer as jobOffer;
    use DAO\JobOfferDAOPDO as jobOfferDAO;

    $jobOffer = new jobOfferDAO();
    $jobOfferList = $jobOffer->GetAll(); 
?> 



<div class="columns" id="app-content">
    <?php include('company-aside-nav.php');?>

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
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($jobOfferList as $jobOffer) {
                            
                            if($user->getCompany() == $jobOffer->getCompany()->getCuit() ){
                        ?>
                        <tr>
                            
                            <td><?= $jobOffer->getTitle(); ?></td>
                            <td><?= $jobOffer->getCompany()->getNombre(); ?></td>
                            <td><?= $jobOffer->getJobPosition()->getDescription(); ?></td>
                            <td><?= $jobOffer->getDescription(); ?></td>

                            <td class="has-text-centered">
                            
                                
                            </td>
                        </tr>
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>