<?php
$DB_HOST = 'localhost';
$DB_USER = 'your_db_user';
$DB_PASS = 'your_db_pass';
$DB_NAME = 'your_db_name';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) { die('DB connection failed: '.$mysqli->connect_error); }
?>