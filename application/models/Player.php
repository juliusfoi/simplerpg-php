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

class Application_Model_Player extends Entity
{
	protected $_name;
	protected $_hero;
	protected $_health;
	protected $_mana;
	protected $_attackDamage;
	protected $_defense;
	protected $_experience;
	protected $_areaId;
    
	public function getName()
    {
    	if($this->_name == null || $this->_name == '')
    		return '';
    	else
    		return $this->_name;
    }
    
    public function setName($name)
    {
    	$this->_name = (string) $name;
    	return $this;
    }
    
	public function getHero()
    {
    	if($this->_hero == null || $this->_hero == '')
    		return '';
    	else
    		return $this->_hero;
    }
    
    public function setHero($hero)
    {
    	$this->_hero = (string) $hero;
    	return $this;
    }
    
	public function getHealth()
    {
    	if($this->_health == null || $this->_health == '')
    		return 0;
    	else
    		return $this->_health;
    }
    
    public function setHealth($health)
    {
    	$this->_health = (int) $health;
    	return $this;
    }
    
	public function getMana()
    {
    	if($this->_mana == null || $this->_mana == '')
    		return 0;
    	else
    		return $this->_mana;
    }
    
    public function setMana($mana)
    {
    	$this->_mana = (int) $mana;
    	return $this;
    }
    
	public function getAttackDamage()
    {
    	if($this->_attackDamage == null || $this->_attackDamage == '')
    		return 0;
    	else
    		return $this->_attackDamage;	
    }
    
    public function setAttackDamage($attackDamage)
    {
    	$this->_attackDamage = (int) $attackDamage;
    	return $this;
    }
    
	public function getDefense()
    {
    	if($this->_defense == null || $this->_defense == '')
    		return 0;
    	else
    		return $this->_defense;
    }
    
    public function setDefense($defense)
    {
    	$this->_defense = (int) $defense;
    	return $this;
    }
    
    public  function getExperience()
    {
    	if($this->_experience == null || $this->_experience == '')
    		return 0;
    	else
    		return $this->_experience;
    }
    
    public function setExperience($exp)
    {
    	$this->_experience = (int) $exp;
    	return $this;
    }
    
	public function getAreaId()
    {
    	if($this->_areaId != null)
    		return  $this->_areaId;
    	else
    		return null;
    }
    
    public function setAreaId($areaId)
    {
    	$this->_areaId = (int) $areaId;
    	return $this;
    }
    
    public function getLocation()
    {
    	$mapper = new Application_Model_AreaMapper();
    	$area = new Application_Model_Area();
    	$mapper->find($this->areaId, $area);
    	return $area->getName();
    }
    
    public function importModel(Application_Model_Player $model)
    {
    }
 
}

