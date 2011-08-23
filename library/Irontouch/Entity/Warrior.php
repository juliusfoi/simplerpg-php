<?php 

namespace Irontouch\Entity;

class Warrior
{
	public function __construct()
	{
		$this->health = 4500;
		$this->mana = 100;
		$this->attackDamage = 47;
		$this->defense = 63;
	}
}