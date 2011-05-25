<?php

class WebscriptsController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        $this->_response->setBody(file_get_contents(APPLICATION_PATH.'/webscripts/battle.js'));
    }
    
    public function getscriptAction()
    {
    	$this->_response->setBody(file_get_contents(APPLICATION_PATH.'/webscripts/'.$this->_getParam('script', 'no script found')));
    }


}

