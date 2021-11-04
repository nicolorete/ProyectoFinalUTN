<?php
    namespace DAO;

    use Models\File as File;

    interface IFileDAOPDO
    {
        function Add(File $file);
        function GetAll();
        function GetByFileId($fileId);
    }
?>