<?php

namespace models;

/**
 * Clase usuario
 */
class User extends UserProfile
{
	private $id;
	private $email;
	private $password;
	private $role; 					// 1 = 'admin' / 0 = 'usuario' 

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}
}