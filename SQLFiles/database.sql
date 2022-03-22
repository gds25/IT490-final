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
	ID int NOT NULL UNIQUE AUTO_INCREMENT,
	mal_id varchar(255) NOT NULL UNIQUE, 
	title varchar(255) NOT NULL, 
	img varchar(255) NOT NULL, 
	rating varchar(255) DEFAULT NULL, 
	genre varchar(255) DEFAULT NULL, 
	trailer varchar(255) DEFAULT NULL, 
	synopsis text(16777215) DEFAULT NULL,
	userRatings int DEFAULT 0, 
	Primary Key(ID)
);

CREATE TABLE IF NOT EXISTS topAnime (
        ID int NOT NULL UNIQUE AUTO_INCREMENT,
        mal_id varchar(255) NOT NULL UNIQUE,
        title varchar(255) NOT NULL,
        img varchar(255) NOT NULL,
        rating varchar(255) DEFAULT NULL,
        genre varchar(255) DEFAULT NULL,
        trailer varchar(255) DEFAULT NULL,
        synopsis text(16777215) DEFAULT NULL,
        userRatings int DEFAULT 0,
        Primary Key(ID)
);

create table if not exists threads(
    thread_id int not null unique auto_increment,
    thread_title varchar (150) not null,
    thread_time datetime not null,
    thread_owner varchar (150) not null,
    Primary Key(thread_id)
);

create table if not exists posts (
    post_id int not null unique auto_increment,
    thread_id int not null,
    post_content text(16777215) not null,
    post_time datetime not null,
    post_owner varchar (150) not null,
    Primary Key(post_id)
);

create table if not exists reviews (
    review_id int not null unique auto_increment,
    mal_id int not null,
    review_content text(16777215) not null,
    review_time datetime not null,
    review_owner varchar (150) not null,
    Primary Key(review_id)
    );



