<?php

class Application_Model_Npc
{
	protected $_id;
	protected $_name;
	protected $_quest;
	protected $_talk;
	

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
    
    public function getQuest()
    {
    	if($this->_quest == null || $this->_quest == '')
    		return null;
    	else
    	{
    		$quest = Application_Model_Quest();
    		$mapper = Application_Model_QuestMapper();
    		$mapper->find($this->_quest, $quest);
    		return $quest;	
    	}
    }
    
    public function setQuest($quest)
    {
    	$this->_quest = (int) $quest;
    	return $this;
    }

    public function getTalk()
    {
    	if($this->_talk == null || $this->_talk == '')
    		return null;
    	else
    		return $this->_talk;
    }
    
    public function setTalk($talk)
    {
    	$this->_talk = (string) $talk;
    	return $this;
    }
}

