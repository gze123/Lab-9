CREATE DATABASE seclub;

USE seclub;

CREATE TABLE members
( userid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  studentid VARCHAR(100) NOT NULL,
  name  VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  birthday DATE,
  event VARCHAR(100)
);