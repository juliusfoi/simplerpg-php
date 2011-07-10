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
	   		$storage = new Zend_Auth_Storage_Session();
	        $data = $storage->read();
	        if(!$data){
	        	$request->setControllerName("index");
	        	$request->setActionName("");
	        }
   		}
        //$this->view->username = $data->username;     
   }
}