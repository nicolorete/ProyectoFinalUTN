<?php
    namespace Controllers;

    use DAO\FileDAOPDO as FileDAOPDO;
    use Exception;
    use Models\File as File;

    class FileController
    {
        private $fileDAO;

        public function __construct()
        {
            $this->fileDAO = new FileDAOPDO();
        }

        public function ShowUploadView()
        {
            require_once(VIEWS_PATH."index.php");
        }

        public function ShowListView($message = "")
        {
            $fileList = $this->fileDAO->GetAll();

            require_once(VIEWS_PATH."file-list.php");
        }

        public function Showfile($fileId)
        {
            $file = $this->fileDAO->getByFileId($fileId);

            require_once(VIEWS_PATH."file-show.php");
        }

        public function Upload($file)
        {
            try
            {
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                
                $filePath = UPLOADS_PATH.basename($fileName);            

                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $imageSize = getimagesize($tempFileName);

                if($imageSize == false)
                {
                    if (move_uploaded_file($tempFileName, $filePath))
                    {
                        $image = new File();
                        $image->setName($fileName);
                        $this->fileDAO->Add($file);

                        $message = "archivo subido correctamente";
                    }
                    else
                        $message = "Ocurrió un error al intentar subir el archivo";
                }
                else   
                    $message = "El archivo corresponde a una imágen";
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }

            $this->ShowListView($message);
        }    
    }
?>