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
        $quest = new Application_Model_Quest();
    	$mapper = new Application_Model_QuestMapper();
    	$mapper->find($id,$quest);
    	$this->view->quest = $quest;
    }


}



