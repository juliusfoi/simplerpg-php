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


class Irontouch_Battle_AttackCommand extends Irontouch_Battle_BattleCommand
{
	public  $_autoRun = true;
	public  $_command = "Attack";
	private $_spellId = 1;
	private $_classBound = false;
	private $_battle;

	public function __construct(Irontouch_Battle_Battle $battle, $autoRun = true)
	{
		$this->_battle = $battle;
		$this->_autoRun = $autoRun;
		if($this->_autoRun)
			$this->run();
	}
	
	public function run()
	{
		$this->onCall();
		$battle = $this->_battle;
		if($battle->_playerMapper && $battle->_monsterMapper)
		{
			if ($battle->_player && $battle->_monster)
			{
				$monster = $battle->_monsterMapper->getOriginal($battle->_monster);
				$battle->_monster->health -= (int) $battle->_player->attackDamage;
				$battle->_player->health -= ($monster->attackDamage * ($battle->_player->defense / 100));
				$battle->_monsterMapper->save($battle->_monster);
				$reward = $this->getRewardClass();
				$reward->run();
			}
			else
				$this->onError("No player or monster found on the main battle class!");
		}
		else
			$this->onError("No playerMapper or monsterMapper found on the main battle class!");
	}
	
	public function onSuccess($message)
	{
	}
	
	public function onError($message)
	{
		throw new Exception($message);
	}
	
	public function onCall()
	{
		return;
	}
	
	public function getRewardClass()
	{
		return new Irontouch_Battle_AttackReward($this->_battle);
	}
	
}