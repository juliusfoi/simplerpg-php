<?php 

namespace Irontouch\Entity;

class Hero
{
	public $health;
	public $mana;
	public $attackDamage;
	public $defense;
	
	public function __construct($health = null, $mana = null, $attackDamage = null, $defense = null)
	{
		$this->health = $health;
		$this->mana = $mana;
		$this->attackDamage = $attackDamage;
		$this->defense = $defense;
	}
}