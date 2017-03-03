# Shoe Store

#### A Website to keep track of shoe brands and the stores they exist at

#### By Clayton Collins

## Description

This website uses php and a mySQL database to store information about shoe stores and the brands they carry. Users can enter both shoe brands and shoe stores, with the option to update and delete these later.

## Setup/Installation Requirements

* Start a MAMP server for both Apache(8888) and mySQL(8889)
* Configure mySQL to have the proper databases and tables (either using the commands below or the zipped file sql.zip)
* Clone this repository
* In terminal, run 'composer install' in the project root directory
* Navigate your web browser to localhost:8888/


## Backup SQL Commands
* CREATE DATABASE shoes;
* CREATE TABLE stores (id serial primary key, name varchar(255), pricing int, location varchar(255));
* CREATE TABLE brands (id serial primary key, name varchar(255), pricing int);
* CREATE TABLE stores_brands (id serial primary key, store_id int, brand_id int);


## Known Bugs

Currently I cannot successfully get twig to check if a brand is in an array of all of the brands a store carries (and vice versa). I think it has something to do with the comparison not being done correctly (i.e. it is comparing the keys to the values or something similar) but I have not yet thought of a way to solve this.

## Support and contact details

Let me know if you run into any issues or have questions, ideas, or concerns.  Contact me or make a contribution to the code via pull request.

## Technologies Used

Runs using php, mySQL, html, silex, and twig


Copyright (c) 2017 **Clayton C. Collins**
