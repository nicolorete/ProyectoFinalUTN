<script type="text/javascript">
    var $  = require( 'jquery' );
    var dt = require( 'datatables.net' )();
</script>

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
                <!-- <form action="" method="POST">
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
                </form> -->
                <div class="card-content">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <script type="text/javascript">
    var $  = require( 'jquery' );
    var dt = require( 'datatables.net' )();
</script> -->