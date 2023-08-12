<?php
ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

date_default_timezone_set("Asia/Bangkok");
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "test";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset($conn, "utf8");
?>
