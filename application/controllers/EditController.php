<?php

class EditController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function viewarearelationsAction()
    {
    	$mapper = new Application_Model_AreaMapper();
    	$mapEntries = $mapper->fetchAll();
    	$this->view->entries = $mapEntries;
    }


}

