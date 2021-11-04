<?php
    namespace Models;

    class File
    {
        private $fileId;
        private $name;

        public function getFileId()
        {
            return $this->fileId;
        }

        public function setFileId($fileId)
        {
            $this->fileId = $fileId;
        }  
       
        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }        
    }
?>