CREATE DATABASE sensor_data;

USE sensor_data;

CREATE TABLE sensor (
sensor_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name varchar(4),
location varchar(16),
description varchar(20)
);

CREATE TABLE raw_data (
data_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
sensor_ID int,
data_entry int, 
time_stamp datetime 
);

ALTER TABLE raw_data ADD CONSTRAINT sens FOREIGN KEY raw_data(sensor_ID) REFERENCES sensor(sensor_ID);