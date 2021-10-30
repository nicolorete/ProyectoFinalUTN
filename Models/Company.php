<?php

namespace Models;

class Company
{
    private $companyId;
	private $job;
    private $cuit;
    private $nombre;
	private $address;
	private $link;
	private $isActive;


    public function __construct()
    {	
		$this->isActive = 1;
        
    }

  
	public function getCompanyId()
	{
		return $this->companyId;
	}


	public function setCompanyId($companyId)
	{
		$this->companyId = $companyId;

		return $this;
	}



	public function getCuit()
	{
		return $this->cuit;
	}


	public function setCuit($cuit)
	{
		$this->cuit = $cuit;

		return $this;
	}




	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}




	public function getAddress()
	{
		return $this->address;
	}


	public function setAddress($address)
	{
		$this->address = $address;

		return $this;
	}



	public function getLink()
	{
		return $this->link;
	}

	public function setLink($link)
	{
		$this->link = $link;

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