CREATE DATABASE hw1_db;
USE hw1_db;

CREATE TABLE users(
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;

CREATE TABLE hotels(
    id integer primary key auto_increment,
    user_id integer not null,
    foreign key (user_id) references users(id),
    hotel_id varchar(255),
    content json
) Engine = INNODB;

CREATE TABLE postes(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	user_id INTEGER NOT NULL,
	FOREIGN KEY(user_id) REFERENCES users(id),
	photo VARCHAR(255) NOT NULL,
	name VARCHAR(255) NOT NULL unique,
	rating INTEGER NOT null,
	address VARCHAR(255) NOT NULL,
	description LONGTEXT 
) ENGINE = INNODB;