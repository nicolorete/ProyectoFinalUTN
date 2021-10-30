<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
use Exception;
use Models\Career;
    use Models\Student as Student;
use PDOException;

class StudentController
    {
        private $studentDAO;

        public function __construct(){
            $this->studentDAO = new StudentDAO();
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

        public function ShowProfileView($studentId){
            $student = $this->getStudentById($studentId);

            require_once(VIEWS_PATH."user-profile.php");
        }

        //DELETES THE LIST AND FILLS WITH THE API DATA
        public function updateFromAPI(){
            $this->studentDAO->retrieveAPI();

            $this->ShowListView();
        }
//-------------------------------------------------------//
        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH . 'user-register.php');
        }
        public function ShowLoginView($message = "")
	    {
		    require_once(VIEWS_PATH . 'home.php');
	    }        


        public function UserAdd($email, $password, $lastName, $dni)
	    {
		try {
			$userFound = null;
			# Buscar si existe el mail
			$userFound = $this->userDAO->GetUserByEmail($email);
			var_dump($userFound);
			if ($userFound == null) {
				$newUser = new Student();
				
				

				$newUser->setEmail($email);
				// $newUser->setPassword($password);
	

				# Crear el User Profile

				$newUser->setLastName($lastName);
				$newUser->setDni($dni);

				$this->userDAO->Add($newUser);
				$message = 'Usuario creado!';
			} else {
				$message = 'Ya existe el correo registrado';
			}
			$this->ShowLoginView($message);
		} catch (Exception $ex) {
			$message = 'Oops ! ' . $ex->getMessage();
		} catch (PDOException $e) {
			throw $e;
		}

        
	}


    // public function ShowListView(){
    //     // $studentList = $this->studentDAO->getAll();

    //     $studentList = null;
    //     $studentList = $this->studentDAO->GetAll();
    //     if ($studentList == null) {
    //     echo "<script>alert('Trayendo pelis de la API');</script>";
    //     $studentList = $this->studentDAO->GetStudentListFromApi();
    // }
    //     require_once(VIEWS_PATH."user-list.php");
    // }

    }

    
?> 