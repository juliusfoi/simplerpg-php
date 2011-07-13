<?php
/*
 * 	Copyright 2011 by Julius Foitzik
 * 
   	This file is part of SimpleRPG.
 
    SimpleRPG is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SimpleRPG is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SimpleRPG.  If not, see <http://www.gnu.org/licenses/>.
*/

use Irontouch\Entity\Entity;


class Application_Model_User extends Entity
{
	protected $_username;
	protected $_password;
	protected $_email;
	protected $_salt;
	
	public function hash($password = null)
	{
		if($password != null)
			$this->_password = $password;
		$this->_password = $hash = hash_hmac('sha256', $this->_password.$this->_username, $this->_salt);
		return $hash;
	}
	
	public function getUsername()
    {
    	if($this->_username == null || $this->_username == '')
    		return '';
    	else
    		return $this->_username;
    }
    
    public function setUsername($username)
    {
    	$this->_username = (string) $username;
    	return $this;
    }
    
	public function getPassword()
    {
    	if($this->_password == null || $this->_password == '')
    		return '';
    	else
    		return $this->_password;
    }
    
    public function setPassword($password)
    {
    	$this->_password = (string) $password;
    	return $this;
    }
    
	public function getEmail()
    {
    	if($this->_email == null || $this->_email == '')
    		return '';
    	else
    		return $this->_email;
    }
    
    public function setEmail($email)
    {
    	$this->_email = (string) $email;
    	return $this;
    }
    
	public function getSalt()
    {
    	if($this->_salt == null || $this->_salt == '')
    		return '';
    	else
    		return $this->_salt;
    }
    
    public function setSalt($salt)
    {
    	$this->_salt = (string) $salt;
    	return $this;
    }
    
    public function findByName($name)
    {
    	$mapper = new Application_Model_UserMapper();
    	$mapper->findByName($name, $this);
    }

}

