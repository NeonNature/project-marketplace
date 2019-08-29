<?php
session_start();
include('connect.php');
if(isset($_POST['btnsubmit']))
{
if(strcmp($_SESSION['code'],$_POST['code'])!=0)
{
  echo"<script>window.alert('Security does not match!')</script>";
}
else
{
     $sname=$_POST['txtsname'];
     $semail=$_POST['txtsemail'];
     $slocation=$_POST['txtslocation'];
     $sgender=$_POST['rdosgender'];
     $skills=$_POST['txtskills'];
     $workexpdesc=$_POST['txtworkexpdesc'];
     $edudesc=$_POST['txtedudesc'];
     $susername=$_POST['txtsusername'];
     $spassword=$_POST['txtspassword'];



  $Folder="ProfileImage/";

  //----------------------Image Upload-----------------------

  $image=$_FILES['sprofileimage']['name'];
  $size=$_FILES['sprofileimage']['size'];

  if ($size>5000000)
  {
    //-----------Check File Size----------
    echo "<br> The size of Student Profile Image is too large. Maximum ~ 5 MB";
  }

  if ($image)
  {
    $generateid=date('ymdhms');
    $sprofileimage=$Folder.$generateid."_".$image;
    $copied=copy($_FILES['sprofileimage']['tmp_name'], $sprofileimage);
    if (!$copied)
    {
      exit('Error in Student Profile Image Upload.');
    }
  }



     $check="SELECT * FROM Students WHERE s_email='$semail'";
     $checkret=mysql_query($check);
     $count=mysql_num_rows($checkret);

       if($count<>0)
       {
          echo "<script>window.alert('Student Email [ $semail ]Already Exists')</script>";
          echo"<script>window.location='student_signup.php'</script>";
       }
       else
       {
        $insert="INSERT INTO Students
          (s_name, s_email, s_location, s_gender, s_skills, s_workexpdesc, s_edudesc, s_username, s_password, s_profileimage)
          VALUES 
          ('$sname','$semail','$slocation','$sgender','$skills','$workexpdesc','$edudesc','$susername', '$spassword', '$sprofileimage')";

       $insertret=mysql_query($insert);
       if($insertret)
       {
          echo"<script>window.alert('Student Account Created!')</script>";
          echo"<script>window.location='signin.php'</script>";
       }
       else
       {
          echo "<p>Error in Student Registration : " .mysql_error()."</p>";
       }
     }
   }
 }

?>


<html>
<head>
	<title>Student SignUp</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div align="center">
      <img src='images/logo.jpg'/>
  </div>  
  <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="signin.php">Sign In</a></li>
      <li><a class="active" href="student_signup.php">Student Sign Up</a></li>
      <li><a href="employer_signup.php">Employer Sign Up</a></li>
      <li><a href="logout.php">Logout</a></li>

  </ul>
<form action="student_signup.php" method="post" enctype="multipart/formdata">
<fieldset>
<legend>Enter Student information :</legend>
<table align="center" cellspacing="3">

  <tr>
    <td width="145">Name</td>
    <td width="208">
    <input type="text" name="txtsname" placeholder="Enter Name" required/>
    </td>
  </tr>
  
  <tr>
    <td>Email</td>
    <td>
    <input type="text" name="txtsemail" placeholder="Enter Email Address" required/>
    </td>
  </tr>

  <tr>
    <td>Location</td>
    <td>
    <input type="text" name="txtslocation" placeholder="Enter Country Location" required/>
    </td>
  </tr>
  
  <tr>
    <td>Gender</td>
    <td>
    <input type="radio" name="rdosgender"  value="Male" checked />Male
    <input type="radio" name="rdosgender" value="Female" />Female
   </td>
  </tr>
  
  <tr>
    <td>Skills</td>
    <td>
    <textarea name="txtskills" placeholder="Enter Skills"></textarea>
    </td>
  </tr>
  
  <tr>
    <td>Work Experience Description</td>
    <td>
    <textarea name="txtworkexpdesc" placeholder="Enter Work Experience Description"></textarea>
    </td>
  </tr>
  
  <tr>
    <td>Educational Description</td>
    <td>
    <textarea name="txtedudesc" placeholder="Enter Educational Description"></textarea>
    </td>
  </tr>
  
  <tr>
    <td>Username</td>
    <td>
    <input type="text" name="txtsusername" placeholder="Enter Username"  required/>
    </td>
  </tr>

  <tr>
    <td>Password</td>
    <td>
    <input type="password" name="txtspassword" placeholder="********"  required/>
    </td>
  </tr>

  <tr>
    <td>Profile Image</td>
    <td>
    <input type="file" name="sprofileimage" required/>
    </td>
  </tr>
  
  <tr>
    <td colspan="2" align="center">
    <img src="generatecaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg'/>
    <a href='javascript: refreshCaptcha();'>Refresh
    </a>
    <script language='javascript' type='text/javascript'>
	function refreshCaptcha()
	{
		var img =document.images['captchaimg'];
		img.src= img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}	
	</script>
    </td>
  </tr>
  
  <tr>
    <td>Security Answer</td>
    <td>
    <input type="text" name="code" placeholder="Enter Security Answer" required />
    </td>
  </tr>
  
  <tr>
  <td></td>
    <td>
    <input type="submit"  name="btnsubmit"  value="Submit" />
    <input type="reset" value="Clear" class="btn" />
    </td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td colspan=2 align="center">
        <p> Already have an account? <a href="signin.php"> Sign In </a> </p>
    </td>
  </tr>

</table>
</fieldset>
</body>
</html>