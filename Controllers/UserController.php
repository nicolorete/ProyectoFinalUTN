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
