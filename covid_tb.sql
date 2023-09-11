CREATE DATABASE covid19_db;
USE covid19_db;

CREATE TABLE  IF NOT EXISTS covid19_table (
    id int(11) NOT NULL AUTO_INCREMENT,
    enName VARCHAR(50) NOT NULL ,
    cnName VARCHAR(50)NOT NULL ,
    hkID VARCHAR(50) NOT NULL,
    email VARCHAR(30)NOT NULL ,
    phoneNo INT(8)NOT NULL ,
    gender VARCHAR(5)NOT NULL ,
    dob DATE NOT NULL ,
    vaccinationDate DATE NOT NULL ,
    boc VARCHAR(20)NOT NULL ,
    location VARCHAR(30)NOT NULL ,
    PRIMARY KEY (id)
);