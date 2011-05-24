<?php

class Irontouch_Battle_Battle
{
	protected $_monster;
	protected $_player;
	
	public function __construct(Application_Model_Player $player, Application_Model_Monster $monster)
	{
		if(null == $player || !(get_class($player) == "Application_Model_Player"))
			throw new Exception("No player model");
		else
			$this->_player = $player;
		if(null == $monster || 	!(get_class($monster) == "Application_Model_Monster"))
			throw new Exception("No monster model");
		else
			$this->_monster = $monster;
	}
	
	public function init()
	{
		$playerMapper = new Application_Model_PlayerMapper();
		$monsterMapper = new Application_Model_MonsterMapper();
		
		$playerMapper->find(1, $this->_player);
		$attackDamage = (int) $this->_player->attackDamage;
		
		$this->_monster->health = (-$attackDamage);
		$monsterMapper->update($this->_monster);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		return $this->_monster->health;
	}
}