-- This is the mySQL to create, and recreate if necessary, tables for the capstone projects database.
USE capstone;
DROP TABLE IF EXISTS address; -- some drop statements to facilitate recreation of the tables if necessary.  
DROP TABLE IF EXISTS avatar;
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS rss;
DROP TABLE IF EXISTS user;
CREATE TABLE user
(
	email VARCHAR(128) NOT NULL,
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	nonce CHAR(64),
	UNIQUE(email), -- emails are the logins and thus must be unique
	PRIMARY KEY(userId) -- Relations: 1-1 User Profiles, 1-1 Address, 1-n rss, 1-1 Avatar
);

CREATE TABLE address
(
	addressId INT UNSIGNED AUTO_INCREMENT NOT NULL, -- Primary Key
	userId INT UNSIGNED NOT NULL, -- Relation: 1-1 to users
	street1 VARCHAR(64), -- line one of address
	street2 VARCHAR(64), -- line two of address
	city VARCHAR(64),
	state CHAR(2),
	zip CHAR(10),
	PRIMARY KEY(addressId),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(userId)
);

CREATE TABLE avatar
(
	avatarId INT UNSIGNED AUTO_INCREMENT NOT NULL, -- Primary Key
	userId INT UNSIGNED NOT NULL, -- Relation: 1-1 to users
	image MEDIUMBLOB,
	PRIMARY KEY (avatarId),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(userId)
);

CREATE TABLE profile
(
	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL, -- Relation: users 1-1
	firstName VARCHAR(32),   	
	lastName VARCHAR(64),		
	company VARCHAR(32),		
	title VARCHAR(32),			
	PRIMARY KEY(profileId),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(userId)
);

CREATE TABLE rss
(
	rssId INT UNSIGNED AUTO_INCREMENT NOT NULL, -- primary key
	userId INT UNSIGNED NOT NULL, -- Relation: 1-n users->rss
	feedName VARCHAR(32), -- not required
	feedUrl VARCHAR(1024), -- FIXME with earlier DBS may use TEXT for full compatibility
	PRIMARY KEY(rssId),
	INDEX(userId),
	FOREIGN KEY(userId) REFERENCES user(userId)
);