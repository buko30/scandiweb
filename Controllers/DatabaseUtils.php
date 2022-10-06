<?php

class DatabaseUtils
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect()
    {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = 'giorgi1999';
        $this->dbname = 'productdb';
        $this->charset = 'utf8mb4';

        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}

/*
create database productdb;
create table dvd(
ID int primary key auto_increment,
MB float NOT NULL
);

create table book(
ID int primary key auto_increment,
KG float NOT NULL
);

create table furniture(
ID int primary key auto_increment,
Height float NOT NULL,
Width float NOT NULL,
Length float NOT NULL
);

create table product(
ID int primary key auto_increment,
SKU varchar(255) NOT NULL,
Name varchar(255) NOT NULL,
Price float NOT NULL,
type ENUM('dvd','book','furniture') NOT NULL,
dvdID int,
bookID int,
furnitureID int,
CONSTRAINT FK_product_dvd FOREIGN KEY (dvdID) REFERENCES dvd(ID),
CONSTRAINT FK_product_book FOREIGN KEY (bookID) REFERENCES book(ID),
CONSTRAINT FK_product_furniture FOREIGN KEY (furnitureID) REFERENCES furniture(ID),
UNIQUE(SKU)
);

 */