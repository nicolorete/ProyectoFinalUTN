<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use DAO\StudentDAOPDO as StudentDAOPDO;
    
    use Models\Career;
    use Models\Student as Student;

class StudentController
    {
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
            $this->studentDAOPDO = new StudentDAOPDO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."user-add.php");
        }

        public function Add($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active){
            
            $newStudent = new Student($firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);

            $studentList = $this->studentDAO->getAll();
            $this->setIdByLastId($studentList, $newStudent);

            

            $newCareer = new Career("N/A", "N/A", "N/A");
            $newStudent->setCareer($newCareer);

            $this->studentDAO->add($newStudent);

            header('location: '.FRONT_ROOT.'Student/ShowListView');
        }

        public function ShowListView(){
            $studentList = $this->studentDAO->getAll();

            require_once(VIEWS_PATH."user-list.php");
        }

        private function setIdByLastId($studentList, $student){
            if(empty($studentList)){
                $student->setstudentId(1); 
             } else {
                 $lastId = end($studentList)->getStudentId();
                 $student->setStudentId($lastId + 1);
             }
        }
       
    

        private function getStudentById($id){
            $studentList = $this->studentDAO->getAll();

            $student = null;

            foreach($studentList as $value){
                if($value->getStudentId() == $id)
                    $student = $value;
            }

            return $student;
        }

       

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function updateFromAPI(){
            $this->studentDAO->retrieveAPI();

            $this->ShowListView();
        }


        //----------------------------------------------------------//

        public function ShowRegisterView(){
            require_once(VIEWS_PATH."user-register.php");
        }

        public function ShowProfileView(){
            if (isset($_SESSION['loggedUser'])) {
                $loggedUser = $_SESSION['loggedUser'];
    
                $userData = $this->studentDAOPDO->GetProfileByIdUser($loggedUser->getStudentId());
                require_once(VIEWS_PATH . 'user-profile.php');
            } else {
                $message = 'Debe iniciar sesion';
                
            }
        }
    }
?> 