----------------------
-- Apoidea Database --
----------------------
------------------------------------------
-- mysql -u webuser -p < bd_apoidea.sql --
------------------------------------------

drop database apoidea;
create database apoidea;
use apoidea;

create table tribe (
	id tinyint unsigned not null unique auto_increment,
	name varchar(255),
	primary key (id)
);

insert into tribe values ('1', 'Administrator');
insert into tribe values ('2', 'Manager');
insert into tribe values ('3', 'Publisher');
insert into tribe values ('4', 'Editor');
insert into tribe values ('5', 'Author');
insert into tribe values ('6', 'User');

create table user (
	id smallint unsigned not null unique auto_increment,
	tribeID tinyint unsigned not null,
	name varchar(255),
	username varchar(255) not null,
	password varchar(255) not null,
	primary key (id),
	key (tribeID)
);

insert into user values ('1', '1', 'Nuno Barreto', 'nbarr', '78b21db081f166277f645bf06131a8a1');

create table category (
	id smallint unsigned not null unique auto_increment,
	parentCategoryID smallint unsigned,
	name varchar(255) not null,
	stub varchar(255) not null,
	active bool,
	feed bool,
	primary key (id),
	key (parentCategoryID)
);

create table feed (
	id bigint unsigned not null unique auto_increment,
	title varchar(255),
	description varchar(255),
	siteUrl varchar(255),
	feedUrl varchar(255),
	language varchar(255),
	publishDate datetime,
	lastBuildDate datetime,
	author varchar(255),
	ttl int unsigned,
	primary key (id),
	index (title)
);

create table repository (
	id bigint unsigned not null unique auto_increment,
	feedID bigint unsigned,
	title varchar(255),
	url varchar(255),
	description blob,
	publishDate datetime,
	author varchar(255),
	category varchar(255),
	guid varchar(255),
	primary key (id),
	key (feedID),
	index (publishDate)
);

create table enclosure (
	id bigint unsigned not null unique auto_increment,
	repositoryID bigint unsigned,
	mimeType varchar(255),
	length varchar(255),
	url varchar(255),
	primary key (id),
	key (repositoryID)
);

create table article (
	id mediumint unsigned not null unique auto_increment,
	creationDate timestamp,
	title varchar(255),
	text blob,
	active bool,
	primary key (id)
);

create table tag (
	id mediumint unsigned not null unique auto_increment,
	name varchar(255) not null unique,
	primary key (id)
);

create table comment (
	id mediumint unsigned not null unique auto_increment,
	articleID mediumint unsigned,
	date timestamp,
	title varchar(255),
	text blob,
	name varchar(255),
	email varchar(255),
	link varchar(255),
	active bool,
	primary key (id),
	key (articleID)
);

