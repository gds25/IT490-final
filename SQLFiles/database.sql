CREATE DATABASE IF NOT EXISTS animeDatabase;

USE animeDatabase;

CREATE TABLE IF NOT EXISTS Users (
	ID int NOT NULL UNIQUE  AUTO_INCREMENT,
	username varchar(255) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	firstName varchar(255) NOT NULL,
	lastName varchar(255) NOT NULL,
	email varchar(255) NOT NULL UNIQUE,
	Primary Key (ID)
);

CREATE TABLE IF NOT EXISTS Shows (
	ID int NOT NULL UNIQUE AUTO_INCREMENT,
	showID int NOT NULL UNIQUE,
	rating int,
	Primary Key(ID)
);

CREATE TABLE IF NOT EXISTS anime (
	mal_id varchar(255) NOT NULL, 
	title varchar(255) NOT NULL, 
	img varchar(255) NOT NULL, 
	rating varchar(255) DEFAULT NULL, 
	genre varchar(255) DEFAULT NULL, 
	trailer varchar(255) DEFAULT NULL, 
	synopsis varchar(255) DEFAULT NULL
);


