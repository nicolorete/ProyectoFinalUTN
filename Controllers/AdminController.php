<?php
    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
    
    use Models\Admin as Admin;

    class AdminController
    {
        private $adminDAO;

        public function __construct(){
            $this->adminDAO = new AdminDAO();
        }

       
     
      
    }
?> 