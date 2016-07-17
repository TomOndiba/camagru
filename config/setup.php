<?php
  include_once 'database.php';
  session_start();

  $dsn = explode(';', $DB_DSN);
  $db = "camagru";

  $create = "CREATE DATABASE `$db`;";
  $instruc = "CREATE TABLE `user`(
  `id` int(10) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `token` varchar(32) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id));
  ALTER TABLE `user` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;";

  try
  {
    $dbh = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);

    $dbh->exec($create) 
    or die(print_r($dbh->errorInfo(), true));

    try{$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
    catch(Exception $e) { die('Erreur : ' . $e->getMessage());}

    $bdd->exec($instruc) 
    or die(print_r($dbh->errorInfo(), true));

    header("location: ../../index.php");
  }
  catch (PDOException $e)
  {
    die("DB ERROR: ". $e->getMessage());
  }


?>