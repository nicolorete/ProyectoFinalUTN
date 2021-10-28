<?php

namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;

use Models\Career as Career;

class StudentDAO implements IStudentDAO
{
    public $studentList = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = ROOT."\Data\Students.json";
    }

    public function add(Student $newStudent){
        
        $this->retrieveData();

        array_push($this->studentList, $newStudent);

        $this->SaveData();

    }


    public function getAll()
    {
        $this->retrieveData();
        return $this->studentList;
    }

    private function retrieveData()
    {
        $this->studentList = array();

        if(file_exists($this->fileName)){
            $jsonContent = file_get_contents($this->fileName);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
           
           foreach($arrayToDecode as $valuesArray){
                $studentId = $valuesArray["studentId"];
                $firstName = $valuesArray["firstName"];
                $lastName = $valuesArray["lastName"];
                $dni = $valuesArray["dni"];
                $fileNumber = $valuesArray["fileNumber"];
                $gender = $valuesArray["gender"];
                $birthDate = $valuesArray["birthDate"];
                $email = $valuesArray["email"];
                $phoneNumber = $valuesArray["phoneNumber"];
                $active = $valuesArray["active"];
                
                $Student = new Student($studentId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active );
                $Career = new Career($valuesArray["careerId"], "N/A", "N/A");
                $Student->setCareer($Career);
                
                array_push($this->studentList, $Student);
            }
        }
    }

    public function retrieveAPI(){
        
        $this->studentList = array();
        $url = curl_init();
        curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
        curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
        curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($url);
        $toJson = json_decode($response);

        foreach($toJson as $key)
        {
            $newStudent = new Student
            ($key->firstName, $key->lastName, $key->dni, $key->fileNumber, $key->gender,
            $key->birthDate, $key->email, $key->phoneNumber, $key->active);
            
            $newStudent->setStudentId($key->studentId);

            $newCareer = new Career($key->careerId, "FOO", "BAR");
            $newStudent->setCareer($newCareer);

            array_push($this->studentList, $newStudent);
        }
        
        $this->saveData();
    }


    private function saveData(){
            
        $arrayToEncode = array();

       foreach($this->studentList as $value){
            $arrayValue['studentId'] = $value->getStudentId();
            $arrayValue['careerId'] = $value->getCareer()->getCareerId();
            $arrayValue['firstName'] = $value->getFirstName();
            $arrayValue['lastName'] = $value->getLastName();
            $arrayValue['dni'] = $value->getDni();
            $arrayValue['fileNumber'] = $value->getAcademicStatus()->getFileNumber();
            $arrayValue['gender'] = $value->getGender();
            $arrayValue['birthDate'] = $value->getBirthDate();
            $arrayValue['email'] = $value->getEmail();
            $arrayValue['phoneNumber'] = $value->getPhoneNumber();
            $arrayValue['active'] = $value->getAcademicStatus()->getActive();

            array_push($arrayToEncode, $arrayValue);
        }

        
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

  

    public function getByEmail($email)
    {
        $this->retrieveData();

        foreach ($this->studentList as $key => $student) {
            if ($student->getEmail() == $email) {
                return $student;
            }
        }
    }



    // public function GetByEmailApi($mail)
    // {
    //     $url = curl_init();
    //     //Sets URL
    //     curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/Student');
    //     //Sets Header key
    //     curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
    //     curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); 

    //     $response = curl_exec($url);
    //     $toJson = json_decode($response);

    //     // var_dump($mail);

    //     // var_dump($toJson);

    //     foreach ($toJson as $key => $student) {
    //         if ($student->email == $mail){
    //             // var_dump($student);
    //             $usuario = new Student();
    //             $usuario->setEmail($student->email);
    //             $usuario->setStudentId($student->studentId);
                
                
    //             $usuario->setLastName($student->lastName);  
    //             $usuario->setFirstName($student->firstName);  
    //             $usuario->setDni($student->dni);          


    //             return $usuario;
    //         }
    //     }

    // }
   
    public function deleteByEmail($value)
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

    public function deleteById($id){
        $this->retrieveData();

        if(!empty($this->studentList)){
            foreach($this->studentList as $student){
                if($student->getStudentId() == $id){
                    $index = array_search($student, $this->studentList);
                    unset($this->studentList[$index]);
                }
            }
        }
        $this->saveData();
    }

    
       


   
           

    
 

    

    public function Modify(Student $student){
        $this->retrieveData();

        foreach ($this->studentList as $studentValue) {
            if ($student->getStudentId() == $studentValue->getStudentId()) {
                $studentValue->setEmail($student->getEmail());
                $studentValue->setFirstName($student->getFirstName());                   
                $studentValue->setLastName($student->getLastName());
                $studentValue->setDni($student->getDni());
                
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
