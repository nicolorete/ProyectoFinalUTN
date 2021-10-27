<?php

namespace Controllers;

// Json
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
class HomeController
{
	private $userDAO;
	

	function __construct()
	{
		$this->userDAO = new UserDAO;
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
	public function Add($email, $password, $firstName, $lastName, $dni)
	{
		try {
			$userFound = null;
			# Buscar si existe el mail
			$userFound = $this->userDAO->GetByEmail($email);
			// var_dump($userFound);
			if ($userFound == null) {
				$newUser = new User();
				$newRole = new Role();
				$newRole->setDescription('0');

				$newUser->setEmail($email);
				$newUser->setPassword($password);
				$newUser->setRole($newRole);

				# Crear el User Profile

				$newUser->setFirstName($firstName);
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

	// public function searchapi($email){
    //     //CURL
    //     $url = curl_init();
    //     //Sets URL
    //     curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
    //     //Sets Header key
    //     curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); 

    //     $response = curl_exec($url);
    //     $toJson = json_decode($response);

    //     var_dump($toJson);

    //     $user = new User();

	// 	// $user->GetByEmailApi($email, $toJson);

    //     return $user;
    // }

	# Funcion para ingresar al sistema.
	public function Login($email, $password)
	{
		$userFound = null;
		$userFound = $this->userDAO->GetByEmailApi($email);
		// var_dump($userFound);
		// && ($userFound->getPassword() === $password)
		if ($userFound != null) {
			$_SESSION['loggedUser'] = $userFound;
			$message = 'Bienvenido Usuario';
			$this->ShowUserView($userFound);
		} else {
			$userFound = $this->userDAO->GetByEmail($email);
			// var
			if($userFound != null){
				if ($userFound->getRole()->getDescription() == '0') {
					$_SESSION['loggedUser'] = $userFound;
					$message = 'Bienvenido Usuario';
					$this->ShowUserView($userFound);					
				} else {
					$message = 'Bienvenido Admin';
					$_SESSION['loggedUser'] = $userFound;
					$this->ShowAdminView($message);
					
				}
			}else{
				$this->ShowLoginView();
			}
		}
	}

	public function ShowLoginView($message = "")
	{
		require_once(VIEWS_PATH . 'home.php');
	}

	public function ShowRegisterView()
	{
		//require_once(VIEWS_PATH . 'signup-user.php');
	}

	public function ShowUserView()
	{
		if (isset($_SESSION['loggedUser'])) {
			$userFound = $_SESSION['loggedUser'];
			// $_SESSION['usuario'] = $user;
			require_once(VIEWS_PATH . 'user-dashboard.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}




	public function ShowAdminView($message = '')
	{
		if (isset($_SESSION['loggedUser'])) {
			$userFound = $_SESSION['loggedUser'];
			require_once(VIEWS_PATH . 'admin-view.php');
		} else {
			$message = "Debe iniciar sesión primero!";
			$this->ShowLoginView($message);
		}
	}

	

	// public function ShowUserProfile($message = "")
	// {
	// 	if (isset($_SESSION['loggedUser'])) {
	// 		$loggedUser = $_SESSION['loggedUser'];

	// 		$userData = $this->userDAO->GetProfileByIdUser($loggedUser->getID());

	// 		if ($userData != null) {
	// 			require_once(VIEWS_PATH . 'user-profile.php');
	// 		} else {
	// 			$message = 'No contiene datos el usuario. Complete los campos';
	// 			require_once(VIEWS_PATH . 'user-profile.php');
	// 		}
	// 	} else {
	// 		$message = 'Debe iniciar sesion';
	// 		$this->ShowLoginView($message);
	// 	}
	// }

	public function LogOut()
	{
		session_destroy();
		$message = "Gracias por visitarnos";
		$this->ShowLoginView($message);
	}
}
