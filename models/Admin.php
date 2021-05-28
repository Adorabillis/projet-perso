<?php

namespace Models;

class Admin extends Database
{
	public function getAdminByLogin(string $login):?array
	{
		return $this -> findOne("SELECT login, password, name FROM admin WHERE login = ?", [$login]);
	}	
}

