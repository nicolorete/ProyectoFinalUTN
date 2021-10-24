<?php

namespace Controllers;

use DAO\UserDAO as userDAO;
use Exception;
use Models\Role;
use Models\User as User;
use PDOException;

class userController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        require_once(VIEWS_PATH . "user-add.php");
    }

    public function ShowListView()
    {
        require_once(VIEWS_PATH . "validate-session.php");
        $userList = $this->userDAO->GetAll();

        require_once(VIEWS_PATH . "user-list.php");
    }

    public function Add($email, $password, $firstName, $lastName, $dni)
	{
        require_once(VIEWS_PATH . "validate-session.php");

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
		
                $this->ShowAddView();
		
	}

    public function searchapi($email){
        //CURL
        $url = curl_init();
        //Sets URL
        curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
        //Sets Header key
        curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
        curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); 

        $response = curl_exec($url);
        $toJson = json_decode($response);

        var_dump($toJson);


        // $newUser = new User();
        // $newRole = new Role();
        // $newRole->setDescription('0');

        // $newUser->setEmail($email);
        // $newUser->setPassword($password);
        // $newUser->setRole($newRole);

        // # Crear el User Profile

        // $newUser->setFirstName($firstName);
        // $newUser->setLastName($lastName);
        // $newUser->setDni($dni);


    }

    public function Delete($id)
    {
        require_once(VIEWS_PATH."validate-session.php");
            
        $this->userDAO->Delete($id);

        $this->ShowListView();
    }


    public function Modify($id, $email, $password, $firstName, $lastName, $dni)
    {
        $userNew = new user();
        $userNew->setId($id);
        $userNew->setEmail($email);
        $userNew->setPassword($password);
        $userNew->setFirstName($firstName);
        $userNew->setLastName($lastName);
        $userNew->setDni($dni);
        

        $this->userDAO->Modify($userNew);

        $message = 'Usuario modificado!';
        $this->ShowListView($message);
    }
}
