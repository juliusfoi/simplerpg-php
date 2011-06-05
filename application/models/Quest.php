<?php

class Application_Model_Quest
{
	
	protected $_id;
	protected $_title;
	protected $_content;
	protected $_npc;
	protected $_gold;
	protected $_experience;

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
    
	public function getTitle()
    {
    	if($this->_title == null || $this->_title == '')
    		return '';
    	else
    		return $this->_title;
    }
    
    public function setTitle($title)
    {
    	$this->_title = (string) $title;
    	return $this;
    }
    
	public function getContent()
    {
    	if($this->_content == null || $this->_content == '')
    		return '';
    	else
    		return $this->_content;
    }
    
    public function setContent($content)
    {
    	$this->_content = (string) $content;
    	return $this;
    }
    
	public function getNpc()
    {
    	if($this->_npc == null || $this->_npc == '')
    		return '';
    	else
    		return $this->_npc;
    }
    
    public function setNpc($npc)
    {
    	$this->_npc = (string) $npc;
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
    
	public  function getGold()
    {
    	if($this->_gold == null || $this->_gold == '')
    		return 0;
    	else
    		return $this->_gold;
    }
    
    public function setGold($gold)
    {
    	$this->_gold = (int) $gold;
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

