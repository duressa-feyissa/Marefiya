<?php
// clear all the session variables and redirect to index
session_start();
session_unset();
session_write_close();
$url = "./my-website.php";
header("Location: $url");

?>