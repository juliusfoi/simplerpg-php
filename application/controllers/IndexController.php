<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $monsterMapper = new Application_Model_MonsterMapper();
        $playerMapper = new Application_Model_PlayerMapper();
        
        $this->view->entries = $monsterMapper->fetchAll();
        $this->view->players = $playerMapper->fetchAll();
    }


}

