<?php

class PlayerController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
	}

	public function profileAction()
	{
		$id = $this->_getParam("id", 1);
		$player = new Application_Model_Player();
		$mapper = new Application_Model_PlayerMapper();
		$mapper->find($id, $player);
		$this->view->player = $player;
	}
	
	public function travelAction()
	{
		$locations = array(1, 2, 3, 4, 5, 6);
		$this->_helper->layout()->disableLayout();
		$areaId = $this->_getParam("to", 1);
		if(in_array($areaId, $locations))
		{
			$player = new Application_Model_Player();
			$mapper = new Application_Model_PlayerMapper();
			$id = 1;
			$player->setId($id);
			$player->setAreaId($areaId);
			$mapper->update($player);
			$this->view->jsonresponse = array("traveled" => true);
		}
		else
			$this->view->jsonresponse = array("traveled" => false);
	}
	
	public function healAction()
	{
		$this->_helper->layout()->disableLayout();
		$player = new Application_Model_Player();
		$mapper = new Application_Model_PlayerMapper();
		$id = 1;
		$player->setId($id);
		$amount = 100;
		$player->setHealth($amount);
		$mapper->update($player);
		$this->view->jsonresponse = array("healed" => true, "amount" => $amount);
	}
	
	public function homeAction()
	{
		$player = new Application_Model_Player();
		$mapper = new Application_Model_PlayerMapper();
		$id = 1;
		$mapper->find($id, $player);
		$this->view->player = (object) $player;
	}


}

