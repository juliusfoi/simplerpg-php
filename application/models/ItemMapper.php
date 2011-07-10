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
use Irontouch\Entity\EntityMapper;

class Application_Model_ItemMapper extends EntityMapper
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
            $this->setDbTable('Application_Model_DbTable_Item');
        }
        return $this->_dbTable;
    }
    
	public function save(Application_Model_Item $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'type' => $model->getType(),
    			'damage' => $model->getDamage(),
    			'defense' => $model->getDefense(),
    			'image' => $model->getImage(),
    			'requirement' => $model->getRequirement(),
    			'craftable' => $model->getCraftable(),
    			'buyable' => $model->getBuyable(),
    			'dropable' => $model->getDropable()
    					);
    	if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_Item $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setName($row->name)
                  ->setType($row->type)
                  ->setAttackDamage($row->damage)
                  ->setDefense($row->defense)
                  ->setImage($row->image)
                  ->setRequirement($row->requirement)
                  ->setCraftable($row->craftable)
                  ->setBuyable($row->buyable)
                  ->setDropable($row->dropable);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Item();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setType($row->type)
                  ->setAttackDamage($row->damage)
                  ->setDefense($row->defense)
                  ->setImage($row->image)
                  ->setRequirement($row->requirement)
                  ->setCraftable($row->craftable)
                  ->setBuyable($row->buyable)
                  ->setDropable($row->dropable);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function update(Application_Model_Item $model)
    {
    	$data = array(
    			'name' => $model->getName(),
    			'type' => $model->getType(),
    			'damage' => $model->getDamage(),
    			'defense' => $model->getDefense(),
    			'image' => $model->getImage(),
    			'requirement' => $model->getRequirement(),
    			'craftable' => $model->getCraftable(),
    			'buyable' => $model->getBuyable(),
    			'dropable' => $model->getDropable()
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

