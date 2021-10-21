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


    /*private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray) // Array a objetos
                {
                    $user = new User();
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);

                    //foreach ($valuesArray["role"][] as $roleValue) {
                        $role = new Role();    
                        $role->setDescription($valuesArray["role"]);

                        $user->setRole($role);
                    //}

                    array_push($this->userList, $user);
                }
            }
            else{
                echo'no se encontro';
            }
        }*/

    private function RetrieveData()
    {
        $this->userList = array();                  // Crea una Lista

      if(file_exists($this->fileName)){
        $jsonToDecode = file_get_contents($this->fileName);
        $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
      }
        

        foreach ($contentArray as $valuesArray) // Convierto el arreglo a Objetos 
        {
            $user = new User();
            $user->setEmail($valuesArray["email"]);
            $user->setPassword($valuesArray["password"]);
            // ROL
            {
                $role = new Role();
                //$role->setDescription($roleValue['description']);    
                $role->setDescription($valuesArray["role"]["description"]);
                $user->setRole($role);  // le seteo el rol al user correspondiente
            }

            array_push($this->userList, $user);  // inserto la factura a la Lista
        }
    }


   
}
