<?php

class Application_Model_QuestInstanceMapper
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
            $this->setDbTable('Application_Model_DbTable_QuestInstance');
        }
        return $this->_dbTable;
    }
    	
    public function update(Application_Model_QuestInstance $model)
    {
    	$data = array(
    			'playerId' => $model->getPlayerId(),
    			'questId' => $model->getQuestId(),
    			'monsterCount' => $model->getMonsterCount(),
    			'objectiveStatus' => $model->getObjectiveStatus(),
    			'status' => $model->getStatus()
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
    
    public function save(Application_Model_QuestInstance $model)
    {
    	$data = array(
    			'playerId' => $model->getPlayerId(),
    			'questId' => $model->getQuestId(),
    			'monsterCount' => $model->getMonsterCount(),
    			'objectiveStatus' => $model->getObjectiveStatus(),
    			'status' => $model->getStatus()
    					);
    	$id = $model->getId();
    	foreach($data as $key => $value)
    	{
    		if($value == null || !isset($value) || $value == '')
    			unset($data[$key]);
    	}
    	if (null === $id ) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_QuestInstance $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return false;
        }
        $row = $result->current();
        $model->setId($row->id)
              ->setPlayerId($row->playerId)
              ->setQuestId($row->questId)
              ->setMonsterCount($row->monsterCount)
              ->setObjectiveStatus($row->objectiveStatus)
              ->setStatus($row->status);
        return true;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_QuestInstance();
            $entry->setId($row->id)
                  ->setPlayerId($row->playerId)
                  ->setQuestId($row->questId)
                  ->setMonsterCount($row->monsterCount)
                  ->setObjectiveStatus($row->objectiveStatus)
                  ->setStatus($row->status);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchNew()
    {
    	$table = $this->getDbTable();
    	$where = $table->select()->where('status = ?', 'accepted');
    	$resultSet = $this->getDbTable()->fetchAll($where);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_QuestInstance();
            $entry->setId($row->id)
                  ->setPlayerId($row->playerId)
                  ->setQuestId($row->questId)
                  ->setMonsterCount($row->monsterCount)
                  ->setObjectiveStatus($row->objectiveStatus)
                  ->setStatus($row->status);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchByPlayerId($id)
    {
    	$table = $this->getDbTable();
    	$where = $table->select()->where('playerId = ?', $id);
    	$resultSet = $this->getDbTable()->fetchAll($where);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_QuestInstance();
            $entry->setId($row->id)
                  ->setPlayerId($row->playerId)
                  ->setQuestId($row->questId)
                  ->setMonsterCount($row->monsterCount)
                  ->setObjectiveStatus($row->objectiveStatus)
                  ->setStatus($row->status);
            $entries[] = $entry;
        }
        return $entries;
    }
	

}

