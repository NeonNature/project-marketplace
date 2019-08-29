<?php
session_start();
include('connect.php');

if(isset($_POST['btnsubmit']))
{
	if(strcmp($_SESSION['code'],$_POST['code'])!=0)
	{
		echo"<script>window.alert('Security Does Not match')</script>";
	}
	else
	{
		$comname=$_POST['txtcomname'];
		$address=$_POST['txtaddress'];
		$comdescription=$_POST['txtcomdescription'];
		$employeremail=$_POST['txtemployeremail'];
		$password=$_POST['txtpassword'];
		$phone=$_POST['txtphone'];

		$folder="Profileimage/";
        //Image1 Upload-----------------------------------------
        $image1=$_FILES['txtimage']['name'];
        $size1=$_FILES['txtimage']['size'];

		if($size1>5000000)
		{
			//Check File Size
		}
		if($image1)
		{
			$generateid=date('ymdhms');
			$filename1=$folder.$generateid."_".$image1;
			$copied=copy($_FILES['txtimage']['tmp_name'],$filename1);
			if(!$copied)
			{
			exit('Error in ProfileImage Upload.');
			}
		}

		$check="SELECT * FROM Employer Where employeremail='$employeremail'";
		$checkret=mysql_query($check);
		$count=mysql_num_rows($checkret);

		if($count!==0)
		{
			echo"<script>window.alert('EmployerEmail $employeremail Already Exists')</script>";
			echo"<script>window.location='Employer_Registration.php'</script>";
		}
		else
		{
			$insert="INSERT INTO Employer
			(Companyname,Address,Companydescription,EmployerEmail,Password,Phone,ProfileImage)
			VALUES 
			('$comname','$address', '$comdescription', '$employeremail','$password','$phone','$filename1')";

			$insertret=mysql_query($insert);

			if($insertret)
			{
				echo"<script>window.alert('Employer Account Created!')</script>";
				echo"<script>window.location='Employer_Login.php'</script>";
			}
			else
			{
				echo"<p>Error in Employer Registration Page:" .mysql_error()."</p>";
			}
		}
	}
}
?>

<html>
<head>	
<title>EmployerRegistration</title>
<link href="script/DatePicker/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="script/DatePicker/datepicker.js" type="text/jscript"></script>
</head>
<body>
<form action="Employer_Registration.php" method="post" enctype="multipart/form-data"/>
<fieldset>
<legend>Enter Employer Information :</legend>
<table align="center" cellspacing="3">

<tr>
<td>Company Name</td>	
<td>
<input type="text"name="txtcomname"placeholder="Enter Name Here"required/>
</td>
</tr>

<tr>
<td>Address</td>	
<td>
<input type="text"name="txtaddress"placeholder="[No / Street / Township]"required/>
</td>
</tr>

<tr>
<td>Company Description</td>	
<td>
<input type="text" name="txtcomdescription"placeholder="[No / Street / Township]"required/>
</td>
</tr>

<tr>
<td>EmployerEmail</td>	
<td>
<input type="employeremail" name="txtemployeremail"placeholder="example@email.com"required/>
</td>
</tr>

<tr>
<td>password</td>	
<td>
<input type="password" name="txtpassword"placeholder="********"required/>
</td>
</tr>

<tr>
<td>Phone</td>	
<td>
<input type="text" name="txtphone"placeholder="+95........."required/>
</td>
</tr>

<tr>
	<td>Profile Image</td>
	<td>
		<input type="file" name="txtimage" required/>
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
	<img src="generatecaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg'/>
	<a href="javascript: refreshCaptcha();">Refresh<a/>
	<script language="javascript" type="text/javascript">
	function refreshCaptcha() 
	{
		var img =document.images['captchaimg'];	
		img.src=img.src.substring(0,img.src.lastIndexOf("?"))+"?rand"+Math.random()*1000;
	}
	</script>
	</td>
</tr>
<tr>
<td>Security Answer:</td>	
<td>
<input type="text"name="code"id ="code" placeholder="Enter Securtiy Answer"required/>
</td>
</tr>
<br></br>
<tr>
<td><a href="Employer_signin.php">Login now</a></td>	
<td>
<input type="submit"name="btnsubmit" value ="Submit"/>
<input type="reset"value ="Clear" class ="btn"/>
</td>
</tr>
</table>
</body>
</html>