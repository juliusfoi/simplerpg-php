-- scripts/data.sqlite.sql
--
-- You can begin populating the database with the following SQL statements.
 
INSERT INTO player (name, hero, health, mana, attackDamage, defense, experience, location) VALUES
	('defaultPlayer',
	'Warrior',
	500,
	50,
	37,
	20,
	0,
	'DarkForest');
	
INSERT INTO monster (name, health, attackDamage, location) VALUES
	('defaultMonster',
	500,
	50,
	'DarkForest');