<?php

class Application_Model_QuestInstance
{

	protected $_id;
	protected $_playerId;
	protected $_questId;
	protected $_monsterCount;
	protected $_objectiveStatus;
	protected $_status;
	
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
            throw new Exception('Invalid quest_instance property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid quest_instance property');
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
    
    public function getPlayerId()
    {
    	return $this->_playerId;
    }
    
    public function setPlayerId($playerId)
    {
    	$this->_playerId = (int) $playerId;
    	return $this;
    }
    
    public function getQuestId()
    {
    	return $this->_questId;
    }
    
    public function setQuestId($questId)
    {
    	$this->_questId = (int) $questId;
    	return $this;
    }
    
    public function getMonsterCount()
    {
    	return $this->_monsterCount;
    }
    
    public function setMonsterCount($monsterCount)
    {
    	$this->_monsterCount = (int) $monsterCount;
    	return $this;
    }    
    
    public function getObjectiveStatus()
    {
    	return $this->_objectiveStatus;
    }
    
    public function setObjectiveStatus($objectiveStatus)
    {
    	$this->_objectiveStatus = (int) $objectiveStatus;
    	return $this;
    }
    
    public function getStatus()
    {
    	return $this->_status;
    }
    
    public function setStatus($status)
    {
    	$this->_status = $status;
    	return $this;
    }
    
    public function importModelId(Application_Model_Quest $quest)
    {
    	$this->_questId = $quest->id;
    }

}

