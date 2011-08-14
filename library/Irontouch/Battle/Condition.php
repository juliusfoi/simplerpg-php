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
	private $_questMapper;
	private $_questInstances;
	
	public function __construct(Irontouch_Battle_Battle $battle)
	{
		$this->_parent = $battle;
		$this->_questInstanceMapper = new Application_Model_QuestInstanceMapper();
		$this->_questMapper = new Application_Model_QuestMapper();
	}
	
	private function _getQuest()
	{
		$quests = $this->_questInstances;
		$ids = array();
		foreach($quests as $entry)
			$ids[] = $entry->id;
		$quests = $this->_questMapper->fetchAllById($ids);
		return $quests;
	}
	
	private function _getQuestInstance()
	{
		// $player->getActiveQuests()
		if(!$this->_parent->_player)
			throw new Exception("Don't call condition check before initializing the battle");
		else
		{
			$playerId = $this->_parent->_player->id;
			$this->_questInstances = $quests = $this->_questInstanceMapper->fetchByPlayerId($playerId);
			if(empty($quests))
				return;
			else
			{
				return $this->_getQuest();
			}
		}
	}
	
	private function _getMonsterList($quest)
	{
		return $quest->monsterList;
	}
	
	public function checkForConditions()
	{
		$quests = $this->_getQuestInstance();
		foreach($quests as $quest)
		{
			if(in_array($this->_parent->_monster->monsterId, $this->_getMonsterList($quest)))
			{
				foreach($this->_questInstances as $questInstance)
				{
					if($questInstance->questId == $quest->id)
					{
						$questInstance->monsterCount += 1;
						$this->_questInstanceMapper->update($questInstance);
					}
				}
			}
		}
	}
	
}
