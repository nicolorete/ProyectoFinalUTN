<?php

namespace DAO;

use Models\JobPosition as JobPosition;
use Models\Career as Career;
use DAO\connection as Connection;
use Exception;
use PDOException;

/**
 *  Clase Student DAO PDO 
 */

class JobPositionDAOPDO
{
    private $connection;
    private $tableName = "jobPosition";
    private $tableName3= "career";
    private $pdo = null;

     # Agrega una jobposition a la base de datos
     public function Add(JobPosition $jobPosition)
     {
         try {
             $query =  "INSERT INTO " . $this->tableName . "(jobPositionId, description) VALUES (:jobPostionId, :description);";
 
             $parameters["jobPostionId"] = $jobPosition->getJobPositionId();
             $parameters["description"] = $jobPosition->getDescription();
             //$parameters["career"] = $jobPosition->getcareer(); 
 
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
 

 
     # Devuelve la pelicula por titulo.
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
     
    
 
     # Devuelve todos las peliculas de la BD en una lista
     public function GetAll()
     {
         try {
             $jobPositionList = array();
 
             $query = "SELECT * FROM " . $this->tableName;
 
             $this->connection = Connection::GetInstance();
 
             $resultSet = $this->connection->Execute($query);
 
             foreach ($resultSet as $row) {
                 $jobPosition = new JobPosition();
                 $jobPosition->setJobPositionId($row["jobPositionId"]);
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
 
     # Devuelve un genero por descripcion. Sirve para actualizar la BD de generos.
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
            $url = curl_init();
            curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/JobPosition');
            curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($url);
            $toJson = json_decode($response);

            foreach($toJson as $key)
            {
                $newJobPosition = new JobPosition;
                // ($key->jobPositionId, $key->carrerId, $key->description);
                
                $newJobPosition->setJobPositionId($key->jobPositionId);
                $newJobPosition->setDescription($key->description);

                $newCareer = new Career($key->careerId, "FOO", "BAR");
                $newJobPosition->setCareer($newCareer);

                array_push($this->jobPositionList, $newJobPosition);
            }
            
            return $this->jobPositionList;
        }
     
 
     ########### GET DE LA API. PELICULAS Y GENEROS ##########
 
     public function GetCareerListFromAPI()
     {
        $this->jobPositionList = array();
        $url = curl_init();
        curl_setopt($url, CURLOPT_URL, 'https://utn-students-api.herokuapp.com/api/JobPosition');
        curl_setopt($url, CURLOPT_HTTPHEADER, array('x-api-key:4f3bceed-50ba-4461-a910-518598664c08'));
        curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($url);
        $toJson = json_decode($response);

 
         
        
 
         foreach ($toJson["career"] as $valuesArray) {
             $career = new Career();
             $career->setCareerId($valuesArray["careerId"]);
             $career->setDescription($valuesArray["description"]);
             $career->setActive($valuesArray["active"]);
 
             array_push($this->careerList, $career);
         }
         return $this->careerList;
     }
 
    
}