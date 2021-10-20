<?php

namespace Models;

/**
 *  Clase Rol
 */

class Role
{
	private $idRol;
	private $description; // 1 = Admin 0 = user

	public function getIdRol()
	{
		return $this->idRol;
	}

	public function setIdRol($idRol)
	{
		$this->idRol = $idRol;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}
}
