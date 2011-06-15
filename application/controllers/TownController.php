<?php

class TownController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function tavernAction()
    {
        $mapper = new Application_Model_NpcMapper();
        $npcs = $mapper->fetchAll();
        $this->view->npcs = $npcs;
    }

    public function blacksmithAction()
    {
        // action body
    }


}





