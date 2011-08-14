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

class Irontouch_Battle_AttackReward implements Irontouch_Battle_BattleReward
{
	private $_battle;
	
	public function __construct(Irontouch_Battle_Battle $battle)
	{
		$this->_battle = $battle;
	}
	
	public function run()
	{
		$this->_battle->_player->experience += $this->_battle->_monster->getHealth() / 10;
		$this->_battle->_playerMapper->save($this->_battle->_player);
		$this->_battle->rewarded = true;
	}
}