<?php

class Application_Model_NpcMapper
{
	protected $_dbTable;
	
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Npc');
        }
        return $this->_dbTable;
    }
    	
    public function save(Application_Model_Npc $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'quest' => $model->getQuest(),
    			'talk' => $model->getTalk()
    					);
    	if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Npc $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setName($row->name)
                  ->setQuest($row->quest)
                  ->setTalk($row->talk);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Npc();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setQuest($row->quest)
                  ->setTalk($row->talk);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function update(Application_Model_Npc $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'quest' => $model->getQuest(),
    			'talk' => $model->getTalk()
    					);
    	$id = $model->getId();
    	foreach($data as $key => $value)
    	{
    		if($value == null || !isset($value) || $value == '' || $value == ' ' || $value == ',')
    		{
    			unset($data[$key]);
    		}
    	}
    	if (null === $id ) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

}

