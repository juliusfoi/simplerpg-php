<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        $view->addHelperPath("Zend/Dojo/View/Helper", "Zend_Dojo_View_Helper");
        $view->addHelperPath("ZendX/jQuery/View/Helper", "ZendX_jQuery_View_Helper");
    }

}

