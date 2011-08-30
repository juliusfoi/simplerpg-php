<?php 

class Zend_View_Helper_LoadModule extends Zend_View_Helper_Abstract
{
	/*private $_view;
	
	public function setView($view)
	{
		$this->_view = $view;		
	}*/
	
	public function loadModule($moduleName)
	{
		switch($moduleName)
		{
			case 'loginLink':
				return Irontouch_Util_Html::link(array("href" => $this->url(array('action' => 'login', 
																  'controller' => 'index', 'user' => 'yes') , null, true), 
													   "label" => "Login"), "headBarLink");
		}
	}
}