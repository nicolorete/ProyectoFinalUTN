<?php
    namespace DAO;
    use DAO\CompanyDAOPDO as CompanyDAO;
    use DAO\JobPositionDAOPDO as JobPositionDAO;
    use Models\JobOffer as JobOffer;    
    use DAO\Connection as Connection;
    use Exception;

    class JobOfferDAOPDO 
    {
        private $connection;
        private $tableName = "jobOffers";

        public function Add(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (title, date, decription, active, jobPositionId, companyId) 
                    VALUES (:title, :date, :description, :active, :jobPositionId, :companyId);";

                $parameters["title"] = $jobOffer->getTitle();
                $parameters["date"] = $jobOffer->getDate();
                $parameters["description"] = $jobOffer->getDescription();
                $parameters["active"] = $jobOffer->getActive();
                $parameters["jobPositionId"] = $jobOffer->getJobPosition();
                $parameters["companyId"] = $jobOffer->getCompany();
                

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
                $jobOfferList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                if($resultSet) {
                    foreach ($resultSet as $row)
                    {                
                        $jobOffer = new JobOffer();
                        $companyDAO = new CompanyDAO();
                        $jobPositionDAO = new JobPositionDAO();

                        $jobOffer->setJobOfferId($row["jobOfferId"]);
                        $jobOffer->setTitle($row["title"]);
                        $jobOffer->setDescription($row["description"]);
                        $jobOffer->setActive($row["active"]);
                        $jobOffer->setJobPosition($jobPositionDAO->GetById($row["jobPositionId"]));
                        $jobOffer->setCompany($companyDAO->GetCompanyByID($row["companyId"]));
                       
            
                        array_push($jobOfferList, $jobOffer);
                    }
                    return $jobOfferList;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeleteById($jobOfferId)
        {
            try
            {
                $query = "DELETE FROM ".$this->tableName." WHERE jobOfferId = :jobOfferId;";
                $parameters["jobOfferId"] = $jobOfferId;
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($jobOfferId)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName.' WHERE (jobOfferId = :jobOfferId);';
                $this->connection = Connection::GetInstance();
                $parameters["jobOfferId"] = $jobOfferId;
                $result = $this->connection->Execute($query, $parameters)[0];
                $companyDAO = new CompanyDAO();
                $jobPositionDAO = new JobPositionDAO();

                if($result) {
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($result["jobOfferId"]);
                    $jobOffer->setTitle($result["title"]);
                    $jobOffer->setDate($result["date"]);
                    $jobOffer->setDescription($result["description"]);
                    $jobOffer->setActive($result["active"]);

                    $jobOffer->setJobPosition($jobPositionDAO->GetById($result["jobPositionId"]));
                    $jobOffer->setCompany($companyDAO->GetCompanyByID($result["companyId"]));
                   
                    return $jobOffer;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function ModifyById($jobOfferId, $title, $date, $description, $active, $jobPositionId, $companyId)
        {
            {
                try
                {
                    $query = "UPDATE ".$this->tableName." SET title=:title, date=:date, description=:description, active=:active, jobPositionId=:jobPositionId, companyId=:companyId
                    WHERE jobOfferId=:jobOfferId;";

                    $parameters["jobOfferId"] = $jobOfferId;
                    $parameters["title"] = $title;
                    $parameters["date"] = $date;
                    $parameters["description"] = $description;
                    $parameters["active"] = $active;
                    $parameters["jobPositionId"] = $jobPositionId;
                    $parameters["companyId"] = $companyId;
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
        }
    }
?>