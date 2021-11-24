<?php

namespace DAO;

use Models\JobPosition as JobPosition;
use Models\Career as Career;
use DAO\connection as Connection;
use DAO\CareerDAOPDO as CareerDAO;
use Exception;
use PDOException;

/**
 *  Clase Student DAO PDO 
 */

class JobPositionDAOPDO
{
    private $connection;
    private $tableName = "jobPosition";
    private $tableName2 = "jobpYcareer";
    private $tableName3= "career";
    private $pdo = null;

     # Agrega una jobposition a la base de datos
     public function Add(JobPosition $jobPosition)
     {
         try {
             $query =  "INSERT INTO " . $this->tableName . "(jobPositionId,careerId, description) VALUES (:jobPostionId, :careerId, :description);";
 
             $parameters["jobPostionId"] = $jobPosition->getJobPositionId();
             $parameters["description"] = $jobPosition->getDescription();
             $parameters["careerId"] = $jobPosition->getCareer(); 
 
             $this->connection =  Connection::GetInstance();
 
             $this->connection->ExecuteNonQuery($query, $parameters);
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }
 
     public function AddCareer(Career $career)
     {
         try {
             $query =  "INSERT INTO " . $this->tableName3 . "(careerId, description, active) VALUES (:careerId, :description, :active);";
 
             $parameters["careerId"] = $career->getCareerId();
             $parameters["description"] = $career->getDescription();
             $parameters["active"] = $career->getActive();
 
             $this->connection =  Connection::GetInstance();
             $this->connection->ExecuteNonQuery($query, $parameters);
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }
     
      # Agrega las career de una determinada jobposition
    public function AddJobPositionCareer(JobPosition $jobPosition)
    {
        try {
            $query =  "INSERT INTO " . $this->tableName2 . "(jobPositionId, careerId) VALUES (:jobPositionId, :careerId);";

            $parameters["jobPositionId"] = $jobPosition->getJobPositionId();

            foreach ($jobPosition->getCareer() as $careerId) {
                $parameters["careerId"] = $careerId;
                $this->connection =  Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

 
     # Devuelve la jobposition por descripcion.
     public function GetJobPostionByDescription($description)
     {
         try {
             $jobPositionFound = null;
 
             $query = "SELECT * FROM " . $this->tableName . " where description = :description";
 
             $parameters[":description"] = $description;
 
             $this->connection = Connection::GetInstance();
 
             $resultSet = $this->connection->Execute($query);
 
             foreach ($resultSet as $row) {
                 $jobPositionFound = new JobPosition();
                 $jobPositionFound->setJobPositionId($row["jobPositionId"]);
                 $jobPositionFound->setDescription($row["descripcion"]);
            }
 
             return $jobPositionFound;
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }
     
    
 
     # Devuelve todos las jp de la BD en una lista
     public function GetAll()
     {
         try {
             $jobPositionList = array();
 
             $query = "SELECT * FROM " . $this->tableName;
 
             $this->connection = Connection::GetInstance();
 
             $resultSet = $this->connection->Execute($query);
 
             foreach ($resultSet as $row) {
                 $jobPosition = new JobPosition();
                 $careerDAO = new CareerDAO();
                 $jobPosition->setJobPositionId($row["jobPositionId"]);
                 $jobPosition->setCareer($row["careerId"]);
                 $jobPosition->setDescription($row["descripcion"]);
 
                 array_push($jobPositionList, $jobPosition);
             }
             return $jobPositionList;
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }
 
     # Devuelve una career por descripcion. Sirve para actualizar la BD de career.
     public function GetCareerByDescription($description)
     {
         try {
             $careerFound = null;
 
             $query = "SELECT * FROM " . $this->tableName3 . " WHERE description = :description";
 
             $parameters[":description"] = $description;
 
             $this->connection = Connection::GetInstance();
             $resultSet = $this->connection->Execute($query, $parameters);
 
             foreach ($resultSet as $row) {
                 $careerFound = new Career();
 
                 $careerFound->setCareerId($row["careerId"]);
                 $careerFound->setDescription($row["descripcion"]);
                 $careerFound->setActive($row["active"]);
             }
 
             return $careerFound;
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }
 
     public function GetAllCareer()
     {
         try {
             $careerList = array();
 
             $query = "SELECT * FROM " . $this->tableName3;
 
             $this->connection = Connection::GetInstance();
 
             $resultSet = $this->connection->Execute($query);
 
             foreach ($resultSet as $row) {
                 $career = new Career();
                 $career->setCareerId($row["careerId"]);
                 $career->setDescription($row["description"]);
                 $career->setActive($row["active"]);
 
                 array_push($careerList, $career);
             }
 
             return $careerList;
         } catch (PDOException $e) {
             throw $e;
         } catch (Exception $ex) {
             throw $ex;
         }
     }

    //------------------------------------------------------------------------------------------------------------------
    public function GetJobPositionListFromApi(){
            
            $this->jobPositionList = array();
            $careerDAO = new CareerDAO();
            $careerFromApi = $careerDAO->GetCareerListFromAPI();

            $url = curl_init();
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api2.herokuapp.com/api/jobPosition');
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); 
            $response = curl_exec($url);
            $toJson = json_decode($response);

            // var_dump($toJson);

            foreach($toJson as $key)
            {
                $newJobPosition = new JobPosition();
                // ($key->jobPositionId, $key->carrerId, $key->description);
                foreach($careerFromApi as $career)
                {
                    if($key->careerId == $career->getCareerId()){
                        $newCareer = new Career();
                        $newCareer->setCareerId($career->getCareerId());
                        $newCareer->setDescription($career->getDescription());
                        $newCareer->setActive($career->getActive());

                        $newJobPosition->setCareer($newCareer);
                    }
                }
                
                $newJobPosition->setJobPositionId($key->jobPositionId);
                $newJobPosition->setDescription($key->description);
                
                // $newCareer = new Career($key->careerId, "FOO", "BAR");
                // $newJobPosition->setCareer($newCareer);
                // $newJobPosition->setJobPositionId($key->jobPositionId);
                // $newJobPosition->setDescription($key->description);
                
                // $newCareer = new Career($key->careerId, "FOO", "BAR");
                // $newJobPosition->setCareer($newCareer);
                
                // var_dump($newJobPosition);

                array_push($this->jobPositionList, $newJobPosition);
            }
            
            return $this->jobPositionList;
            // echo end($this->jobPositionList);
        }

        public function GetById($jobPositionId)
        {
            try
            {
                $query = "SELECT * FROM ". $this->tableName.' WHERE (jobPositionId = :jobPositionId);';

                $this->connection = Connection::GetInstance();
                
                $parameters["jobPositionId"] = $jobPositionId;

                $result = $this->connection->Execute($query, $parameters); 
                // en la linea anterior iba un  [0] , lo saque por que tiraba error, por si rompe algo volvelo a poner

                $careerDAO = new CareerDAO();

                if($result) {
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($result["jobPositionId"]);
                    $jobPosition->setCareer($result["careerId"]);
                    $jobPosition->setDescription($result["description"]);
                    
                    return $jobPosition;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
     
        public function GetByIdFromApi($id){
            
            $toJson = $this->GetJobPositionListFromApi();

            foreach($toJson as $key)
            {
                if($key->getJobPositionId() == $id){
                    $job = new JobPosition();
                    $job->setJobPositionId($key->getJobPositionId());
                    $job->setCareer($key->getCareer());
                    $job->setDescription($key->getDescription());
                }
            }
            
            return $job;

        }
 
    
    
}