<?php

namespace DAO;

use DAO\ICompanyRepository as ICompanyDAO;
use Models\Company as Company;

use DAO\connection as Connection;
use Exception;
use PDOException;

/* 
     Clase Company DAO PDO   
*/

class CompanyDAOPDO implements ICompanyDAO
{
    private $connection;
    private $tableName = "company";
    
    private $pdo = null;



    public function Add(Company $company)
    {
        try {

            $query = "CALL Company_Add(?, ?, ?)";

            $parameters["cuit"]    = $company->getCuit();
            $parameters["nombre"]    = $company->getNombre();
            $parameters["address"] = $company->getAddress();
            $parameters["link"] = $company->getLink();
            $parameters["activo"]    = $company->getIsActive();

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $lastID = $result[0]["@id_company"];

         
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    # Devuelve todos los company en una lista
    public function GetAll()         //devuelve instancias de company             
    {
        try {
            $companyList = array();

            $query = "SELECT company.companyId, company.cuit, company.nombre, company.address, company.link, company.isActive
                FROM " . $this->tableName ;
                

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);


            foreach ($resultSet as $row) {
                $company = new Company();
                $company->setCompanyId($row["companyId"]);
                $company->setCuit($row["cuit"]);
                $company->setNombre($row["nombre"]);
                $company->setAddress($row["address"]);
                $company->setLink($row["link"]);
                $company->setIsActive($row["isActive"]);


                array_push($companyList, $company);
            }

            return $companyList;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

   

   

    # Devuelve ucompany por ID
    public function GetCompanyByID($companyId)
    {
        try {
            $company = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE companyId = :companyId";

            $parameters["companyId"] = $companyId;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $company = new Company();

                $company->setCompanyId($row["companyId"]);
                $company->setCuit($row["cuit"]);
                $company->setNombre($row["nombre"]);
                $company->setAddress($row["address"]);
                $company->setLink($row["link"]);
                $company->setIsActive($row["isActive"]);
            }

            return $company;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetCompanyByName($companyName)
    {
        try {
            $company = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE nombre = :companyName";

            $parameters["companyName"] = $companyName;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $company = new Company();

                $company->setCompanyId($row["companyId"]);
                $company->setCuit($row["cuit"]);
                $company->setNombre($row["nombre"]);
                $company->setAddress($row["address"]);
                $company->setLink($row["link"]);
                $company->setIsActive($row["isActive"]);
            }

            return $company;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    

    # Elimina un company por ID
    public function Delete($companyID)
    {
        try {
            
            $company = null;
            $query = "UPDATE " . $this->tableName . "  SET activo = 0 WHERE companyId = :companyID";

            $parameters["companyID"] = $companyID;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);

            foreach ($resultSet as $row) {
                $company = new Company();

                $company->setCompanyId($row["companyId"]);
                $company->setCuit($row["cuit"]);
                $company->setNombre($row["nombre"]);
                $company->setAddress($row["address"]);
                $company->setLink($row["link"]);
                $company->setIsActive($row["isActive"]);

                return $company;
            }
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    # Modifica el company que esta en la base
    public function Modify(Company $company)
    {
        try {

            $query = "UPDATE " . $this->tableName . "  SET nombre = :nombre, cuit = :cuit, address = :address, isActive = :isActive WHERE companyId = :companyId";


            

            $parameters["cuit"]    = $company->getCuit();
            $parameters["nombre"]    = $company->getNombre();
            $parameters["address"] = $company->getAddress();
            $parameters["link"] = $company->getLink();
            $parameters["activo"]    = $company->getIsActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}