/*Create the database if it doesnt exist*/
CREATE DATABASE `COP4331`;

/*Set as the current database*/
USE `COP4331`;


/*If the user table already exists drop the table*/
DROP TABLE IF EXISTS 'Users';


/*Create the users table*/

CREATE TABLE Users(
    ID int NOT NULL AUTO_INCREMENT,
    FirstName varchar(50) NOT NULL DEFAULT '',
    LastName varchar(50) NOT NULL DEFAULT '',
    Username varchar(50) NOT NULL DEFAULT '',
    Password varchar(50) NOT NULL DEFAULT '',
    PRIMARY KEY (ID)
);

/*If the Contacts table already exists drop the table.*/
DROP TABLE IF EXISTS `Contacts`;

/*Create the contacts table*/

CREATE TABLE Contacts(
    ID int NOT NULL AUTO_INCREMENT,
    FirstName varchar(50) NOT NULL DEFAULT '',
    LastName varchar(50) NOT NULL DEFAULT '',
    PhoneNumber varchar(50) NOT NULL DEFAULT '',
    EmailAddress varchar(50) NOT NULL DEFAULT '',
    UserID int NOT NULL DEFAULT '0',
    FOREIGN KEY (UserID) REFERENCES Users(ID),
    PRIMARY KEY (ID)
);



