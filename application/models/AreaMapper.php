<?php

class Application_Model_AreaMapper
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
            $this->setDbTable('Application_Model_DbTable_Area');
        }
        return $this->_dbTable;
    }
    	
    public function update(Application_Model_Area $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'access' => $model->getAccess(),
    			'restriction' => $model->getRestriction()
    					);
    	$id = $model->getId();
    	foreach($data as $key => $value)
    	{
    		if($value == null || !isset($value) || $value == '' || $value == ' ' || $value == ',')
    		{
    			unset($data[$key]);
    			echo $key;	
    		}
    	}
    	if (null === $id ) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function save(Application_Model_Area $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'access' => $model->getAccess(),
    			'restriction' => $model->getRestriction()
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
    
    public function find($id, Application_Model_Area $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setName($row->name)
                  ->setAccess((int)$row->access)
                  ->setRestriction($row->restriction);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Area();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setAccess($row->access)
                  ->setRestriction($row->restriction);
            $entries[] = $entry;
        }
        return $entries;
    }

}

