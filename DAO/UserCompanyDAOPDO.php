<?php

namespace DAO;

use Models\UserCompany as UserCompany;

use DAO\connection as Connection;
use Exception;
use PDOException;


class UserCompanyDAOPDO
{
    private $connection;
    private $tableName = "userCompany";
   
    private $pdo = null;

////////////////////////////////////////////////////////////////////////
    # Busca un ususario por email.
    
    
    public function Add(UserCompany $userCompany)
    {
        try {
           $query2 = ("INSERT INTO ". $this->tableName." (userCompanyId, email, password, companyId) VALUES (:userCompanyId, :email, :password, :companyId);");
          
           $parameters2["userCompanyId"] = $userCompany->getUserCompanyId();
            $parameters2["email"] = $userCompany->getEmail();
            $parameters2["password"] = $userCompany->getPassword();
            $parameters2["companyId"] = $userCompany->getCompany();

            $this->connection =  Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query2, $parameters2);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
   

    public function GetAll()
    {
        try {
            $userCompanyList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $user = new UserCompany();

                $user->setUserCompanyId($row["userCompanyId"]);
                $user->setEmail($row["email"]);                
                $user->setPassword($row["password"]);
                $user->setCompany($row["companyId"]);

                array_push($userCompanyList, $user);
            }

            return $userCompanyList;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetUserCompanyByEmail($email)
    {
        try {
            $user = null;
            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email";
            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row)
            {
                $user = new UserCompany();
                $user->setUserCompanyId($row["userCompanyId"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setCompany($row["companyId"]);
            }
            return $user;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

   
    public function Delete($userCompanyId)
    {
        try
        {
            $query = "DELETE FROM ".$this->tableName." WHERE userCompanyId = :userCompanyId;";
            $parameters["userCompanyId"] = $userCompanyId;
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);}
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    
} 
