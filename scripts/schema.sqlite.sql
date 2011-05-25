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
	experience INTEGER
);
 
CREATE INDEX "id" ON "player" ("id");