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
		$fname=$_POST['txtfname'];
		$sname=$_POST['txtsurname'];
		$phone=$_POST['txtphone'];
		$Studentemail=$_POST['txtStudentemail'];
		$passowrd=$_POST['txtpassword'];
		$address=$_POST['txtaddress'];
		$dob=date("Y-m-d",strtotime($_POST['txtdob']));
		$gender=$_POST['rdogender'];
		$skills=$_POST['txtskills'];
		$exp=$_POST['txtexp'];
		$edu=$_POST['txtedu'];

		$folder="ProfileImage/";
        //Image1 Upload-----------------------------------------
        $image1=$_FILES['txtimage']['name'];
        $size1=$FILES['txtimage']['size'];

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

		$check="SELECT * FROM Student Where StudentEmail='$email'";
		$checkret=mysql_query($check);
		$count=mysql_num_rows($checkret);

		if($count!==0)
		{
			echo"<script>window.alert('Student Email [$email] Already Exists')</script>";
			echo"<script>window.location='Student_Registration.php'</script>";
		}
		else
		{
			$insert="INSERT INTO Student 
			(Firstname,LastName,Phone,StudentEmail,Password,Address,DOB,Gender,Skills,ExpDescription,EduDescription,ProfileImage)
			VALUES 
			('$fname','$sname','$phone','$email','$passowrd','$address','$dob','$gender','$skills','$exp','$edu','$filename1')";
			echo $insert;
			$insertret=mysql_query($insert);

			if($insertret)
			{
				echo"<script>window.alert('Student Account Created!')</script>";
				echo"<script>window.location='Student_Login.php'</script>";
			}
			else
			{
				echo"<p>Error in Student Registration Page:" .mysql_error()."</p>";
			}
		}
	}
}
?>

<html>
<head>	
<title>Student Registration</title>
<link href="script/DatePicker/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="script/DatePicker/datepicker.js" type="text/jscript"></script>
</head>
<body>
<form action="Student_Registration.php" method="post" enctype="multipart/form-data"/>
<fieldset>
<legend>Enter Student Information :</legend>
<table align="center" cellspacing="3">

<tr>
<td>First Name</td>	
<td>
<input type="text"name="txtfname"placeholder="Enter Name Here"required/>
</td>
</tr>

<tr>
<td>Last Name</td>	
<td>
<input type="text"name="txtsurname"placeholder="Enter SurName Here"required/>
</td>
</tr>

<tr>
<td>Phone</td>	
<td>
<input type="text"name="txtphone"placeholder="+95........."required/>
</td>
</tr>

<tr>
<td>StudentEmail</td>	
<td>
<input type="Studentemail"name="txtstudentemail"placeholder="example@email.com"required/>
</td>
</tr>

<tr>
<td>password</td>	
<td>
<input type="password"name="txtpassword"placeholder="********"required/>
</td>
</tr>

<tr>
<td>Address</td>	
<td>
<input type="text"name="txtaddress"placeholder="[No / Street / Township]"required/>
</td>
</tr>

<tr>
<td>Date Of Birth</td>	
<td>
<input type="text" name="txtdob" value="<?php echo date("d-M-Y")?>" onFocus="showCalender(calender,this)" readonly="true"/>
</td>
</tr>

<tr>
<td>Gender</td>
<td>
<input type="radio" name="rdogender"value="M"/>Male
<input type="radio" name="rdogender"value="F"/>Female
</td>
</tr>

<tr>
	<td>Skills</td>
	<td>
		<textarea name="txtskills" rows="5" cols="20"></textarea>
	</td>
</tr>

<tr>
	<td>Experience Description</td>
		<td>
			<textarea name="txtexp" rows="5" cols="20"></textarea>
		</td>
</tr>

<tr>
	<td>Educational Description</td>
	<td>
		<textarea name="txtedu" rows="5" cols="20"></textarea>
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
<td><a href="Student_signin.php">Login now</a></td>	
<td>
<input type="submit"name="btnsubmit" value ="Submit"/>
<input type="reset"value ="Clear" class ="btn"/>
</td>
</tr>
</table>
</body>
</html>