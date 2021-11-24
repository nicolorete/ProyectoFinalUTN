<?php
    namespace Controllers;

    use DAO\UserCompanyDAOPDO as UserCompanyDAOPDO;
    use Models\UserCompany as UserCompany;

    class UserCompanyController
    {
        private $userCompanyDAO;

        public function __construct(){
            $this->userCompanyDAO = new UserCompanyDAOPDO();
        }
      

        public function Add($email, $password, $company){
            $userCompany = new UserCompany();
            $userCompanyFound = false;
            $userCompanyList = $this->userCompanyDAO->GetAll();
            
            if($userCompanyList){
                foreach($userCompanyList as $userNew) {
                    if($userNew->getEmail() == $email){
                        $userCompanyFound = true;
                    }
                }
                if($userCompanyFound == false){
                    $userCompany = $this->setUser($email, $password, $company);
                    $this->userCompanyDAO->Add($userCompany);
                } else {
                    ?>
                        <script>alert(' existe una Empresa con ese email');</script>
                    <?php
                }
            } else {
                $userCompany = $this->setUser($email, $password, $company);
                $this->userCompanyDAO->Add($userCompany);
            }
            $this->ShowListView();
        }
           
        private function setUser($email, $password, $company) {
            $user = new UserCompany();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setCompany($company);
            return $user;
        }

        public function Delete($id) {
            require_once(VIEWS_PATH."validate-session.php");
            $this->userCompanyDAO->Delete($id);
            $this->ShowListView();
        }

        //////////////////////////////////////////////////////////////////////////////////////////
        public function ShowListView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $userCompanyList = $this->userCompanyDAO->GetAll();
    
            // require_once(VIEWS_PATH . "admin-list.php");
        }
        public function ShowAddView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            // require_once(VIEWS_PATH . "admin-add.php");
        }
      
    }
?> 