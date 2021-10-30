<?php

namespace DAO;

use Models\Student as Student;
use Models\Career as Career;
use DAO\connection as Connection;
use Exception;
use PDOException;

/**
 *  Clase Student DAO PDO 
 */

class StudentDAOPDO
{
    private $connection;
    private $tableName = "student";
   
    private $pdo = null;

    # Agrega un usuario a la base de datos. "Registro"
    /*public function Add(User $user){
    	try
        	{
        		$query =  "INSERT INTO ". $this->tableName. "(idRol, mail , password) VALUES (:idRol, :mail, :password);";

        		//$parameters["idUsuario"] = $user->getId();
        		$parameters["idRol"] = $user->getRole()->getDescription();
                $parameters["mail"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();

        		$this->connection =  Connection::GetInstance();
        		
                $this->connection->ExecuteNonQuery($query, $parameters);
                        
        	}
        	catch (PDOException $e)
        	{
        		throw $e; 
        	}
        	catch(Exception $ex)
        	{
        		throw $ex;
        	}
    }*/

////////////////////////////////////////////////////////////////////////
    # Busca un ususario por email.
    
    
    public function Add(Student $student)
    {
        try {
            // $query = 'CALL student_Add(?, ?, ?)';

            // $parameters["email"]      = $student->getEmail();
            // // $parameters["password"] = $student->getPassword();
            

            // $this->connection = Connection::GetInstance();

            // $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            

            $query2 = "INSERT INTO". $this->tableName . "(studentId, carrerId, firstName, lastName, dni, fileNumber, gender, email, phoneNumber, active)
             VALUES (:studentId, :carrerId, :firstName, :lastName, :dni, :fileNumber, :gender, :email, :phoneNumber, :active);";

            $parameters2["idStudent"] = $student->getStudentId();
            $parameters2["carrerId"] = $student->getCareer();
            $parameters2["firstName"] = $student->getFirstName();
            $parameters2["lastName"] = $student->getLastName();
            $parameters2["dni"] = $student->getDni();
            $parameters2["fileNumber"] = $student->getFileNumber();
            $parameters2["gender"] = $student->getGender();
            $parameters2["email"] = $student->getEmail();
            $parameters2["phoneNumber"] = $student->getPhoneNumber();
            $parameters2["active"] = $student->getActive();

            $this->connection =  Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query2, $parameters2, QueryType::Query);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $studentList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new Student();

                $user->setStudentId($row["studentId"]);
                $user->setEmail($row["email"]);
                // $user->setPassword($row["password"]);
                $user->setLastName($row["lastName"]);
                $user->setFirstName($row["firstName"]);
                $user->setDni($row["dni"]);
                $user->setFileNumber($row["fileNumber"]);
                $user->setGender($row["gender"]);
                $user->setBirthDate($row["birthDate"]);
                $user->setPhoneNumber($row["phoneNumber"]);
                $user->setActive($row["active"]);

                array_push($studentList, $user);
            }

            return $studentList;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetStudentByEmail($email)
    {
        try {
            $user = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new Student();

                $user->setStudentId($row["studentId"]);
                $user->setEmail($row["email"]);
                // $user->setPassword($row["password"]);
                $user->setLastName($row["lastName"]);
                $user->setFirstName($row["firstName"]);
                $user->setDni($row["dni"]);
                $user->setFileNumber($row["fileNumber"]);
                $user->setGender($row["gender"]);
                $user->setBirthDate($row["birthDate"]);
                $user->setPhoneNumber($row["phoneNumber"]);
                $user->setActive($row["active"]);
            }

            return $user;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetProfileByIdUser($idUser)
    {
        try {
            $userData = null;
            $query = "SELECT *, student.studentId 
                      FROM student 
                      WHERE student.idstudent = :idUser";

            $parameters["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {
                $user = new Student();

                $user->setStudentId($row["studentId"]);
                $user->setEmail($row["email"]);
                // $user->setPassword($row["password"]);
                $user->setLastName($row["lastName"]);
                $user->setFirstName($row["firstName"]);
                $user->setDni($row["dni"]);
                $user->setFileNumber($row["fileNumber"]);
                $user->setGender($row["gender"]);
                $user->setBirthDate($row["birthDate"]);
                $user->setPhoneNumber($row["phoneNumber"]);
                $user->setActive($row["active"]);
            }

            return $userData;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function GetStudentListFromApi(){
        
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
        
        return $this->studentList;
    }
} 
