<?php
session_start();
include('connect.php');

$ProjectID=$_GET['id'];
$StaffID=$_SESSION['AdminID'];

if(!isset($StaffID))
{
	echo"<script>window.alert('Please Login to Continue.')</script>";
	echo"<script>window.location='admin_signin.php'</script>";
}
else
{
	$update="UPDATE Project
		SET p_vetted=True
		WHERE projectID='$ProjectID'";
	$ret=mysql_query($update);
	if($ret)
	{
		echo"<script>window.alert('Project Check Process Completed!')</script>";
		echo"<script>window.location='admin_panel.php'</script>";
	}
	else
	{
		echo"<p>Error in Project Check Process:" .mysql_error(). "</p>";
	}
}
?>
