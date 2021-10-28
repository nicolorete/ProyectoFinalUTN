<?php
    namespace DAO;

    use Models\Admin as Admin;

    interface IAdminDAO
    {
        function add(Admin $Admin);
        function getAll();
        function deleteById($name);
    }
?>