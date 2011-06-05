-- scripts/schema.sqlite.sql
--
-- You will need load your database schema with this SQL.
 
CREATE TABLE player (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(32) NOT NULL,
	hero VARCHAR(32),
	health INTEGER,
	mana INTEGER,
	attackDamage INTEGER,
	defense INTEGER,
	experience INTEGER,
	location VARCHAR(32)
);
 
CREATE INDEX "id" ON "player" ("id");


CREATE TABLE monster (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(32) NOT NULL,
	health INTEGER,
	attackDamage INTEGER,
	location VARCHAR(32)
);

CREATE TABLE quests (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	title VARCHAR(32) NOT NULL,
	content TEXT,
	npc INTEGER,
	experience INTEGER,
	gold INTEGER
);
	