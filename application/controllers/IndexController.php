<?php
/*
 * 	Copyright 2011 by Julius Foitzik
 * 
   	This file is part of SimpleRPG.
 
    SimpleRPG is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SimpleRPG is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SimpleRPG.  If not, see <http://www.gnu.org/licenses/>.
*/


class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$monsterMapper = new Application_Model_MonsterMapper();
		$playerMapper = new Application_Model_PlayerMapper();
		$questInstanceMapper = new Application_Model_QuestInstanceMapper();
		
		$this->view->entries = $monsterMapper->fetchAll();
		$this->view->players = $playerMapper->fetchAll();
		//$this->view->newQuests = count($questInstanceMapper->fetchNew());
		$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
		
		$logger = Zend_Registry::get("logger");
		$logger->log('This is a log message!', Zend_Log::INFO);
		
		$result = $questInstanceMapper->fetchActiveQuests(1);
		
    	$options = $bootstrap->getOptions();
    	$app_secret = $options['security']['cryptography']['app_secret'];
    	$this->view->appsecret = $result;
	}
	
	public function loginAction()
	{
		if($this->_getParam("user"))
		{
			
		}
		else
		{
			$username = $this->_getParam('username');
			$password = $this->_getParam('password');
			if($username == "" || $username == null)
			{
				
			}
			elseif ($password == "" || $password == null)
			{
			}
			else	
			{
				$mapper = new Application_Model_UserMapper();
				$salt = $mapper->findSaltByName($username);
				$user = new Application_Model_User();
				$user->setUsername($username)->hash($password); // fail, really?
				$user->findByName($username);
				
				$auth_adapter = new Irontouch_Auth_LoginAuth($username, $password, $user);
				
				$auth = Zend_Auth::getInstance();
				if( $auth->authenticate($auth_adapter) )
				{
					$this->_redirect(array('controller' => 'index' , 'action' => 'index', 'login' => 'done'));
				}
				else
				{
					$this->_redirect(array('controller' => 'index' , 'action' => 'index', 'login' => 'failed'));
				}
			}
		}
	}
		
	public function designtestAction()
	{
		$this->_helper->layout()->disableLayout();
	}
}



