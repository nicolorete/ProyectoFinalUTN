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
        
        private $password;
        
        public function __construct(){
        }
        

        // public function __construct($studentId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active){
        //     $this->firstName = $firstName;
        //     $this->lastName = $lastName;
        //     $this->email = $email;
        //     $this->phoneNumber = $phoneNumber;
        //     $this->gender = $gender;
        //     $this->dni = $dni;
        //     $this->birthDate = $birthDate;
        // }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }
        
        public function getStudentId(){
            return $this->studentId;
        }

        public function setStudentId($studentId){
            $this->studentId = $studentId;
        }

        public function getFileNumber(){
            return $this->fileNumber;
        }

        public function setFileNumber($fileNumber){
            $this->fileNumber = $fileNumber;
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
    

    
    };
?>