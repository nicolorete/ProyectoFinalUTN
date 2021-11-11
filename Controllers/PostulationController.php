<?php

namespace Controllers;

use DAO\PostulationDAOPDO as PostulationDAOPDO;
use DAO\CompanyDAOPDO as CompanyDAOPDO;
use DAO\StudentDAOPDO as StudentDAOPDO;
use DAO\JobOfferDAOPDO as JobOfferDAOPDO;
use DAO\FileDAOPDO as FileDAOPDO;
use Exception;
use Models\Postulation as Postulation;
use Models\File as File;
use Models\JobOffer;



class PostulationController
{

    private $jobOfferDAO;
    private $companyDAO;
    private $studentDAO;
    private $postulationDAO;
    private $fileDAO;
    


    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDAOPDO();
        $this->postulationDAO = new PostulationDAOPDO();
        $this->companyDAO = new CompanyDAOPDO();
        $this->studentDAO = new StudentDAOPDO();
        $this->fileDAO = new FileDAOPDO();
        
    }

    public function Add()
    {

        // echo "hola";

        $postulation = new Postulation;


        $postulation->setJobOffer($_POST['joboffer']);
        $postulation->setStudent($_POST['student']);
        $postulation->setDatePostulation($_POST['date']);
        $postulation->setPresentation($_POST['presentation']);
        // $postulation->setFile($_POST['file']);
        $postulation->setFile(2);
        $postulation->setIsActive($_POST['active']);


        $lista = $this->postulationDAO->searchStudent($_POST['student']);

        if ($lista != 1) {
            $this->postulationDAO->Add($postulation);
        } else {
?>
            <script>
                alert('Ya tienes una postulacion activa');
            </script>
        <?php
        }

        // $user = $this->studentDAO->GetProfileByIdUser($_POST['student']);
        // var_dump($user);
        // $this->ShowListView();

        $this->ShowUploadView();
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


    public function ShowAddView($jobOfferId)
    {
        $studentFound = null;
        $jobOfferFound = null;
        // $studentFound = $this->studentDAO->GetStudentByEmail($studentId);
        $jobOfferFound = $this->jobOfferDAO->GetById($jobOfferId);
        require_once(VIEWS_PATH . "postulation-add.php");
    }

    public function ShowListView()
    {

        $postulationList = $this->postulationDAO->GetAll();
        require_once(VIEWS_PATH . "postulation-record.php");
    }

    public function ShowListViewAdmin()
    {

        $postulationList = $this->postulationDAO->GetAll();
        require_once(VIEWS_PATH . "admin-postulation-list.php");
    }



    ///////////////////////////////////////////////////Manejo del File/////////////////////////////////////////////////////////

    public function Upload($file)
    {
        try {
            $user= $_SESSION['loggedUser'];
            $fileName = $file["name"];
            $tempFileName = $file["tmp_name"];
            $type = $file["type"];

            $filePath = UPLOADS_PATH . basename($fileName);
            $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            // $imageSize = getimagesize($tempFileName);


            if (move_uploaded_file($tempFileName, $filePath)) {
                $file = new File();
                $file->setName($fileName);
                $file->setFileId($user->getStudentId());
                $this->fileDAO->Add($file);

                $message = "archivo subido correctamente";
            } else
                $message = "Ocurrió un error al intentar subir el archivo";
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        }

        ?>
        <script>
            alert('Curriculum agregado correctamente');
        </script>
        <?php
        $this->ShowListView();

    }
    public function ShowUploadView()
    {
        require_once(VIEWS_PATH . "upload-file.php");
    }

    public function ShowPostulationView($fileId)
    {
        $this->fileDAO->GetByFileId($fileId);

        require_once(VIEWS_PATH . "postulation-continue.php");
    }

    public function Showfile($fileId)
    {
        $file = $this->fileDAO->getByFileId($fileId);

        require_once(VIEWS_PATH . "file-show.php");
    }
}
