<?php

class MonsterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_MonsterMapper();
        $result = $mapper->fetchAll();
        
        $monsters = $result;
        $this->view->monsters = $result;
        $enemies = null;
        foreach($monsters as $result)
        {
        	$enemies[] .= $result->name; 
        }
        $this->view->mjson = Zend_Json::encode((object)$enemies);
    }
    
    public function attackAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$id = $this->_getParam("id", null);
    	if($id == null)
    		return;
    	$monster = new Application_Model_Monster();
    	$player = new Application_Model_Player();
    	$monster->setId($id);
    	$player->setId(1);
    	$battle = new Irontouch_Battle_Battle($player, $monster);
    	$update = $battle->init()->reward()->getUpdatedValues();
    	$this->view->updatedValues = array("updatedValues" => $update);
    }
    
    public function addAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$monster = new Application_Model_Monster();
    	$monster->setName($this->_getParam("name", ""))
    			->setHealth($this->_getParam("health", 0))
    			->setAttackDamage($this->_getParam("attackDamage", 0));
    	$mapper = new Application_Model_MonsterMapper();
    	$mapper->save($monster);
    }


}

