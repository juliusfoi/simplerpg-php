<?php
namespace Irontouch\Entity;

abstract class EntityMapper
{
	abstract public function setDbTable($dbTable);
	abstract public function getDbTable();
}