<?php
    namespace DAO;

    use DAO\IAdminDAO as IAdminDAO;
    use Models\Admin as Admin;

class AdminDAO implements IAdminDAO{

        private $adminList = array();
        private $dataFile;

        public function __construct(){
            $this->dataFile = dirname(__DIR__)."\Data\admin.json";
        }

        public function add(Admin $newAdmin){
    
            $this->retrieveData();
            array_push($this->adminList, $newAdmin);
            $this->saveData();
        }

        public function deleteById($id){
            $this->retrieveData();
            if(!empty($this->adminList)){
                foreach($this->adminList as $admin){
                    if($admin->getAdminId() == $id){
                        $index = array_search($admin, $this->adminList);
                        unset($this->adminList[$index]);
                    }
                }
            }
            $this->saveData();
        }

        public function getAll(){
            $this->retrieveData();
            return $this->adminList;            
        }

        private function saveData(){
            
            $encodingArray = array();

            foreach($this->adminList as $eachAdmin){
                $arrayValue['adminId'] = $eachAdmin->getAdminId();
                $arrayValue['password'] = $eachAdmin->getPassword();
                $arrayValue['userName'] = $eachAdmin->getUserName();

                array_push($encodingArray, $arrayValue);
            }

            $dataToFile = json_encode($encodingArray, JSON_PRETTY_PRINT);

            file_put_contents($this->dataFile, $dataToFile);
        }

        private function retrieveData(){
           
            $this->adminList = array();

            if(file_exists($this->dataFile)){

                $jsonContent = file_get_contents($this->dataFile);

                $decodingArray = ($jsonContent) ? json_decode($jsonContent, true) : array();
                
                foreach($decodingArray as $eachValue){
                    $password = $eachValue["password"];
                    $userName = $eachValue["userName"];

                    $admin = new Admin($userName, $password);

                    $admin->setAdminId($eachValue['adminId']);

                    array_push($this->adminList, $admin);
                }
            }
        }

    }
?>