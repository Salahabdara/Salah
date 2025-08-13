<?php
require 'db_config.php';
$pw = '123456'; // default admin password - change after first login
$hash = password_hash($pw, PASSWORD_DEFAULT);
$mysqli->query("UPDATE users SET password_hash='".$mysqli->real_escape_string($hash)."' WHERE username='admin'") or die($mysqli->error);
echo 'Admin password set to 123456. Please delete this file after use.';
?>