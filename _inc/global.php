<?php
ini_set('display_errors', '1');





$Salt = "6n3547Ko8I77414vxF8o167V7DE292uS";

include_once('_inc/db.inc.php');
include_once('_inc/core.inc.php');
include_once('_inc/session.inc.php');
include_once('_inc/users.inc.php');

$DB = new db("localhost", "root", "hello", "deejay");
$Core = new core();
$Session = new session();
$Users = new users($DB, $Session, $Salt);