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

class Application_Model_UserMapper extends EntityMapper
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
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
    
	public function save(Application_Model_User $model)
    {
    	$data = array(
    			'username' => $model->getUsername(),
    			'password' => $model->getPassword(),
    			'email'	=> $model->getEmail(),
    			'salt' => $model->getSalt()
    					);
    	if (null === ($id = $model->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
            return $this->getDbTable()->lastInsertId();
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    public function find($id, Application_Model_User $model)
    {
    	$result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $model->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->password)
                  ->setEmail($row->email)
                  ->setSalt($row->salt);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->password)
                  ->setEmail($row->email)
                  ->setSalt($row->salt);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function update(Application_Model_User $model)
    {
    	$data = array(
    			'username' => $model->getUsername(),
    			'password' => $model->getPassword(),
    			'email'	=> $model->getEmail(),
    			'salt' => $model->getSalt()
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
    
    public function findSaltByName($username)
    {
    	$logger = Zend_Registry::get("logger");
		$logger->log("check", Zend_Log::INFO);
    	$table = $this->getDbTable();
    	$row = $table->fetchRow(
			    $table->select()
			        ->where('username = ?', $username)
			    );
		if($row['salt'])
			return $row['salt'];
    }
    
    public function findByName($name, Application_Model_User $model)
    {
    	$table = $this->getDbTable();
    	$row = $table->fetchRow(
			    $table->select()
			        ->where('username = ?', $name)
			    );
		$model->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->password)
                  ->setEmail($row->email)
                  ->setSalt($row->salt);
    }

}

