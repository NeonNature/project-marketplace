<?php
session_start();
include('connect.php');

if(isset($_POST['btnsignin']))
{
	$username=$_POST['txtusername'];
	$password=$_POST['txtpassword'];

	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);

	$check="SELECT * FROM Students
			WHERE s_username='$username'
			AND s_password='$password'";

	$ret=mysql_query($check);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	
	if ($count==1)
	{
		$_SESSION['StudentID']=$row['studentID'];		
		$_SESSION['Name']=$row['s_name'];				
		$_SESSION['ProfileImage']=$row['s_profileimage'];
		$_SESSION['Role']="Student";

		$Name=$_SESSION['Name'];

		echo "<script> window.alert('Welcome $Name')</script>";
		echo "<script> window.location='project_display.php'</script>";

	}

	//-----------------------------------

	$check="SELECT * FROM Employers
			WHERE e_username='$username'
			AND e_password='$password'";

	$ret=mysql_query($check);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	
	if ($count==1)
	{
		$_SESSION['EmployerID']=$row['employerID'];		
		$_SESSION['Name']=$row['e_name'];				
		$_SESSION['ProfileImage']=$row['e_profileimage'];
		$_SESSION['Role']="Employer";

		$Name=$_SESSION['Name'];

		echo "<script> window.alert('Welcome $Name')</script>";
		echo "<script> window.location='add_project.php'</script>";

	}

	//-----------------------------------

	$check="SELECT * FROM Admin
			WHERE a_username='$username'
			AND a_password='$password'";

	$ret=mysql_query($check);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	
	if ($count==1)
	{
		$_SESSION['AdminID']=$row['adminID'];		
		$_SESSION['Name']=$row['a_username'];

		$Name=$_SESSION['Name'];

		echo "<script> window.alert('Welcome $Name')</script>";
		echo "<script> window.location='admin_panel.php'</script>";

	}

	//------------

	if ($count!==1)
	{
		echo "<script>window.alert('Username or Password Incorrect.')</script>";
		echo "<script>window.location='signin.php'</script>";
	}


}


?>

<html>
<head>
	<title>
		Student Sign-In
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div align="center">
			<img src='images/logo.jpg'/>
	</div>	
	<ul>
  		<li><a href="home.php">Home</a></li>
  		<li><a class="active" href="signin.php">Sign In</a></li>
  		<li><a href="student_signup.php">Student Sign Up</a></li>
  		<li><a href="employer_signup.php">Employer Sign Up</a></li>
  		<li><a href="logout.php">Logout</a></li>

	</ul>
	<form action="signin.php" method="post">
		<fieldset> 
				<legend>
						 Sign-In 
				</legend>
				<table align="center" cellspacing="8">
					<tr>
						<td>
							Username
						</td>
						<td>
							 : <input type="text" name="txtusername" placeholder="Username">
						</td>
					</tr>
			<tr>
				<td>
				 	Password 
				</td>
				<td> : 
 <input type="password" name="txtpassword" placeholder="********" required />
    
</td>
</tr>


<tr align="center">
	<td> </td>
	<td>
		<input type='submit'  name='btnsignin'  value='Sign In' />
	 
		<input type="reset" value="Clear" />
	</td>
</tr>
<tr></tr>
<tr>
	
	<td colspan=2>
		<p> Don't have an account?  Sign Up! <a href="student_signup.php"> Student </a> | <a href="employer_signup.php"> Employer </a> </p>
	</td>
</tr>


</table>
</form>
</fieldset>
</body>
</html>