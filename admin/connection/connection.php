<?php
$db_host = ""; //localhost server 
$db_user = "";	//database username
$db_password = "";	//database password 
$db_name = "";
try {
	$db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOEXCEPTION $e) {
	$e->getMessage();
}
