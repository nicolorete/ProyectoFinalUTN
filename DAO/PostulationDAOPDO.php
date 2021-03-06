<?php
    namespace DAO;

    
    use Models\Postulation as Postulation;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\JobOfferDAOPDO as JobOfferDAO;
    use DAO\StudentDAOPDO as StudentDAO;
use PDOException;

class PostulationDAOPDO {

        private $connection;
        private $tableName = "postulation";
        private $tableName1 = "files";

        public function __construct(){
            
        }

        public function Add(Postulation $postulation) {
            try
            {
                $query = "INSERT INTO  ". $this->tableName ." (jobOfferId,studentId,date,presentation,fileId,active) 
                VALUES (:jobOfferId,:studentId,:date,:presentation,:fileId,:active);";
                
                  
                $parameters["jobOfferId"] = $postulation->getJobOffer();    
                $parameters["studentId"] = $postulation->getStudent();
                $parameters["date"] = $postulation->getDatePostulation();
                $parameters["presentation"] = $postulation->getPresentation();
                $parameters["fileId"] = $postulation->getFile();
                $parameters["active"] = $postulation->getIsActive();
                
                
             
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $postulationList = array();
                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                if($resultSet) {
                foreach ($resultSet as $row)
                {                
                    $postulation = new Postulation();
                    $jobOfferDAO = new JobOfferDAO(); 
                    $studentDAO = new StudentDAO(); 
                    $postulation->setPostulationId($row["postulationId"]);                   
                    $postulation->setJobOffer($jobOfferDAO->GetById($row["jobOfferId"]));
                    $postulation->setStudent($row["studentId"]);
                    $postulation->setDatepostulation($row["date"]);
                    $postulation->setPresentation($row["presentation"]);
                    $postulation->setFile($row["fileId"]);
                    $postulation->setIsActive($row["active"]);
        
                    array_push($postulationList, $postulation);
                }
                return $postulationList;
            }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function searchStudent($id){
            $lista = $this->GetAll();
            
            foreach($lista as $postulaciones){
                if($postulaciones->getStudent() == $id && $postulaciones->getIsActive() == 1){
                    return 1;
                }
            }
        }
        # No la eliminamos, Solo la damos de baja
        public function Delete($postulationID)
        {
            try {
                
                $postulation = null;
                $query = "UPDATE " . $this->tableName . "SET isActive = 0 WHERE postulationId = :postulationID";
    
                $parameters["postulationID"] = $postulationID;
    
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->ExecuteNonQuery($query, $parameters);
    
                foreach ($resultSet as $row) {
                    $postulation = new Postulation();                    
                    $postulation->setPostulationId($row["postulationId"]);
                    $postulation->setJobOffer($row["jobOffer"]);
                    $postulation->setStudent($row["student"]);
                    $postulation->setDatepostulation($row["date"]);
                    $postulation->setPresentation($row["presentation"]);
                    $postulation->setFile($row["fileId"]);
                    $postulation->setIsActive($row["active"]);
    
                    // return $postulation;
                }
            } catch (PDOException $e) {
                throw $e;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        public function Modify(Postulation $postulation)
        {
            try {
                $query = "UPDATE " .$this->tableName. "  SET postulationId=:postulationId, jobOfferId=:jobOfferId, studentId=:studentId, date=:date,
                                                         presentation=:presentation, fileId=:fileId, active=:active WHERE postulationId = :postulationId;";
                
                
                $parameters["postulationId"] = $postulation->getPostulationId();
                $parameters["jobOfferId"] = $postulation->getJobOffer();    
                $parameters["studentId"] = $postulation->getStudent();
                $parameters["date"] = $postulation->getDatePostulation();
                $parameters["presentation"] = $postulation->getPresentation();
                $parameters["fileId"] = $postulation->getFile();
                $parameters["active"] = $postulation->getIsActive();
                
                $this->connection = Connection::GetInstance();
    
                $this->connection->ExecuteNonQuery($query, $parameters);
                
            } catch (PDOException $e) {
                throw $e;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        public function GetPostulationByID($postulationId)
    {
        try {
            $postulation = null;

            $query = "SELECT * FROM " . $this->tableName . " WHERE postulationId = :postulationId";

            $parameters["postulationId"] = $postulationId;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);

            foreach ($resultSet as $row) {
                $postulation = new Postulation();                    
                    $postulation->setPostulationId($row["postulationId"]);
                    $postulation->setJobOffer($row["jobOfferId"]);
                    $postulation->setStudent($row["studentId"]);
                    $postulation->setDatepostulation($row["date"]);
                    $postulation->setPresentation($row["presentation"]);
                    $postulation->setFile($row["fileId"]);
                    $postulation->setIsActive($row["active"]);
            }

            return $postulation;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // public function AddFile($fileName)
    //     {
    //         try
    //         {
    //             $query = ("INSERT INTO ".$this->tableName1." (name) VALUES (:name);");
    //             $parameters["name"] = $fileName();
    //             // "CALL files_add(?);";
                

    //             $this->connection = Connection::GetInstance();

    //             $this->connection->ExecuteNonQuery($query, $parameters);
    //         }
    //         catch(Exception $ex)
    //         {
    //             throw $ex;
    //         }
    //     }

      
    }
?>