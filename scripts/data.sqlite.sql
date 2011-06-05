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

INSERT INTO quests (title, content, npc, experience, gold) VALUES
	('The awakening',
	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
	Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an 
	unknown printer took a galley of type and scrambled it to make a type specimen book. 
	It has survived not only five centuries, but also the leap into electronic typesetting, 
	remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset s
	heets containing Lorem Ipsum passages, and more recently with desktop publishing 
	software like Aldus PageMaker including versions of Lorem Ipsum.',
	1,
	170,
	1);