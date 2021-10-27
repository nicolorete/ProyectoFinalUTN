<?php

namespace DAO;

use Models\User as User;
use Models\Role as Role;
use DAO\connection as Connection;
use Exception;
use PDOException;

/**
 *  Clase User DAO PDO 
 */

class UserDAOPDO
{
    private $connection;
    private $tableName = "usuario";
    private $tableName2 = "perfiusuario";
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

    public function Add(User $user)
    {
        try {
            $query = 'CALL User_Add(?, ?, ?)';

            $parameters["mail"]      = $user->getEmail();
            $parameters["password"] = $user->getPassword();
            $parameters["idRol"]    = $user->getRole()->getDescription();

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

            $lastID = $result[0]["@id"];

            $query2 = "INSERT INTO perfiusuario (idUsuario, nombre, apellido, dni) VALUES (:idUsuario, :nombre, :apellido, :dni);";

            $parameters2["idUsuario"] = $lastID;
            $parameters2["nombre"] = $user->getFirstName();
            $parameters2["apellido"] = $user->getLastName();
            $parameters2["dni"] = $user->getDni();

            $this->connection =  Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query2, $parameters2, QueryType::Query);
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    # Busca un ususario por email.
    public function GetUserByEmail($email)
    {
        try {
            $user = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE mail = :email";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $user = new User();

                $user->setID($row["idUsuario"]);
                $user->setEmail($row["mail"]);
                $user->setPassword($row["password"]);
                $user->setRole($row["idRol"]);
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
            $query = "SELECT *, usuario.idUsuario 
                      FROM perfiusuario 
                      INNER JOIN  usuario ON usuario.idUsuario = perfiusuario.idUsuario 
                      WHERE usuario.idUsuario = :idUser";

            $parameters["idUser"] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            foreach ($resultSet as $row) {
                $userData = new User();
                $userData->setID($row["idUsuario"]);
                $userData->setLastName($row["apellido"]);
                $userData->setFirstName($row["nombre"]);
                $userData->setDni($row["dni"]);
                $userData->setEmail($row["mail"]);
            }

            return $userData;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
