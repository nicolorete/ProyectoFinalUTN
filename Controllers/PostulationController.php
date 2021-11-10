<?php
    namespace Controllers;

    use DAO\PostulationDAOPDO as PostulationDAOPDO;
    use DAO\CompanyDAOPDO as CompanyDAOPDO;
    use DAO\StudentDAOPDO as StudentDAOPDO;
    use DAO\JobOfferDAOPDO as JobOfferDAOPDO;
    use Models\Postulation as Postulation;
    
class PostulationController {
    
    private $jobOfferDAO;
    private $companyDAO;
    private $studentDAO;
    private $postulationDAO;


    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAOPDO();
        $this->postulationDAO = new PostulationDAOPDO();
        $this->companyDAO = new CompanyDAOPDO();
        $this->studentDAO = new StudentDAOPDO();
    }
    
    public function Add(){

        // echo "hola";
        
        $postulation = new Postulation;
        $postulation->setJobOffer($_POST['joboffer']);
        $postulation->setStudent($_POST['student']);
        $postulation->setDatePostulation($_POST['date']);
        $postulation->setPresentation($_POST['presentation']);
        $postulation->setCv(5);
        $postulation->setIsActive($_POST['active']);
            

        var_dump($postulation);
        $this->postulationDAO->Add($postulation);
            
        $this->ShowListView();

    }

    public function Delete($id)
    {
        $this->postulationDAO->Delete($id);
        $this->ShowListView();
    }

    public function ShowAddView($jobOfferId){
        $studentFound = null;
        $jobOfferFound = null;
		// $studentFound = $this->studentDAO->GetStudentByEmail($studentId);
		$jobOfferFound = $this->jobOfferDAO->GetById($jobOfferId);
        require_once(VIEWS_PATH. "postulation-add.php");
    }

    public function ShowListView(){
        require_once(VIEWS_PATH. "postulation-record.php");
    }
}
