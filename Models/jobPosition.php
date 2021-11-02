<?php
    namespace Models;

    class jobPosition {
        private $jobPositionId;
        private $career;
        private $description;

       
        public function getJobPositionId() {
            return $this->jobPositionId;
        }

        public function setJobPositionId($jobPositionId) {
            $this->jobPositionId = $jobPositionId;
        }

        public function getCareer() {
            return $this->career;
        }

        public function setCareer($career) {
            array_push($this->career = $career);
        }

        public function getDescription() {
           return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        //TO STRING METHOD
        public function __toString() {
            return  "<br>ID: ".$this->jobPositionId.
                    "<br>Career ID: ".$this->careerId.
                    "<br>Description: ".$this->description;
        }
    }
?>