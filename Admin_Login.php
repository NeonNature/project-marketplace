<?php
session_start();
include('connect.php');

if(isset($_POST['btnsingin']))
{
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];

	$email=mysql_real_escape_string($email);
	$password=mysql_real_escape_string($password);

	$check="SELECT * FROM Admin
	       WHERE Email='$email'
	       AND Password='$password'";
	$ret=mysql_query($check);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	if($count==0)
	{
		echo "<script>window.alert('Email or Password Incorrect.')</script>";
		echo "<script>window.location='Admin_Login.php'</script>";
	}
	else
	{
		$_SESSION['AdminId']=$row['AdminId'];
		$_SESSION['AdminName']=$row['AdminName'];
		$_SESSION['ProfileImage']=$row['ProfileImage'];
		$AdminName=$_SESSION['AdminName'];
		echo "<script>window.alert('Welcome $AdminName')</script>";
		echo "<script>window.location='Project_Display.php'</script>";
	}
}
$bg=array('bg1.jpg', 'bg2.jpg', 'bg3.jpg', 'bg4.jpg', 'bg5.jpg');
$i=rand(0,count($bg)-1);
$randomBg=$bg[$i];
?>
<html>
<head>
	<title>Admin Login</title>
	<style type="text/css">
	body
	{
		background:url('bg/<?php echo $randomBg ?>')no-repeat;
		background-size:cover;
	}
	</style>
</head>
<body>
<form action="Admin_Login.php" method="post">
	<fieldset class='fieldset'>
<table align="center" cellspacing="8px">
<tr>
	<td>Email :</td>
    <td><input type="email" name="txtemail" placeholder='Enter Email Address' required /></td>
</tr>

<tr>
	<td>Password :</td>
    <td><input type="password" name="txtpassword" placeholder="XXX" required /></td>
</tr>


<tr>
<td></td>
<td><input type='submit'  value='Sign In'  name='btnsingin' />    
<input type='reset' value='Clear'> </td>
</tr>
<tr>
	<td></td>
	<td>
		<p>
			Don't have an account? <a href="admin_signup.php"> Sign Up</a>
			</p>
			</td>
			</tr> 
</table>
</form>
</body>
</html>