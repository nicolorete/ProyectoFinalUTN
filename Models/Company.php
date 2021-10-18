<?php

namespace Models;

class Company
{
    private $companyId;
    private $cuit;
    private $nombre;
	private $descripcion;
	private $link;
	private $active = true;


    public function __construct()
    {
        
    }

    /**
	 * Get the value of id
	 */ 
	public function getCompanyId()
	{
		return $this->companyId;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setCompanyId($companyId)
	{
		$this->companyId = $companyId;

		return $this;
	}



	public function getCuit()
	{
		return $this->cuit;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setCuit($cuit)
	{
		$this->cuit = $cuit;

		return $this;
	}




	/**
	 * Get the value of nombre
	 */ 
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 *
	 * @return  self
	 */ 
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}




	public function getDescripcion()
	{
		return $this->descripcion;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setDescripcion($descripcion)
	{
		$this->descripcion = $descripcion;

		return $this;
	}



	public function getLink()
	{
		return $this->link;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setLink($link)
	{
		$this->link = $link;

		return $this;
	}


	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setActive($active)
	{
		$this->active = $active;

		return $this;
	}
}