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
     $ename=$_POST['txtename'];     
     $eaddress=$_POST['txteaddress'];     
     $ephoneno=$_POST['txtephoneno'];
     $email=$_POST['txteemail'];
     $edesc=$_POST['txtedesc'];
     $eusername=$_POST['txteusername'];
     $epassword=$_POST['txtepassword'];



  $Folder="ProfileImage/";

  //----------------------Image Upload-----------------------

  $image=$_FILES['eprofileimage']['name'];
  $size=$_FILES['eprofileimage']['size'];

  if ($size>5000000)
  {
    //-----------Check File Size----------
    echo "<br> The size of Employer Profile Image is too large. Maximum ~ 5 MB";
  }

  if ($image)
  {
    $generateid=date('ymdhms');
    $eprofileimage=$Folder.$generateid."_".$image;
    $copied=copy($_FILES['eprofileimage']['tmp_name'], $eprofileimage);
    if (!$copied)
    {
      exit('Error in Employer Profile Image Upload.');
    }
  }



     $check="SELECT * FROM Employers WHERE e_email='$email'";
     $checkret=mysql_query($check);
     $count=mysql_num_rows($checkret);

       if($count<>0)
       {
          echo "<script>window.alert('Employer Email [ $email ] Already Exists')</script>";
          echo"<script>window.location='employer_signup.php'</script>";
       }
       else
       {
        $insert="INSERT INTO Employers
          (e_name, e_address, e_phoneno, e_email, e_desc, e_username, e_password, e_profileimage)
          VALUES 
          ('$ename','$eaddress','$ephoneno','$email','$edesc','$eusername', '$epassword', '$eprofileimage')";

       $insertret=mysql_query($insert);
       if($insertret)
       {
          echo"<script>window.alert('Employer Account Created!')</script>";
          echo"<script>window.location='signin.php'</script>";
       }
       else
       {
          echo "<p>Error in Employer Registration : " .mysql_error()."</p>";
       }
     }
   }
 }

?>


<html>
<head>
	<title>Employer SignUp</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div align="center">
      <img src='images/logo.jpg'/>
  </div>  
  <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="signin.php">Sign In</a></li>
      <li><a href="student_signup.php">Student Sign Up</a></li>
      <li><a class="active" href="employer_signup.php">Employer Sign Up</a></li>
      <li><a href="logout.php">Logout</a></li>

  </ul>
<form action="employer_signup.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Enter Employer information :</legend>
<table align="center" cellspacing="3">

  <tr>
    <td width="145">Name</td>
    <td width="208">
    <input type="text" name="txtename" placeholder="Enter Employer or Company Name" required/>
    </td>
  </tr>

  <tr>
    <td>Address</td>
    <td>
    <input type="text" name="txteaddress" placeholder="Enter Employer or Company Location" required/>
    </td>
  </tr>

  <tr>
    <td>Phone No.</td>
    <td>
    <input type="text" name="txtephoneno" placeholder="XX-XXXXXXXXX" required/>
    </td>
  </tr>
  
  <tr>
    <td>Email</td>
    <td>
    <input type="text" name="txteemail" placeholder="Enter Employer or Company Email Address" required/>
    </td>
  </tr>
  
  <tr>
    <td>Description</td>
    <td>
    <textarea name="txtedesc" placeholder="Enter Description about Employer or Company"></textarea>
    </td>
  </tr>
  
  <tr>
    <td>Username</td>
    <td>
    <input type="text" name="txteusername" placeholder="Enter Username"  required/>
    </td>
  </tr>

  <tr>
    <td>Password</td>
    <td>
    <input type="password" name="txtepassword" placeholder="********"  required/>
    </td>
  </tr>

  <tr>
    <td>Profile Image</td>
    <td>
    <input type="file" name="eprofileimage" required/>
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