<?php   namespace Models;

    class Student{
        private $studentId;
		private $career;
        private $firstName;
        private $lastName;
		private $dni;
		private $fileNumber;
		private $gender;
		private $birthDate;
        private $email;
        private $phoneNumber;
        private $active;
        
        
        
        

        public function __construct($firstName, $lastName, $email, $phoneNumber, $gender, $dni, $birthDate){
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->gender = $gender;
            $this->dni = $dni;
            $this->birthDate = $birthDate;
        }

        
        public function getStudentId(){
            return $this->studentId;
        }

        public function setStudentId($studentId){
            $this->studentId = $studentId;
        }
        
        public function getFirstName(){
            return $this->firstName;
        }

        public function setFirstName($firstName){
            $this->firstName = $firstName;
        }
        
        public function getLastName(){
            return $this->lastName;
        }

        public function setLastName($lastName){
            $this->lastName = $lastName;
        }

        public function getEmail(){
                return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPhoneNumber(){
            return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber){
            $this->phoneNumber = $phoneNumber;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setGender($gender){
            $this->gender = $gender;
        }

        public function getDni(){
            return $this->dni;
        }

        public function setDni($dni){
            $this->dni = $dni;
        }

        public function getBirthDate(){
            return $this->birthDate;
        }

        public function setBirthDate($birthDate){
            $this->birthDate = $birthDate;
        }

        public function getCareer(){
            return $this->career;
        }

        public function setCareer($career){
            $this->career = $career;
        }
		public function getActive(){
            return $this->active;
        }

        public function setActive($active){
            $this->active = $active;
        }

      

        //toString
        public function __tostring(){
            return "<br>ID: ".$this->studentId.
                   "<br>DNI: ".$this->dni.
                   "<br>Full name: ".$this->firstName." ".$this->lastName.
                   "<br>Born in ".$this->birthDate.
				   "<br>File Number: #".$this->fileNumber.
                   "<br>Gender: ".$this->gender.
                   "<br>Phone: ".$this->phoneNumber.
                   "<br>Email: ".$this->email.
                   "<br>Career: ".$this->career;
                   
        }
    };
?>