<?php

	require_once __DIR__ . '/config.php';

	$config = get_db_config();
	$connection = mysqli_connect(
		$config['host'],
		$config['username'],
		$config['password'],
		$config['database'],
		(int) $config['port']
	);	

	if($connection) 
		echo "Database connection established!<br>";
	else
		echo "Database Connection Failed!<br>";
	
	/*
	$sql = "create table if not exists contact(Contactid int auto_increment primary key, Firstname varchar(50) NOT NULL, Surname varchar(50) NOT NULL, Email varchar(50) NOT NULL, Message text, DateSubmitted DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
	*/

/*
	$sql = "create table if not exists safetytip(APPSid int auto_increment primary key, AppName varchar(50) NOT NULL, Description text NOT NULL, Safety_tips text, Features text, Logo text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
	
	*/
/*
	$sql = "create table if not exists parentstip(PtipId int auto_increment primary key, Title varchar(50) NOT NULL, Description text NOT NULL, Tips text, Image text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
*/
	/*
	$sql = "create table if not exists legislation(LegId int auto_increment primary key, Title varchar(50) NOT NULL, Description text NOT NULL, Guidance text NOT NULL, Image text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
*/
	/*
	$sql = "create table if not exists social_media_rankings(RankID int auto_increment primary key, Rank int NOT NULL, AppName varchar(50) NOT NULL, Description text NOT NULL, Features text NOT NULL, Ratings varchar(10) NOT NULL, Image text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ReportLink text NOT NULL)";
*/
/*
	$sql = "create table if not exists livestreaming(LiveID int auto_increment primary key, Title varchar(50) NOT NULL, Description text NOT NULL, List text NOT NULL, Image text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
*/
/*
	$sql = "create table if not exists participate(participateID int auto_increment primary key, name varchar(50) NOT NULL, email varchar(50) NOT NULL, interest varchar(50) NOT NULL, message text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";
*/
	$sql = "create table if not exists socialmeida(participateID int auto_increment primary key, name varchar(50) NOT NULL, email varchar(50) NOT NULL, interest varchar(50) NOT NULL, message text, DateAdded DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Remark text)";

	if(mysqli_query($connection,$sql))
		echo "Social Media Rankings Table is created!<br>";
	else 
		echo "Table creation error!<br>";
	
	/*
	$sql = "create table if not exists usertb(Userid int auto_increment primary key, Firstname varchar(50) NOT NULL, Surname varchar(50) NOT NULL, Gender varchar(10), PhoneNumber varchar (20), DOB DATE, Email varchar(50) NOT NULL, Address text, Username varchar(50) NOT NULL, Password varchar(100) NOT NULL, Country varchar(50) NOT NULL, Profile text, SignupDate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Role varchar(10), Remark text)";
	*/	





?>
