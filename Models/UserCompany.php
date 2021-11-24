<?php namespace Models;

class UserCompany{

    private $userCompanyId;
    private $email;
    private $password;
    private $company;

  

    public function getUserCompanyId(){ return $this->userCompanyId;}
    public function setUserCompanyId($userCompanyId) { $this->userCompanyId = $userCompanyId; return $this;}
   

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getCompany(){
        return $this->company;
    }
    public function setCompany($company){
        $this->company = $company;
        return $this;
    }  
}
