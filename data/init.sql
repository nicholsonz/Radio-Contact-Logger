CREATE DATABASE contacts
  COLLATE = 'utf8_general_ci';

USE contacts;

CREATE TABLE contacts  (
        id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	callsign VARCHAR(10) NOT NULL,
	frequency FLOAT(6,3),
	offset VARCHAR(10),
	tone FLOAT(4,1),
	name VARCHAR(120),
	email VARCHAR(50),
	phone VARCHAR(10),
	contactdate DATE,
	city VARCHAR(50),
	state VARCHAR(35),
	country VARCHAR(65),
	notes VARCHAR(600) 
);
