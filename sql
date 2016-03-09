DROP DATABASE IF EXISTS bestWestern;
CREATE DATABASE bestWestern;
use bestWestern;
DROP TABLE IF EXISTS Users;
DROP TABLE  IF EXISTS Messages;
DROP TABLE  IF EXISTS Hostels;
DROP TABLE  IF EXISTS Users_hostels;

CREATE TABLE Users (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    address VARCHAR(80) NOT NULL,
    password BINARY(60) NOT NULL,
    ambassador BOOLEAN NOT NULL DEFAULT FALSE,
    reward INTEGER,
    PRIMARY KEY (id)
);

CREATE TABLE Messages (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    fromUser INTEGER UNSIGNED NOT NULL,
    toUser INTEGER UNSIGNED NOT NULL,
	  content TEXT,
	  FOREIGN KEY (fromUser) REFERENCES Users(id),
	  FOREIGN KEY (toUser) REFERENCES Users(id),
    PRIMARY KEY (id)
);

CREATE TABLE Hostels (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(80) NOT NULL,
    category VARCHAR(80) NOT NULL,
    city VARCHAR(80) NOT NULL,
    zipCode VARCHAR(80) NOT NULL,
    coordx DOUBLE NOT NULL,
    coordy DOUBLE NOT NULL,
    address VARCHAR(80) NOT NULL,
    coord INTEGER NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)
VALUES ("Ducs De Bourgogne","BEST WESTERN ","Paris","75001", "48.85344", "2.33793", "19 Rue Du Pont Neuf", 93530);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)VALUES ("Grand Hotel","BEST WESTERN ","Le Touquet","62520", "50.526834", "1.596451", "4 boulevard de la Canche", 93825);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)VALUES ("Royal Saint Michel","BEST WESTERN PREMIER","Paris","75005", "48.8529", "2.3439", "3, Boulevard Saint Michel", 93599);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)VALUES ("Saint Louis","BEST WESTERN ", "Vincennes","94300", "48.844836", "2.435617", "2 Bis Rue Robert Giraudineau", 93679);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)VALUES ("Rives de Paris La Defense","BEST WESTERN ","Courbevoie","92400", "48.897677", "2.262553", "85 Boulevard Saint-Denis",93838);
INSERT INTO Hostels (name, category, city, zipcode, coordx, coordy, address, coord)VALUES ("Paris Orly Airport","BEST WESTERN ","Rungis","94656", "48.75287", "2.350882", "4 Avenue Charles Lindbergh",93780);
CREATE TABLE Users_hostels (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INTEGER UNSIGNED NOT NULL,
	  hostel_id INTEGER UNSIGNED NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES Users(id),
	FOREIGN KEY (hostel_id) REFERENCES Hostels(id)
);