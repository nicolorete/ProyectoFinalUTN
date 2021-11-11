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
                $parameters["fileId"] = $postulation->getCv();
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
                    $postulation->setStudent($studentDAO->GetById($row["studentId"]));
                    $postulation->setDatepostulation($row["date"]);
                    $postulation->setPresentation($row["presentation"]);
                    $postulation->setCv($row["fileId"]);
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
                    $postulation->setDatepostulation($row["datepostulation"]);
                    $postulation->setPresentation($row["presentation"]);
                    $postulation->setCv($row["cv"]);
                    $postulation->setIsActive($row["isActive"]);
    
                    // return $postulation;
                }
            } catch (PDOException $e) {
                throw $e;
            } catch (Exception $ex) {
                throw $ex;
            }
        }

      
    }
?>