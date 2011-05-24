<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_MonsterMapper();
        $this->view->entries = $mapper->fetchAll();
    }


}

