<?php
  include_once 'database.php';
  session_start();

  $dsn = explode(';', $DB_DSN);
  $db = "camagru";

  $create = "CREATE DATABASE `$db`;";
  $user = "CREATE TABLE `user`(
  `id` int(10) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `username` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `token` varchar(32) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id));
  ALTER TABLE `user` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;";

  $picture = "CREATE TABLE `picture`(
  `id` int(10) NOT NULL,
  `uid` tinytext NOT NULL,
  `user_id` int(10) NOT NULL,
  `likes` text NOT NULL,
  `comments` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (id));
  ALTER TABLE `picture` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;";

  $comment = "CREATE TABLE `comment`(
  `id` int(10) NOT NULL,
  `comment` tinytext CHARACTER SET utf8mb4 NOT NULL,
  `user_id` int(10) NOT NULL,
  `picture_uid` text NOT NULL,
  PRIMARY KEY (id));
  ALTER TABLE `comment` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;";  

  try
  {
    $dbh = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);

    $dbh->exec($create) 
    or die(print_r($dbh->errorInfo(), true));

    try{$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
    catch(Exception $e) { die('Erreur : ' . $e->getMessage());}

    $bdd->exec($user.$picture.$comment) 
    or die(print_r($dbh->errorInfo(), true));
      
    header("location: ../index.php");
  }
  catch (PDOException $e)
  {
    die("DB ERROR: ". $e->getMessage());
  }


?>