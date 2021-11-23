<?php

namespace Controllers;
//db
use DAO\StudentDAOPDO as StudentDAOPDO;
use DAO\AdminDAOPDO as AdminDAOPDO;
use DAO\CompanyDAOPDO as CompanyDAOPDO;
use DAO\UserCompanyDAOPDO as UserCompanyDAOPDO;
// Json
use DAO\StudentDAO as StudentDAO;
use DAO\AdminDAO as AdminDAO;
use Exception;
// Modelos
use Models\Student as Student;
use Models\Admin as Admin;
use Models\UserCompany as UserCompany;
use PDOException;

/**
 * 
 */
class HomeController
{
	private $studentDAO;
	private $studentDAOPDO;
	private $adminDAO;
	private $adminDAOPDO;
	private $companyDAOPDO;
	private $userCompanyDAOPDO;
	

	function __construct()
	{
		$this->studentDAO = new StudentDAO();
		$this->studentDAOPDO = new StudentDAOPDO();
		$this->adminDAO = new AdminDAO();
		$this->adminDAOPDO = new AdminDAOPDO();
		$this->companyDAOPDO = new CompanyDAOPDO();
		$this->userCompanyDAOPDO = new userCompanyDAOPDO();
	}

	public function Index()
	{
		$this->ShowLoginView();

	}	

	// Funcion para ingresar al sistema.
	// public function Login($email, $password)
	// {
	// 	$userFound = null;
	// 	//$adminFound = null;
	// 	//$userFound = $this->studentDAO->GetByEmail($email);
	// 	$userFound = $this->studentDAOPDO->GetStudentByEmail($email);
	// 	if($userFound == null){
	// 		$userFound = $this->adminDAOPDO->GetAdminByEmail($email);
	// 	}
	// 	if ($userFound != null) {
	// 		if($userFound instanceof Admin && $password == $userFound->getPassword()){
	// 			$_SESSION['loggedAdmin'] = $userFound;
	// 			$_SESSION['logged'] = "a";

	// 			$this->ShowAdminView();
	// 		}
	// 		elseif($password == $userFound->getPassword() && $userFound->getActive() == true){		
	// 			$_SESSION['loggedUser'] = $userFound;
	// 			$_SESSION['logged'] = "s";

	// 			$message = 'Bienvenido Usuario';
	// 			$this->ShowUserView();
	// 			// var_dump($userFound);
	// 		}else{
	// 			$this->ShowLoginView();
				
	// 		}
	// 	}else{
	// 		$userFound = $this->studentDAO->GetByEmailApi($email);
	// 		if($userFound != NULL){
	// 			$this->ShowRegisterView();
	// 			// $this->studentDAO->add($userFound);
	// 		}else{
	// 			$this->ShowLoginView();
	// 		}
	// 	}
	// 	// } else {
	// 	// 	$userFound = $this->userDAO->GetByEmail($email);
	// 	// 	// var
	// 	// 	if($userFound != null){
	// 	// 		if ($userFound->getRole()->getDescription() == '0') {
	// 	// 			$_SESSION['loggedUser'] = $userFound;
	// 	// 			$message = 'Bienvenido Usuario';
	// 	// 			$this->ShowUserView($userFound);					
	// 	// 		} else {
	// 	// 			$message = 'Bienvenido Admin';
	// 	// 			$_SESSION['loggedUser'] = $userFound;
	// 	// 			$this->ShowAdminView($message);
					
	// 	// 		}
	// 	// 	}else{
	// 	// 		$this->ShowLoginView();
	// 	// 	}
	// 	// }
	// }

	public function StudentRegister(){
		$email = $_POST['email'];
		$userFound = $this->studentDAOPDO->GetStudentByEmail($email);
		if($userFound == NULL){
			$userFound = $this->studentDAO->GetByEmailApi($email);
			if($userFound != NULL){
				$userFound->setPassword($_POST["password"]); 
				$this->studentDAOPDO->Add($userFound);
				$this->ShowLoginView();

			}else{
				echo "No se puede registrar";
			}
		}else{
			$this->ShowLoginView();
		}
	}

	public function ShowLoginView()
	{
		require_once(VIEWS_PATH . 'home.php');
	}

	public function ShowRegisterView()
	{
		require_once(VIEWS_PATH . 'user-register.php');
	}

	public function ShowUserView()
	{
		if (isset($_SESSION['loggedUser'])) {
			$userFound = $_SESSION['loggedUser'];
			$_SESSION['usuario'] = $userFound;
			require_once(VIEWS_PATH . 'user-dashboard.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}

	public function ShowAdminView($message = '')
	{
		if (isset($_SESSION['loggedAdmin'])) {
			$userFound = $_SESSION['loggedAdmin'];
			require_once(VIEWS_PATH . 'admin-view.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}
	
	public function ShowCompanyView($message = '')
	{
		if (isset($_SESSION['loggedCompany'])) {
			$userFound = $_SESSION['loggedCompany'];
			require_once(VIEWS_PATH . 'company-view.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}

	public function LogOut()
	{
		session_destroy();
		$message = "Gracias por visitarnos";
		$this->ShowLoginView($message);
	}

	// Funcion para ingresar al sistema.
	public function Login($email, $password)
	{
		$userFound = null;	
		$userFound = $this->studentDAOPDO->GetStudentByEmail($email);
		if($userFound == null){
			$userFound = $this->adminDAOPDO->GetAdminByEmail($email);
			if($userFound == null){
				$userFound = $this->userCompanyDAOPDO->GetUserCompanyByEmail($email);
			}
		}
		if ($userFound != null) {
			if($userFound instanceof Admin && $password == $userFound->getPassword()){
				$_SESSION['loggedAdmin'] = $userFound;
				$_SESSION['logged'] = "a";
				$this->ShowAdminView();
			}
			elseif($userFound instanceof Student && $password == $userFound->getPassword() && $userFound->getActive() == true){		
				$_SESSION['loggedUser'] = $userFound;
				$_SESSION['logged'] = "s";
				$message = 'Bienvenido Usuario';
				$this->ShowUserView();			
			}
			elseif($password == $userFound->getPassword()){		
				$_SESSION['loggedCompany'] = $userFound;
				$_SESSION['logged'] = "c";
				$message = 'Bienvenido Usuario';
				$this->ShowCompanyView();
			}
			else{
				$this->ShowLoginView(); 			
			}
		}else{
			$userFound = $this->studentDAO->GetByEmailApi($email);
			if($userFound != NULL){
				$this->ShowRegisterView();
			}else{
				$this->ShowLoginView();
			}
		}
	
	}
}
