<?php
session_start();
include('connect.php');

if(isset($_POST['btnsignin']))
{
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];

	$email=mysql_real_escape_string($email);
	$password=mysql_real_escape_string($password);

	$check="SELECT * FROM Students
			WHERE s_email='$email'
			AND s_password='$password'";

	$ret=mysql_query($check);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	if ($count!==1)
	{
		echo "<script>window.alert('Student Email or Password Incorrect.')</script>";
		echo "<script>window.location='student_signin.php'</script>";
	}
	else
	{
		$_SESSION['StudentID']=$row['studentID'];		
		$_SESSION['StudentName']=$row['s_name'];				
		$_SESSION['ProfileImage']=$row['sprofileimage'];
		$_SESSION['Role']="Student";

		$Name=$_SESSION['s_name'];
		echo "<script> window.alert('Welcome $Name')</script>";
		echo "<script> window.location='project_display.php'</script>";

	}
}


?>

<html>
<head>
	<title>
		Student Sign-In
	</title>
</head>
<body>
	<form action="student_signin.php" method="post">
		<fieldset> 
				<legend>
						 Student Sign-In 
				</legend>
				<table align="center" cellspacing="8">
					<tr>
						<td>
							Email
						</td>
						<td>
							 : <input type="text" name="txtemail" placeholder="Email">
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
		<p> Don't have an account? <a href="student_signup.php"> Sign Up </a> </p>
	</td>
</tr>


</table>
</form>
</fieldset>
</body>
</html>