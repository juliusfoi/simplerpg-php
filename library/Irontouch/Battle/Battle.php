<?php

class Irontouch_Battle_Battle
{
	public $finished;
	public $rewarded;
	protected $_monster;
	protected $_player;
	private $_monsterMapper;
	private $_playerMapper;
	
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
		$this->_playerMapper = $playerMapper = new Application_Model_PlayerMapper();
		$this->_monsterMapper = $monsterMapper = new Application_Model_MonsterMapper();
		
		$playerMapper->find($this->_player->id, $this->_player);
		$monsterMapper->find($this->_monster->id, $this->_monster);
		
		$this->_monster->health -= (int) $this->_player->attackDamage;
		$this->_player->health -= (int) $this->_monster->attackDamage;
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