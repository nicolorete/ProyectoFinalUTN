<?php namespace Models;

class Postulation{

  private $jobOfferID;
  private $studentID;
  private $datePostulation;
  private $presentation;
  private $cv; 

  
  public function setJobOfferId($jobOffer)
  {
    $this->jobOffer = $jobOffer;

    return $this;
  }
 
  public function getStudentId()
  {
    return $this->student;
  }

  public function setStudentId($student)
  {
    $this->student = $student;

    return $this;
  }

  public function getDatePostulation()
  {
    return $this->datePostulation;
  }

  public function setDatePostulation($datePostulation)
  {
    $this->datePostulation = $datePostulation;

    return $this;
  }

  public function getPresentation()
  {
    return $this->presentation;
  }

  public function setPresentation($presentation)
  {
    $this->presentation = $presentation;

    return $this;
  }

  public function getCV()
  {
    return $this->cv;
  }

  public function setCV($cv)
  {
    $this->cv = $cv;

    return $this;
  }

  public function getJobOfferId()
  {
    return $this->jobOffer;
  }
 
}
?>