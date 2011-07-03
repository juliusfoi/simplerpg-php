<?php

class QuestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$quest = new Application_Model_Quest();
    	$mapper = new Application_Model_QuestMapper();
    	$mapper->find(1,$quest);
    	$this->view->quest = $quest;
    }

    public function viewAction()
    {
    	$id = $this->_getParam("id");
    	$questInstanceMapper = new Application_Model_QuestInstanceMapper();
    	$quest = new Application_Model_QuestInstance();
    	if($questInstanceMapper->find($id, $quest))
    	{
	        $quest = new Application_Model_Quest();
	    	$mapper = new Application_Model_QuestMapper();
	    	$mapper->find($id,$quest);
	    	$this->view->quest = $quest;
    	}
    	else
    	{
    		$this->view->alreadyAccepted = true;
    	}
    }
    
    public function acceptAction()
    {
    	$id = $this->_getParam("id");
    	$playerId = $this->_getParam("playerId");
    	$questInstanceMapper = new Application_Model_QuestInstanceMapper();
    	$quest = new Application_Model_QuestInstance();
    	$quest->setPlayerId($playerId)
    			->setQuestId($id)
    			->setMonsterCount(0)
    			->setObjectiveStatus(0)
    			->setStatus("accepted");
    	$questInstanceMapper->save($quest);
    	$this->_redirect(array('action' => 'index', 'controller' => 'index'));
    	
    }


}



