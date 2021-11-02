<?php
    namespace Controllers;

    use DAO\JobPositionDAOPDO as JobPositionDAOPDO;
use Exception;
use Models\Career;
use PDOException;

class JobPositionController
    {
        private $jobPositionDAO;

        public function __construct(){
            
            $this->jobPositionDAO = new JobPositionDAOPDO();
        }

        
       

        // public function ShowListView(){
        //     $JobPostionList = $this->jobPositionDAOPDO->GetJobPositionListFromApi();

        //     require_once(VIEWS_PATH."user-dashboard.php");
        // }

      
        public function ShowListView()
        {
            // Trae los jobpositions Primero local, despues de la api
            // $JobPostionList = null;
            // $JobPostionList = $this->jobPositionDAO->RetrieveData();
            // if ($JobPostionList == null) {
            //     echo "<script>alert('Trayendo jobPositions de la API');</script>";
            //     $JobPostionList = $this->jobPositionDAO->GetJsonFromAPI();
            // }
    
            // # Trae las careers. Primero local. Despues de  la api
            // $careerList = null;
            // $careerList = $this->jobPositionDAO->RetrieveGenreData();
            // if ($careerList != null) {
            //     echo "<script>alert('Careers del archivo local');</script>";
            // } else {
            //     echo "<script>alert('Careers de la API');</script>";
            //     $careerList = $this->jobPositionDAO->getJsonGenre();
            // }
            // $this->jobPositionDAO->SaveGenreData();
    
            require_once(VIEWS_PATH . "jobPosition-list.php");
        }

        public function Update($message = '')
	{
		try {
			$jobPositionList = null;
			$jobPositionList = $this->jobPositionDAO->GetJobPositionListFromAPI();

			$careerList = null;
			$careerList = $this->jobPositionDAO->GetCareerListFromAPI();

			# Agrego las career
			if ($careerList != null) {
				foreach ($careerList as $career) {
					$this->jobPositionDAO->Addcareer($career);
				}
			}

			# Agrego las Jobpositions y las career x jobPosition
			if ($jobPositionList != null) {
				foreach ($jobPositionList as $jobPosition) {
					$this->jobPositionDAO->Add($jobPosition);
					$this->jobPositionDAO->AddJobPositionCareer($jobPosition);
				}
			}

			$message = 'Jobpositions actualizadas con sus career';

			require_once(VIEWS_PATH . 'admin-dashboard.php');
		} catch (Exception $ex) {
			$message = 'Oops ! ' . $ex->getMessage();
		} catch (PDOException $e) {
			throw $e;
		}
	}


        // public function UpdateJPAndCareers()
	    // {   
        //     $jobPositionList = null;
        //     $careerList = null;
        //     $jobPositionList = $this->jobPositionDAO->GetJobPositionListFromAPI();
        //     $careerList = $this->jobPositionDAO->GetCareerListFromAPI();

        //     if ($jobPositionList != null) {
        //         foreach ($jobPositionList as $jobPosition) {
        //             $jobPositionFound = null;
        //             $jobPositionFound = $this->jobPositionDAO->GetJobPositionByTitle($jobPosition->getTitle());
        //             if ($jobPositionFound = null) {
        //                 $this->jobPositionDAO->Add($jobPosition);			 # Si no está, la agrego a la base de datos
        //                 $this->jobPositionDAO->AddJobPositionCareer($jobPosition); # Agrego los generos de esa pelicula a la tabla intermedia
        //             }
        //         }
        //     }

        //     if ($careerList != null) {
        //         $this->jobPositionDAO->DeleteAllCareers();

        //         foreach ($careerList as $career) {
        //             $careerFound = null;
        //             $careerFound = $this->jobPositionDAO->GetCareerByDescription($career->GetDescription());
        //             if ($careerFound = null) {
        //                 $this->jobPositionDAO->AddCareer($career);
        //             }
        //         }
        //     }
	    // }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        // public function updateFromAPI(){
        //     $this->studentDAO->retrieveAPI();

        //     $this->ShowListView();
        // }


        //----------------------------------------------------------//

          
    
    }