-- This is the mySQL to create, and recreate if necessary, tables for the capstone projects database.
USE capstone;



CREATE TABLE rss
(
	rssId INT UNSIGNED AUTO_INCREMENT NOT NULL, 
	feed TEXT, 
	feedName VARCHAR(32), 
	PRIMARY KEY(rssId)
);
CREATE TABLE twitterFeed
(
	twitterFeedId INT UNSIGNED AUTO_INCREMENT NOT NULL, -- primary key
	widget TEXT, 
	twitterFeedName VARCHAR(32), 
	PRIMARY KEY(twitterFeedId)
);
CREATE TABLE userRss
(
	rssId INT UNSIGNED NOT NULL, 
	userId INT UNSIGNED NOT NULL, 
	INDEX(userId),
	INDEX(rssId),
	PRIMARY KEY(rssId, userId)
);
CREATE TABLE userTwitterFeed
(
	twitterFeedId INT UNSIGNED NOT NULL, 
	userId INT UNSIGNED NOT NULL, 
	INDEX(userId),
	INDEX(twitterFeedId),
	PRIMARY KEY(twitterFeedId, userId)
);


