<?php

class Application_Model_MonsterMapper
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
            $this->setDbTable('Application_Model_DbTable_Monster');
        }
        return $this->_dbTable;
    }
    	
    public function update(Application_Model_Monster $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'health' => new Zend_Db_Expr('health + '.$model->getHealth()),
    			'attackDamage' => $model->getAttackDamage()
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
    
    public function save(Application_Model_Monster $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'health' => $model->getHealth(),
    			'attackDamage' => $model->getAttackDamage()
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
    
    public function find($id, Application_Model_Monster $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setName($row->name)
                  ->setHealth($row->health)
                  ->setAttackDamage($row->attackDamage);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Monster();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setHealth($row->health)
                  ->setAttackDamage($row->attackDamage);
            $entries[] = $entry;
        }
        return $entries;
    }
}

