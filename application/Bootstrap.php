<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
    	$writer = new Zend_Log_Writer_Firebug();
    	$logger = new Zend_Log($writer);
    	Zend_Registry::set("logger", $logger);
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $this->bootstrap('frontController');
        Zend_Controller_Front::getInstance()->registerPlugin(new Application_Plugin_HeadBarPlugin());
        Zend_Controller_Front::getInstance()->registerPlugin(new Application_Plugin_AuthPlugin());
        $view->doctype('HTML5');
        $view->addHelperPath("Zend/Dojo/View/Helper", "Zend_Dojo_View_Helper");
        $view->addHelperPath("ZendX/jQuery/View/Helper", "ZendX_jQuery_View_Helper");
    }

}

