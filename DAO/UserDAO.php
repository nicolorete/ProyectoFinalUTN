<?php

namespace DAO;

use DAO\IUserDAO as IUserDAO;
use Models\Role as Role;
use Models\User as User;

class UserDAO implements IUserDAO
{
    public $userList = array();

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

   

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->userList as $user) {
            $valuesArray["email"] = $user->getEmail();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["role"]["description"] = $user->getRole()->getDescription();

      

            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        $path = $this->GetJsonFilePath();
        file_put_contents($path, $jsonContent);
    }



    private function RetrieveData()
    {
        $this->userList = array();                  // Crea una Lista

        $jsonPath = $this->GetJsonFilePath();       // Devuelve la ruta donde esta el Json
        $jsonContent = file_get_contents($jsonPath); // recupero el contentido del json

        $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();  // convierte un String a formato Json

        foreach ($arrayToDecode as $valuesArray) // Convierto el arreglo a Objetos 
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


    function GetJsonFilePath()
    {
        $initialPath = "Data/users.json";
        if (file_exists($initialPath)) {
            $jsonFilePath = $initialPath;
        } else {
            $jsonFilePath = "../" . $initialPath;
        }

        return $jsonFilePath;
    }
}
