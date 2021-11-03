<?php
    namespace Controllers;

    use DAO\AdminDAOPDO as AdminDAOPDO;
    use Models\Admin as Admin;

    class AdminController
    {
        private $adminDAO;

        public function __construct(){
            $this->adminDAO = new AdminDAOPDO();
        }
      

        public function Add($email, $password){
            $admin = new Admin();
            $adminFound = false;
            $adminList = $this->adminDAO->GetAll();
            
            if($adminList){
                foreach($adminList as $adminNew) {
                    if($adminNew->getEmail() == $email){
                        $adminFound = true;
                    }
                }
                if($adminFound == false){
                    $admin = $this->setAdmin($email, $password);
                    $this->adminDAO->Add($admin);
                } else {
                    ?>
                        <script>alert('Ya existe un Administrador con ese email');</script>
                    <?php
                }
            } else {
                $admin = $this->setAdmin($email, $password);
                $this->adminDAO->Add($admin);
            }
            $this->ShowListView();
        }
           
        private function setAdmin($email, $password) {
            $admin = new admin();
            $admin->setEmail($email);
            $admin->setPassword($password);
            return $admin;
        }

        public function Delete($id) {
            require_once(VIEWS_PATH."validate-session.php");
            $this->adminDAO->Delete($id);
            $this->ShowListView();
        }

        //////////////////////////////////////////////////////////////////////////////////////////
        public function ShowListView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $userList = $this->adminDAO->GetAll();
    
            require_once(VIEWS_PATH . "admin-list.php");
        }
        public function ShowAddView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "admin-add.php");
        }
      
    }
?> 