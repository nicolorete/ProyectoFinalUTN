<?php  namespace Models;

class Admin{

    private $adminId;
    private $email;
    private $password;

    Public function __construct($email, $password){
        $this->email= $email;
        $this->password= $password;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function __tostring(){
        return "<br>ID: ".$this->adminId.
               "<br>Email: ".$this->email.
               "<br>Password: ".$this->password;
               
    }
}


?>