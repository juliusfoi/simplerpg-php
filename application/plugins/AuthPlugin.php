<?php

class Application_Plugin_AuthPlugin extends Zend_Controller_Plugin_Abstract
{
   public function preDispatch(Zend_Controller_Request_Abstract $request)
   {
   		if($request->getControllerName() == "webscripts")
   		{
   			return;
   		}
   		else
   		{
   			$auth = Zend_Auth::getInstance();
   			$layout = Zend_Layout::getMvcInstance();
      		$view = $layout->getView();
   			if(!$auth->hasIdentity())
   			{
   				$request->setControllerName("index");
   				$request->setActionName("login");
   				
      			$view->loggedin = false;
   			}
   			else
   				$view->loggedin = true;
   				
	   		//$storage = new Zend_Auth_Storage_Session();
	        //$data = $storage->read();
	        //if(!$data){
	        	// ....
	        //}
   		}
        //$this->view->username = $data->username;     
   }
}