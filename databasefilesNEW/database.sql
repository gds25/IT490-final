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


