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
		$destination = $this->_getParam("to", "home");
		$player = new Application_Model_Player();
		$mapper = new Application_Model_PlayerMapper();
		$id = 1;
		$player->setId($id)->setLocation($destination);
		$mapper->update($player);
		$this->view->json_response = true;
	}


}

