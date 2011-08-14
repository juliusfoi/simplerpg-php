<?php

class Application_Model_MonsterInstanceMapper
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
            $this->setDbTable('Application_Model_DbTable_MonsterInstance');
        }
        return $this->_dbTable;
    }
    	
    public function update(Application_Model_MonsterInstance $model)
    {
    	$data = array(
    			'playerId' => $model->getPlayerId(),
    			'monsterId' => $model->getMonsterId(),
    			'areaId' => $model->getAreaId(),
    			'health' => new Zend_Db_Expr('health + '.$model->getHealth())
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
    
    public function save(Application_Model_MonsterInstance $model)
    {
    	$data = array(
    			'playerId' => $model->getPlayerId(),
    			'monsterId' => $model->getMonsterId(),
    			'areaId' => $model->getAreaId(),
    			'health' => $model->getHealth()
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
    
    public function find($id, Application_Model_MonsterInstance $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
              ->setPlayerId($row->playerId)
              ->setMonsterId($row->monsterId)
              ->setAreaId($row->areaId)
              ->setHealth($row->health);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_MonsterInstance();
            $entry->setId($row->id)
                  ->setPlayerId($row->playerId)
                  ->setMonsterId($row->monsterId)
                  ->setAreaId($row->areaId)
                  ->setHealth($row->health);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function getOriginal(Application_Model_MonsterInstance $monster)
    {
    	$mapper = new Application_Model_MonsterMapper();
		$original = new Application_Model_Monster();
    	$mapper->find($monster->id, $original);
    	return $original;
    }

}

