<?php
    namespace Controllers;

    use DAO\JobPositionDAOPDO as JobPositionDAOPDO;
    
    
    use Models\Career;
    

class JobPositionController
    {
        private $jobPositionDAOPDO;

        public function __construct(){
            
            $this->jobPositionDAOPDO = new JobPositionDAOPDO();
        }

        
       

        // public function ShowListView(){
        //     $JobPostionList = $this->jobPositionDAOPDO->GetJobPositionListFromApi();

        //     require_once(VIEWS_PATH."user-dashboard.php");
        // }

      
        public function ShowListView()
        {
            // Trae las peliculas Primero local, despues de la api
            $jobPositionList = null;
            $jobPositionList = $this->jobPositionDAOPDO->GetJobPositionListFromApi();
           
    
            # Trae los generos. Primero local. Despues de  la api
            $careerList = null;
            // $careerList = $this->jobPositionDAOPDO->GetCareerListFromAPI();
            if ($careerList != null) {
                echo "<script>alert('Generos del archivo local');</script>";
            } else {
                echo "<script>alert('Generos de la API');</script>";
                $careerList = $this->jobPositionDAOPDO->GetCareerListFromAPI();
            }
            // $this->jobPositionDAOPDO->SaveGenreData();
    
            require_once(VIEWS_PATH . "user-dashboard.php");
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        // public function updateFromAPI(){
        //     $this->studentDAO->retrieveAPI();

        //     $this->ShowListView();
        // }


        //----------------------------------------------------------//

          
    
    }