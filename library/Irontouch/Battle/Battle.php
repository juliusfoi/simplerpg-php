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
	protected $_monster;
	protected $_player;
	private $_monsterMapper;
	private $_playerMapper;
	
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
	}
	
	public function init()
	{
		$this->_playerMapper = $playerMapper = new Application_Model_PlayerMapper();
		$this->_monsterMapper = $monsterMapper = new Application_Model_MonsterInstanceMapper();
		$monster = $monsterMapper->getOriginal($this->_monster);
		
		$playerMapper->find($this->_player->id, $this->_player);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		$this->_monster->health -= (int) $this->_player->attackDamage;
		$this->_player->health -= ($monster->attackDamage * ($this->_player->defense / 100));
		$monsterMapper->save($this->_monster);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		$this->finished = true;
		
		return $this;
	}
	
	public function reward()
	{
		if($this->finished)
		{
			$this->_player->experience += $this->_monster->getHealth() / 10;
			$this->_playerMapper->save($this->_player);
			$this->rewarded = true;
			return $this;
		}
		return $this;
	}
	
	public function getUpdatedValues()
	{
		return array("player" => (array)$this->_player, "monster" => (array)$this->_monster, "rewarded" => $this->rewarded);
	}
}