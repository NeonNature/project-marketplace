<?php
session_start();
include('connect.php');

$EmployerID=$_SESSION['EmployerID'];

if (isset($EmployerID))
{
	$ProjectID=$_GET['pid'];
	$StudentID=$_GET['sid'];

	$check="SELECT * FROM Project
			WHERE employerID='$EmployerID'
			AND projectID='$ProjectID'";

	$check_ret=mysql_query($check);
	$count=mysql_num_rows($check_ret);

	if ($count==0)
	{
		echo "<script>window.alert('Invalid request')</script>";
		echo "<script>window.location='project_display.php'</script>";
	}
	else
	{
		$update_p="UPDATE Project
					SET p_status='Accepted'
					WHERE projectID='$ProjectID'
					AND employerID='$EmployerID'";
		$ret=mysql_query($update_p); 

		$update_app="UPDATE Application
					SET acceptedstatus='Accepted'
					WHERE projectID='$ProjectID'
					AND studentID='$StudentID'";
		$ret=mysql_query($update_app);

		if ($ret)
		{
			echo "<script>window.alert('Accepted Candidate!')</script>";
			echo "<script>window.location='project_display.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please Login as Employer to Continue')</script>";
	echo "<script>window.location='signin.php'</script>";
}
?>