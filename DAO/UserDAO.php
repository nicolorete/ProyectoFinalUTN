<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\Role as Role;
use Models\User as User;

class UserDAO implements IUserDAO
{
    public $userList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = ROOT."Data/Users.json";
    }

    public function Add(User $newUser)
    {
        echo "<pre>";
        print_r($newUser);
        echo "</pre>";
        $userFound = NULL;
        $userFound = $this->getByEmail($newUser->getEmail());

        if ($userFound != NULL) {
            echo "<script> alert('YA EXISTE UN USUARIO CON ESE EMAIL');</script>";
        } else {
            $this->RetrieveData();
            $newUser->setId($this->GetNextId());
            array_push($this->userList, $newUser);
            $this->SaveData();
        }
    }

    public function GetAll()
    {
        $this->RetrieveData();
        return $this->userList;
    }

    public function GetByEmail($email)
    {
        $this->RetrieveData();

        foreach ($this->userList as $key => $user) {
            if ($user->getEmail() == $email) {
                return $user;
            }
        }
    }

    
    public function Delete($value)
    {
        $this->RetrieveData();
        $newList = array();
        foreach ($this->userList as $user) {
            if ($user->getEmail() != $value) {
                array_push($newList, $user);
            }
        }

        $this->userList = $newList;
        $this->SaveData();
    }

    /*private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                
                // ROL 
                $valuesArray["role"] = new Role();
                foreach ($user->getRole() as $role) {
                    $valuesArray["role"][] = array(
                        'description' => $item->getDescription()
                    );
                }

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }*/

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->userList as $user) {
            
            $valuesArray["id"] = $user->getId();
            $valuesArray["lastName"] = $user->getLastName();
            $valuesArray["firstName"] = $user->getFirstName();
            $valuesArray["dni"] = $user->getDni();
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["role"]["description"] = $user->getRole()->getDescription();

            //Rol
            /*$valuesArray["role"] = array();
                foreach ($user->getRole() as $role) { 
                    $valuesArray["role"][] = array(
                        'description' => $role->getDescription()
                    );
                }*/
            /*foreach ($user->getRole() as $role) {
                    $valuesArray["role"][] = array(
                        'description' => $role->getDescription()    
                    );*/
            //}

            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        $path = $this->fileName;
        file_put_contents($path, $jsonContent);
    }


    private function RetrieveData()
    {
        $this->userList = array();                  // Crea una Lista

      if(file_exists($this->fileName)){$jsonContent = file_get_contents($this->fileName);

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

        foreach($arrayToDecode as $valuesArray)
        {
            $user = new User();
            $user->setId($valuesArray["id"]);
            $user->setLastName($valuesArray["lastName"]);
            $user->setFirstName($valuesArray["firstName"]);
            $user->setDni($valuesArray["dni"]);
            $user->setEmail($valuesArray["email"]);
            $user->setPassword($valuesArray["password"]);
            // $user->setRole($valuesArray["role"]["description"]);
            {
                $role = new Role();
                //$role->setDescription($roleValue['description']);    
                $role->setDescription($valuesArray["role"]["description"]);
                $user->setRole($role);  // le seteo el rol al user correspondiente
            }
            array_push($this->userList, $user);
        }
      }
        

           

    }

    public function Modify(User $user){
        $this->RetrieveData();

        foreach ($this->userList as $userValue) {
            if ($user->getId() == $userValue->getId()) {
                $userValue->setEmail($user->getEmail());
                $userValue->setFirstName($user->getFirstName());                   
                $userValue->setLastName($user->getLastName());
                $userValue->setDni($user->getDni());
                $userValue->setRole($user->getRole());
            }
        }
        $this->SaveData();
    }

    private function GetNextId()
    {
        $id = 0;

        foreach($this->userList as $user)
        {
            $id = ($user->getId() > $id) ? $user->getId() : $id;
        }

        return $id + 1;
    }

   
}
