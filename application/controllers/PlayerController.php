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
		$this->_helper->layout()->disableLayout();
		$destination = $this->_getParam("to", "home");
		$player = new Application_Model_Player();
		$mapper = new Application_Model_PlayerMapper();
		$id = 1;
		$player->setId($id);
		$player->setLocation($destination);
		$mapper->update($player);
		$this->view->jsonresponse = array("traveled" => true);
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


}

