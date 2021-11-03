<?php
    namespace Models;

    class JobOffer {

        private $jobOfferId;
        private $title;
        private $date;
        private $description;
        private $jobPosition; 
        private $company;
        private $active;
        
        
       public function getJobOfferId() {
            return $this->jobOfferId;
        }

        public function setJobOfferId($jobOfferId) {
            $this->jobOfferId = $jobOfferId;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getDate() {
            return $this->date;
        }

        public function setDate($date) {
            $this->date = $date;
        }

        public function getDescription() {
            return $this->description;
        }
 
        public function setDescription($description) {
            $this->description = $description;
        }

        public function getJobPosition() {
            return $this->jobPosition;
        }

        public function setJobPosition($jobPosition) {
            $this->jobPosition = $jobPosition;
        }

        public function getCompany()
        {
            return $this->company;
        }

        public function setCompany($company)
        {
            $this->company = $company;
        }

        public function getActive() {
            return $this->active;
        }

        public function setActive($active) {
            $this->active = $active;
        }

        
    }
    
?>