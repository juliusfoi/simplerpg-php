<?php

class Application_Model_Monster
{
	protected $_id;
	protected $_name;
	protected $_health;
	protected $_attackDamage;
	
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
            throw new Exception('Invalid monster property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid monster property');
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
    	if($this->_name != null)
    		return  $this->_name;
    	else
    		return null;
    }
    
    public function setName($name)
    {
    	$this->_name = (string) $name;
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
    
	public function getAttackDamage()
    {
    	return $this->_attackDamage;	
    }
    
    public function setAttackDamage($attackDamage)
    {
    	$this->_attackDamage = (int) $attackDamage;
    	return $this;
    }

}

