<?php

class Application_Model_PlayerMapper
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
            $this->setDbTable('Application_Model_DbTable_Player');
        }
        return $this->_dbTable;
    }
    	
    public function save(Application_Model_Player $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'hero' => $model->getHero(),
    			'health' => $model->getHealth(),
    			'mana' => $model->getMana(),
    			'attackDamage' => $model->getAttackDamage(),
    			'defense' => $model->getDefense(),
    			'experience' => $model->getExperience()
    					);
    	if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Player $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setName($row->name)
                  ->setHero($row->hero)
                  ->setHealth($row->health)
                  ->setMana($row->mana)
                  ->setAttackDamage($row->attackDamage)
                  ->setDefense($row->defense)
                  ->setExperience($row->experience);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Player();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setHero($row->hero)
                  ->setHealth($row->health)
                  ->setMana($row->mana)
                  ->setAttackDamage($row->attackDamage)
                  ->setDefense($row->defense)
                  ->setExperience($row->experience);
            $entries[] = $entry;
        }
        return $entries;
    }

}

