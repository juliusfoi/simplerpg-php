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
	}


}



