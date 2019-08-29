<?php
$host="localhost";
$user="root";
$pass="";
$database="marketdb";

$connection=mysql_connect($host,$user,$pass)
or die("Couldn't connnect to database");
mysql_select_db($database);
?>