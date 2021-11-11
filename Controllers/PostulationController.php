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
            

        $lista = $this->postulationDAO->searchStudent($_POST['student']);
        
        if($lista != 1){
            $this->postulationDAO->Add($postulation);
        }else{
            ?>
                <script>alert('Ya tienes una postulacion activa');</script>
            <?php
        }
        
        // $user = $this->studentDAO->GetProfileByIdUser($_POST['student']);
        // var_dump($user);
        $this->ShowListView();

    }

    // public function Delete($id)
    // {
    //     $this->postulationDAO->Delete($id);
    //     $this->ShowListView();
    // }
    public function Delete($id)
    {
        $postulationFound = null;
        $postulationFound = $this->postulationDAO->GetPostulationById($id);
        if ($postulationFound != null) {
            if ($postulationFound->getIsActive() == 1) {
                $postulationFound->setIsActive(0);
                
            } else {
                $postulationFound->setIsActive(1);
               
            }
        }
        $this->postulationDAO->Modify($postulationFound);
        $this->ShowListViewAdmin();
    }

    public function ShowAddView($jobOfferId){
        $studentFound = null;
        $jobOfferFound = null;
		// $studentFound = $this->studentDAO->GetStudentByEmail($studentId);
		$jobOfferFound = $this->jobOfferDAO->GetById($jobOfferId);
        require_once(VIEWS_PATH. "postulation-add.php");
    }
    
    public function ShowListView(){
        
        $postulationList = $this->postulationDAO->GetAll(); 
        require_once(VIEWS_PATH. "postulation-record.php");
    }

    public function ShowListViewAdmin(){
        
        $postulationList = $this->postulationDAO->GetAll(); 
        require_once(VIEWS_PATH. "admin-postulation-list.php");
    }
}
