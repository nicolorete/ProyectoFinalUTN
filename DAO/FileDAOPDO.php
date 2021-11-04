<?php
    namespace DAO;

    use DAO\IFileDAOPDO as IFileDAOPDO;
    use DAO\QueryType as QueryType;
use Exception;
use Models\File as File;

    class FileDAOPDO implements \DAO\IFileDAOPDO
    {
        private $tableName = "files";

        public function Add(File $file)
        {
            try
            {
                $query = "CALL files_add(?);";
                
                $parameters["name"] = $file->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
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
                $fileList = array();

                $query = "SELECT fileId, name FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $file = new file();
                    $file->setFileId($row["fileId"]);
                    $file->setName($row["name"]);

                    array_push($fileList, $file);
                }

                return $fileList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function GetByFileId($fileId)
        {
            try
            {
                $file = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE fileId = :fileId";

                $parameters["fileId"] = $fileId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $file = new File();
                    $file->setFileId($row["fileId"]);
                    $file->setName($row["name"]);
                }

                return $file;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>