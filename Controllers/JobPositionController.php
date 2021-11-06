<?php
    namespace Controllers;

    use DAO\JobPositionDAOPDO as JobPositionDAOPDO;
    use DAO\CareerDAOPDO as CareerDAOPDO;
    use Exception;
    use Models\Career;
    use PDOException;

class JobPositionController
    {
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct(){
            
            $this->jobPositionDAO = new JobPositionDAOPDO();
            $this->careerDAO = new CareerDAOPDO();
        }
                
        public function ShowListView(){
            $JobPostionList = $this->jobPositionDAOPDO->GetJobPositionListFromApi();
        
            require_once(VIEWS_PATH."jobposition-list.php");
        }

        // public function ShowListView()
        // {
        //     // Trae los jobpositions Primero local, despues de la api
        //     $JobPostionList = null;
        //     $JobPostionList = $this->jobPositionDAO->GetAll();
        //     if ($JobPostionList == null) {
        //         echo "<script>alert('Trayendo jobPositions de la API');</script>";
        //         $JobPostionList = $this->jobPositionDAO->GetJobPositionListFromApi();
        //     }
    
        //     # Trae las careers. Primero local. Despues de  la api
        //     $careerList = null;
        //     $careerList = $this->jobPositionDAO->GetAllCareer();
        //     if ($careerList != null) {
        //         echo "<script>alert('Careers del archivo local');</script>";
        //     } else {
        //         echo "<script>alert('Careers de la API');</script>";
        //         $careerList = $this->careerDAO->GetCareerListFromAPI();
        //     }
          
    
        //     require_once(VIEWS_PATH . "jobPosition-list.php");
        // }

    //     public function Update($message = '')
	// {
	// 	try {
	// 		$jobPositionList = null;
	// 		$jobPositionList = $this->jobPositionDAO->GetJobPositionListFromAPI();

	// 		$careerList = null;
	// 		$careerList = $this->careerDAO->GetCareerListFromAPI();

	// 		# Agrego las career
	// 		if ($careerList != null) {
	// 			foreach ($careerList as $career) {
	// 				$this->jobPositionDAO->Addcareer($career);
	// 			}
	// 		}

	// 		# Agrego las Jobpositions y las career x jobPosition
	// 		if ($jobPositionList != null) {
	// 			foreach ($jobPositionList as $jobPosition) {
	// 				$this->jobPositionDAO->Add($jobPosition);
	// 				$this->jobPositionDAO->AddJobPositionCareer($jobPosition);
	// 			}
	// 		}

	// 		$message = 'Jobpositions actualizadas con sus career';

	// 		require_once(VIEWS_PATH . 'admin-dashboard.php');
	// 	} catch (Exception $ex) {
	// 		$message = 'Oops ! ' . $ex->getMessage();
	// 	} catch (PDOException $e) {
	// 		throw $e;
	// 	}
	// }


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
        //                 $this->jobPositionDAO->AddJobPositionCareer($jobPosition); 
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

       
        // public function updateFromAPI(){
        //     $this->jobPositionDAO->GetJobPositionListFromApi();

        //     $this->ShowListView();
        // }


        //----------------------------------------------------------//

          
    
    }