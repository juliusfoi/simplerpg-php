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


class UserController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function createAction()
	{
		if($this->getRequest()->isPost())
		{
			$userMapper = new Application_Model_UserMapper();
			$user = new Application_Model_User();
			$user->setUsername($this->_getParam('username'))
				 ->setEmail($this->_getParam('email'))
				 ->setPassword($this->_request->getParam('password'))
				 ->setSalt('123');
			$userId = $userMapper->save($user);
			$playerMapper = new Application_Model_PlayerMapper();
			$player = new Application_Model_Player();
			$player->setAreaId(1)
				   ->setAttackDamage(10)
				   ->setDefense(10)
				   ->setExperience(0)
				   ->setHealth(100)
				   ->setHero($this->_getParam('class'))
				   ->setMana(100)
				   ->setName($this->_getParam('heroname'))
				   ->setId($userId);				 
			$this->_redirect(array("controller" => "edit", "action" => "viewarearelations"));
		}
		else
		{
			//$this->_redirect(array("controller" => "edit", "action" => "viewarearelations"));
		}
	}
}