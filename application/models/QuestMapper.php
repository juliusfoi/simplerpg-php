<?php
/*
 * 	Copyright 2011 by Julius Foitzik
 * 
   	This file is part of SimpleRPG.
 
    SimpleRPG is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SimpleRPG is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SimpleRPG.  If not, see <http://www.gnu.org/licenses/>.
*/

class Application_Model_QuestMapper
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
            $this->setDbTable('Application_Model_DbTable_Quest');
        }
        return $this->_dbTable;
    }
    	
    public function save(Application_Model_Quest $model)
    {
    	$data = array(
    			'title' => $model->getTitle(),
    			'content' => $model->getContent(),
    			'experience' => $model->getExperience(),
    			'gold' => $model->getGold(),
    			'npc' => $model->getNpc(),
    			'monsterlist' => $model->getRawMonsterlist()
    					);
    	if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Quest $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setTitle($row->title)
                  ->setContent($row->content)
                  ->setGold($row->gold)
                  ->setExperience($row->experience)
                  ->setMonsterlistByRaw($row->monsterlist);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Quest();
            $entry->setId($row->id)
                  ->setTitle($row->title)
                  ->setContent($row->content)
                  ->setGold($row->gold)
                  ->setExperience($row->experience)
                  ->setMonsterlistByRaw($row->monsterlist);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function fetchAllById($ids)
    {
    	$resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Quest();
            $entry->setId($row->id)
                  ->setTitle($row->title)
                  ->setContent($row->content)
                  ->setGold($row->gold)
                  ->setExperience($row->experience)
                  ->setMonsterlistByRaw($row->monsterlist);
            $entries[] = $entry;
        }
        $result = array();
        foreach ($entries as $entry)
        {
        	if(in_array($entry->id, $ids))
        		$result[] = $entry;
        }
        return $result;
    }
    
    public function update(Application_Model_Quest $model)
    {
    	$data = array(
    			'title' => $model->getTitle(),
    			'content' => $model->getContent(),
    			'npc' => $model->getNpc(),
    			'gold' => new Zend_Db_Expr('gold + '.$model->getGold()),
    			'experience' => new Zend_Db_Expr('experience + '.$model->getExperience()),
    			'monsterlist' => $model->getRawMonsterlist()
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

