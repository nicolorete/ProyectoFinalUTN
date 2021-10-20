<?php

namespace Controllers;

// Json

use DAO\CompanyRepository;
use DAO\UserDAO as UserDAO;
use Exception;
// Modelos
use Models\User as User;
use Models\UserProfile as UserProfile;
use Models\Role as Role;
use PDOException;

/**
 * 
 */
class UserController
{
	private $userDAO;
	private $companyDAO;

	function __construct()
	{
		$this->userDAO = new UserDao();
		$this->companyDAO = new CompanyRepository();
		
	}

	public function Index()
	{
		if (isset($_SESSION['loggedUser'])) {
			$loggedUser = $_SESSION['loggedUser'];
			if ($loggedUser->getRole() == 1) {
				$this->ShowAdminView();
			} else
				$this->ShowUserView();
		} else {
			$this->ShowLoginView();
		}
	}

	# Funcion para agregar un usuario
	// public function Add($email, $password, $firstName, $lastName, $dni)
	// {
	// 	try {
	// 		$userFound = null;
	// 		# Buscar si existe el mail
	// 		$userFound = $this->userDAO->GetUserByEmail($email);
	// 		var_dump($userFound);
	// 		if ($userFound == null) {
	// 			$newUser = new User();
	// 			$newRole = new Role();
	// 			$newRole->setDescription('0');

	// 			$newUser->setEmail($email);
	// 			$newUser->setPassword($password);
	// 			$newUser->setRole($newRole);

	// 			# Crear el User Profile

	// 			$newUser->setFirstName($firstName);
	// 			$newUser->setLastName($lastName);
	// 			$newUser->setDni($dni);

	// 			$this->userDAO->Add($newUser);
	// 			$message = 'Usuario creado!';
	// 		} else {
	// 			$message = 'Ya existe el correo registrado';
	// 		}
	// 		$this->ShowLoginView($message);
	// 	} catch (Exception $ex) {
	// 		$message = 'Oops ! ' . $ex->getMessage();
	// 	} catch (PDOException $e) {
	// 		throw $e;
	// 	}
	// }

	# Funcion para ingresar al sistema.
	// public function Login($email, $password)
	// {
	// 	$userFound = null;
	// 	$userFound = $this->userDAO->GetUserByEmail($email);

	// 	if (($userFound != null) && ($password == $userFound->getPassword())) {
	// 		if ($userFound->getRole() == '0') {
	// 			$_SESSION['loggedUser'] = $userFound;
	// 			$message = 'Bienvenido Usuario';
	// 			$this->ShowUserView($message);
	// 		} else {
	// 			$message = 'Bienvenido Admin';
	// 			$_SESSION['loggedUser'] = $userFound;
	// 			$this->ShowAdminView($message);
	// 		}
	// 	} else {
	// 		$message = "Email o contraseña invalidos!";
	// 		$this->ShowLoginView($message);
	// 	}
	// }


	public function Login(){
		
		if($_POST)
    {
        $email = $_POST["email"];
        $password = $_POST["password"];        

        if(($email == "admin@admin.com") && ($password == "admin"))
        {
            session_start();

            $loggedUser = new User();
            $loggedUser->setEmail($email);
            $loggedUser->setPassword("admin");

            $_SESSION["loggedUser"] = $loggedUser;

            header("location:Views/company-add.php");
        }
        else
            header("location:login.php");
    }
	}

	public function ShowLoginView($message = "")
	{
		require_once(VIEWS_PATH . 'login.php');
	}

	public function ShowRegisterView()
	{
		require_once(VIEWS_PATH . 'signup-user.php');
	}

	public function ShowUserView($message = '')
	{
		if (isset($_SESSION['loggedUser'])) {
			$userFound = $_SESSION['loggedUser'];
			$genreList = $this->filmDAO->GetAllGenre();
			$proyectionInCartelera = $this->proyectionDAO->GetAllForCartelera();
			require_once(VIEWS_PATH . 'search-proyection.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}


	
	public function ShowAdminView($message = '')
	{
		if (isset($_SESSION['loggedUser'])) {
			$userFound = $_SESSION['loggedUser'];
			require_once(VIEWS_PATH . 'admin-dashboard.php');
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
}
