<?php

class Application_Model_MonsterInstance
{
	protected $_id;
	protected $_playerId;
	protected $_monsterId;
	protected $_areaId;
	protected $_health;
	
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
            throw new Exception('Invalid monster_instance property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid monster_instance property');
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

	public function getPlayerId()
    {
    	if($this->_playerId != null)
    		return  $this->_playerId;
    	else
    		return null;
    }
    
    public function setPlayerId($playerId)
    {
    	$this->_playerId = (int) $playerId;
    	return $this;
    }
    
	public function getMonsterId()
    {
    	if($this->_monsterId != null)
    		return  $this->_monsterId;
    	else
    		return null;
    }
    
    public function setMonsterId($monsterId)
    {
    	$this->_monsterId = (int) $monsterId;
    	return $this;
    }
    
	public function getHealth()
    {
    	if($this->_health != null)
    		return $this->_health;
    	else
    		return null;
    }
    
    public function setHealth($health)
    {
    	$this->_health = (int) $health;
    	return $this;
    }


}

