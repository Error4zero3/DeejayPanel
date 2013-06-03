<?php
ini_set('display_errors', '1'); // Set as 1 for debug


$Mysql = array("localhost", "root", "hello", "deejay"); // Change to your MySQL details format -> hostname, username, password, database
$Radio = array("109.73.71.126", "8000"); // Change to your radio ip and port format-> IP, Port
$Salt = "6n3547Ko8I77414vxF8o167V7DE292uS"; // Change this for password hashing security







// DO NOT EDIT BELOW //

include_once('_inc/db.inc.php');
include_once('_inc/core.inc.php');
include_once('_inc/session.inc.php');
include_once('_inc/users.inc.php');

$DB = new db($Mysql[0], $Mysql[1], $Mysql[2], $Mysql[3]);
$Core = new core();
$Session = new session();
$Users = new users($DB, $Session, $Salt);