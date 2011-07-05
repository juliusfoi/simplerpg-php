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

class Application_Model_Item
{
	protected $_id;
	protected $_name;
	protected $_type;
	protected $_damage;
	protected $_defense;
	protected $_image;
	protected $_requirement;
	protected $_craftable;
	protected $_buyable;
	protected $_dropable;
	

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
    	if($this->_id == null || $this->_id == '')
    		return null;
    	else
    		return $this->_id;
    }
    
    public function setId($id)
    {
    	$this->_id = (int) $id;
    	return $this;
    }
    
    public function getName()
    {
    	if($this->_name == null || $this->_name == '')
    		return null;
    	else
    		return $this->_name;
    }
    
    public function setName($name)
    {
    	$this->_name = (string) $name;
    	return $this;
    }
    
    public function getType()
    {
    	if($this->_type == null)
    		return null;
    	else
    		return $this->_type;
    }
    
    public function setType($type)
    {
    	$this->_type = (int) $type;
    	return $this;
    }
    
    public function getDamage()
    {
    	if($this->_damage == null)
    		return null;
    	else
    		return $this->_damage;
    }
    
    public function setDamage($damage)
    {
    	$this->_damage = (int) $damage;
    	return $this;
    }
    
    public function getDefense()
    {
    	if($this->_defense == null)
    		return null;
    	else
    		return $this->_defense;
    }
    
    public function setDefense($defense)
    {
    	$this->_defense = (int) $defense;
    	return $this;
    }
    
    public function getImage()
    {
    	if($this->_image == null)
    		return null;
    	else
    		return $this->_image;
    }
    
    public function setImage($image)
    {
    	$this->_image = (int) $image;
    	return $this;
    }
    
    public function getRequirement()
    {
    	if($this->_requirement == null)
    		return null;
    	else
    		return $this->_requirement;
    }
    
    public function setRequirement($requirement)
    {
    	$this->_requirement = (int) $requirement;
    	return $this;
    }
    
    public function getCraftable()
    {
    	if($this->_craftable == null)
    		return null;
    	else
    		return $this->_craftable;
    }
    
    public function setCraftable($craftable)
    {
    	$this->_craftable = (bool) $craftable;
    	return $this;
    }
    
    public function getBuyable()
    {
    	if($this->_buyable == null)
    		return null;
    	else
    		return $this->_buyable;
    }
    
    public function setBuyable($buyable)
    {
    	$this->_buyable = (bool) $buyable;
    	return $this;
    }

}

