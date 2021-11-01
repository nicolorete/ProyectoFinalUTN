<?php

namespace DAO;

use Models\Admin as Admin;

use DAO\connection as Connection;
use Exception;
use PDOException;

/**
 *  Clase Student DAO PDO 
 */

class StudentDAOPDO
{
    private $connection;
    private $tableName = "admin";
   
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
    
    
    public function Add(Admin $admin)
    {
        try {
            // $query = 'CALL student_Add(?, ?, ?)';

            // $parameters["email"]      = $student->getEmail();
            // // $parameters["password"] = $student->getPassword();
            

            // $this->connection = Connection::GetInstance();

            // $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            

            $query2 = "INSERT INTO". $this->tableName . "(adminId, email, password)
             VALUES (:adminId, :email, :password);";

            $parameters2["adminId"] = $admin->getAdminId();
            $parameters2["email"] = $admin->getEmail();
            $parameters2["password"] = $admin->getPassword();

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
            $adminList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new Admin();

                $user->setAdminId($row["adminId"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                

                array_push($adminList, $user);
            }

            return $adminList;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAdminByEmail($email)
    {
        try {
            $user = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new Admin();

                $user->setAdminId($row["adminId"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                
            }

            return $user;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetProfileByIdAdmin($idUser)
    {
        try {
            $userData = null;
            $query = "SELECT *, admin.adminId 
                      FROM admin 
                      WHERE admin.adminId = :idUser";

            $parameters["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {
                $user = new Admin();

                $user->setAdminId($row["adminId"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                }

            return $userData;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    
} 
