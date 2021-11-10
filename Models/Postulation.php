<?php namespace Models;

class Postulation{

  private $postulationId;
  private $jobOffer;
  private $student;
  private $datePostulation;
  private $presentation;
  private $cv; 
  private $isActive;

  public function __construct()
  {	
  $this->isActive = 1;
      
  }

  public function getPostulationId()
	{
		return $this->postulationId;
	}


	public function setPostulationId($postulationId)
	{
		$this->postulationId = $postulationId;

		return $this;
	}
  public function getJobOffer()
  {
    return $this->jobOffer;
  }

  public function setJobOffer($jobOffer)
  {
    $this->jobOffer = $jobOffer;

    return $this;
  }
 
  public function getStudent()
  {
    return $this->student;
  }

  public function setStudent($student)
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
  
  public function setIsActive($isActive)
	{
		$this->isActive = $isActive;
	}

	public function getIsActive()
	{
		return $this->isActive;
	}
 
}
?>