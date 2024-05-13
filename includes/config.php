<?php
ob_start(); //turns on output buffering 
session_start(); //sessions are ways to save sessions and vars evenafter the browser has been closed

date_default_timezone_set("Africa/Algiers");
//try to connect to the DB
try {
  //connection var, php date obj
  $con = new PDO("mysql:dbname=lydix;host=localhost", "root", ""); //! no password 
  //static prop on PDO called attribute  error mode
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
//if any of that fails it hits this catch bloc 
//$e is a var of the type PDOE, it contains error msgs
catch (PDOException $e) {
  exit("Connection failed:" . $e->getMessage());
}
