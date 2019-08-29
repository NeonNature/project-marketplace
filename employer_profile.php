<?php
session_start();
include('connect.php');

if(!isset($_SESSION['Role']))
{
	echo "<script> window.alert('Please Login to Continue.')</script>";
	echo "<script> window.location='Home.php'</script>";
}
else
{
	if (isset($_GET['id']))
	{
		$employerID=$_GET['id'];
	}
	else
	{
		$employerID="";
	}

	$select="SELECT * FROM Employers
		WHERE employerID='$employerID'";
	$ret=mysql_query($select);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	$Name=$row['e_name'];
	$Address=$row['e_address'];
	$Phone=$row['e_phoneno'];	
	$Eemail=$row['e_email'];
	$Desc=$row['e_desc'];
	$ProfileImage=$row['e_profileimage'];
}
?>
<html>
<head>
	<title>Employer Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div align="center">
			<img src='images/logo.jpg'/>
	</div>	
	<ul>
  		<li><a class="active" href="home.php">Home</a></li>
  		<li><a href="signin.php">Sign In</a></li>
  		<li><a href="student_signup.php">Student Sign Up</a></li>
  		<li><a href="employer_signup.php">Employer Sign Up</a></li>
  		<li><a href="logout.php">Logout</a></li>

	</ul>
<form action="#" method="post">
<table align="center" border="2px" cellpadding="20px">
	<tr align="center"> 
		<td colspan="2">
		<img src="<?php echo $ProfileImage ?>" width="200" height="200"/>
		<?php

		
		if(isset($_SESSION['EmployerID']))
		{
			$eid=$_SESSION['EmployerID'];
		}
		else
		{
			$eid="";
		}

		if ($eid==$employerID)
		{
			echo "<br><a href='update_employer.php?id=$employerID'>
			<img src='images/edit.png' width='20' height='20'/>
			 Edit Profile</a>";
		}
		?>
		</td>
	</tr>
	<tr align="center">
		<td>Name</td>
		<td> <b><?php echo $Name ?></b></td>
	</tr>
	<tr align="center">
		<td>Address</td>
		<td> <b><?php echo $Address ?></b></td>
	</tr>
	<tr align="center">
		<td>Phone</td>
		<td> <b><?php echo $Phone ?></b></td>
	</tr>
	<tr align="center">
		<td><img src="images/email.png" width="50" height="50"</td>
		<td> <b><?php echo $Eemail ?></b></td>
	</tr>
	<tr align="center">
		<td>Description</td>
		<td> <b><?php echo $Desc ?></b></td>
	</tr>

</table>
</form>
</body>
</html>