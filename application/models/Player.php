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

class Application_Model_Player
{
	protected $_id;
	protected $_name;
	protected $_hero;
	protected $_health;
	protected $_mana;
	protected $_attackDamage;
	protected $_defense;
	protected $_experience;
	protected $_location;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid player property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid player property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function getId()
    {
    	return $this->_id;
    }
    
    public function setId($id)
    {
    	$this->_id = (int) $id;
    	return $this;
    }
    
	public function getName()
    {
    	return  $this->_name;
    }
    
    public function setName($name)
    {
    	$this->_name = (string) $name;
    	return $this;
    }
    
	public function getHero()
    {
    	return $this->_hero;
    }
    
    public function setHero($hero)
    {
    	$this->_hero = (string) $hero;
    	return $this;
    }
    
	public function getHealth()
    {
    	return $this->_health;
    }
    
    public function setHealth($health)
    {
    	$this->_health = (int) $health;
    	return $this;
    }
    
	public function getMana()
    {
    	return $this->_mana;
    }
    
    public function setMana($mana)
    {
    	$this->_mana = (int) $mana;
    	return $this;
    }
    
	public function getAttackDamage()
    {
    	return $this->_attackDamage;	
    }
    
    public function setAttackDamage($attackDamage)
    {
    	$this->_attackDamage = (int) $attackDamage;
    	return $this;
    }
    
	public function getDefense()
    {
    	return $this->_defense;
    }
    
    public function setDefense($defense)
    {
    	$this->_defense = (int) $defense;
    	return $this;
    }
    
    public  function getExperience()
    {
    	return $this->_experience;
    }
    
    public function setExperience($exp)
    {
    	$this->_experience = (int) $exp;
    	return $this;
    }
    
	public function getLocation()
    {
    	if($this->_location != null)
    		return  $this->_location;
    	else
    		return null;
    }
    
    public function setLocation($location)
    {
    	$this->_location = (string) $location;
    	return $this;
    }
 
}

