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

class Irontouch_Battle_Battle
{
	public $finished;
	public $rewarded;
	public $_monster;
	public $_player;
	public $_monsterMapper;
	public $_playerMapper;
	private $_commandProcessList;
	//private $_condition;
	
	public function __construct(Application_Model_Player $player, Application_Model_MonsterInstance $monster)
	{
		if(null == $player || !(get_class($player) == "Application_Model_Player"))
			throw new Exception("No player model");
		else
			$this->_player = $player;
		if(null == $monster || 	!(get_class($monster) == "Application_Model_MonsterInstance"))
			throw new Exception("No monster model");
		else
			$this->_monster = $monster;
		//$this->_condition = new Irontouch_Battle_Condition($this);
	}
	
	public function init()
	{
		$this->_playerMapper = $playerMapper = new Application_Model_PlayerMapper();
		$this->_monsterMapper = $monsterMapper = new Application_Model_MonsterInstanceMapper();
		
		$playerMapper->find($this->_player->id, $this->_player);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		/*$this->_monster->health -= (int) $this->_player->attackDamage;
		$this->_player->health -= ($monster->attackDamage * ($this->_player->defense / 100));
		$monsterMapper->save($this->_monster);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		$this->finished = true;*/
		
		//$this->_condition->checkForConditions();
		
		return $this;
	}
	
	public function processCommands($commandList)
	{
		foreach ($commandList as $command) 
		{
			$this->_commandProcessList = new $command['name']($this, $command['autoRun']);
		}
		//$command = new Irontouch_Battle_AttackCommand($this);
	}
	
	public function checkConditions()
	{
		$conditions = new Irontouch_Battle_Condition($this);
		$conditions->checkForConditions();
	}
	
	public function getUpdatedValues()
	{
		return array("player" => (array)$this->_player, "monster" => (array)$this->_monster, "rewarded" => $this->rewarded);
	}
}