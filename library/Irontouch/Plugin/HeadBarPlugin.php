<?php
class Zend_Controller_HeadBarPlugin extends Zend_Controller_Plugin_Abstract
{
   public function preDispatch(Zend_Controller_Request_Abstract $request)
   {
      $layout = Zend_Layout::getMvcInstance();
      $view = $layout->getView();
	  $questInstanceMapper = new Application_Model_QuestInstanceMapper(); 
      $view->newQuests = count($questInstanceMapper->fetchNew());  
   }
	
}