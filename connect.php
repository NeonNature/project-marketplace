<?php
$host="localhost";
$user="root";
$pass="";
$database="projectmarketdb";
 
$connection=mysql_connect($host,$user,$pass)
			OR die ("Couldn't connect to the database!");

mysql_select_db ($database);

?>

