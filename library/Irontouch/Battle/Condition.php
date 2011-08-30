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

class Irontouch_Battle_Condition
{
	private $_parent;
	private $_questInstanceMapper;
	private $_questInstances;
	
	public function __construct(Irontouch_Battle_Battle $battle)
	{
		$this->_parent = $battle;
		$this->_questInstanceMapper = new Application_Model_QuestInstanceMapper();
	}
	private function _retrieveQuestInstances()
	{
		// $player->getActiveQuests()
		if(!$this->_parent->_player)
			throw new Exception("Don't call condition check before initializing the battle");
		else
		{
			$playerId = $this->_parent->_player->id;
			$this->_questInstances = $this->_questInstanceMapper->fetchActiveQuests($playerId);
		}
	}
	
	public function checkForConditions()
	{
		$this->_retrieveQuestInstances();
		foreach($this->_questInstances as $quest)
		{
			if(!empty($quest->monsterlist))
			{
				if(in_array($this->_parent->_monster->id, $quest->monsterlist))
				{
					$quest->monsterCount++;
					$quest->monsterlist = null;
				}
			}
			else
				if($quest->monsterlist == null)
					throw new Exception("The quest has no monsterlist. 
										 The Model should contain at least a monsterlist list of type array 
										 and should be empty if no monsters are required to kill");
		}
		$this->_questInstanceMapper->increaseMany($this->_questInstances, "monsterCount", 1);
	}
	
}
