<?php
require ('connect.php');

//-------------Students Table----------

$drstudents="Drop table Students";
$retstudents=mysql_query($drstudents, $connection);

$students="CREATE TABLE Students
(
	studentID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	s_name varchar(30),
	s_email varchar(30),
	s_location varchar(30),
	s_gender varchar(6),
	s_skills varchar(255),
	s_workexpdesc varchar(255),
	s_edudesc varchar(255),
	s_username varchar(30),
	s_password varchar(30),
	s_profileimage varchar(255)
)";

$retstudents =mysql_query ($students, $connection);



$query="INSERT INTO Students
		(s_name, s_email, s_location, s_gender, s_skills, s_workexpdesc, s_edudesc, s_username, s_password, s_profileimage)
		VALUES
		('John Smith', 'johnsmith123@gmail.com', 'United States', 'Male', 'Java, PHP, HTML5, CSS3', '4 years of developing programs and websites in MMM Software House', 'M.Sc (Hons) Business IT', 'Johnny', 'littlejohnny', 'ProfileImage/John.png')";
$retstudents=mysql_query($query, $connection);

$query="INSERT INTO Students
		(s_name, s_email, s_location, s_gender, s_skills, s_workexpdesc, s_edudesc, s_username, s_password, s_profileimage)
		VALUES
		('Alexander Johnson', 'alex2016@gmail.com', 'United Kingdom', 'Male', 'HTML5, CSS3', '2 years of developing websites in MOB Software House', 'B.Sc (Hons) Business IT', 'Alexander', 'iamalex', 'ProfileImage/Alex.png')";
$retstudents=mysql_query($query, $connection);

$query="INSERT INTO Students
		(s_name, s_email, s_location, s_gender, s_skills, s_workexpdesc, s_edudesc, s_username, s_password, s_profileimage)
		VALUES
		('Susan Petty', 'susanlily@gmail.com', 'Australia', 'Female', 'CSS3', '2 years of designing websites online', 'B.Sc (Hons) Business IT','Lily', 'susanlily123', 'ProfileImage/Susan.png')";
$retstudents=mysql_query($query, $connection);

$query="INSERT INTO Students
		(s_name, s_email, s_location, s_gender, s_skills, s_workexpdesc, s_edudesc, s_username, s_password, s_profileimage)
		VALUES
		('Yamong Nadi Aung', 'piggyyamong@gmail.com', 'Myanmar', 'Female', 'Java, PHP, HTML5, CSS3', '3 years of developing dynamic websites in MOB Software House', 'M.Sc (Hons) Business IT', 'PiggyYamong', 'kirokuronuchi', 'ProfileImage/Yamong.png' )";
$retstudents=mysql_query($query, $connection);


if ($retstudents)
{
	echo "<p> Students Table Created!</p>";
}
else
{
	echo "<p> Something went wrong while creating Students Table. Please retry later: ".mysql_error()." </p>";
}



//-------------Employer Table----------

$dremployers="Drop table Employers";
$retemployers=mysql_query($dremployers, $connection);

$employers="CREATE TABLE Employers
(
	employerID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	e_name varchar(30),
	e_address varchar(255),
	e_phoneno varchar(20),
	e_email varchar(30),
	e_desc varchar(255),
	e_username varchar(30),
	e_password varchar(30),
	e_profileimage varchar(255)
)";

$retemployers =mysql_query ($employers, $connection);


$query="INSERT INTO Employers
		(e_name, e_address, e_phoneno, e_email, e_desc, e_username, e_password, e_profileimage)
		VALUES
		('Min Maung Maung', 'Myanmar', '95936250008', 'gameboyarena09@gmail.com', 'The CEO of MMM Software House', 'TrainerSP', 'mmmspmmm', 'ProfileImage/MMM.png' )";
$retemployers=mysql_query($query, $connection);

$query="INSERT INTO Employers
		(e_name, e_address, e_phoneno, e_email, e_desc, e_username, e_password, e_profileimage)
		VALUES
		('Naing Aung Win', 'Myanmar', '959440259616', 'naingaungwin2016@gmail.com', 'The CEO of MOB Software House', 'Shadow', 'dtshadow', 'ProfileImage/NAW.png' )";
$retemployers=mysql_query($query, $connection);

$query="INSERT INTO Employers
		(e_name, e_address, e_phoneno, e_email, e_desc, e_username, e_password, e_profileimage)
		VALUES
		('Waing La Min Lwin', 'Myanmar', '959440261699', 'archonwaing@gmail.com', 'The CEO of WLML Development Team', 'Archon', 'dtarchon', 'ProfileImage/WLML.png' )";
$retemployers=mysql_query($query, $connection);

$query="INSERT INTO Employers
		(e_name, e_address, e_phoneno, e_email, e_desc, e_username, e_password, e_profileimage)
		VALUES
		('Aung Myat Htet', 'Myanmar', '95973088334', 'littlechinese@gmail.com', 'The Managing Director of Agile Software House.', 'GGWatPu', 'tintlaewin', 'ProfileImage/AMH.png' )";
$retemployers=mysql_query($query, $connection);




if ($retemployers)
{
	echo "<p> Employers Table Created!</p>";
}
else
{
	echo "<p> Something went wrong while creating Employers Table. Please retry later: ".mysql_error()." </p>";
}


//-------------Admin Table----------

$dradmin="Drop table Admin";
$retadmin=mysql_query($dradmin, $connection);

$admin="CREATE TABLE Admin
(
	adminID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	a_username varchar(30),
	a_password varchar(30)
)";

$retadmin =mysql_query ($admin, $connection);

if ($retadmin)
{
	echo "<p> Admin Table Created!</p>";
}
else
{
	echo "<p> Something went wrong while creating Admin Table. Please retry later: ".mysql_error()." </p>";
}


$query="INSERT INTO Admin
		(a_username, a_password)
		VALUES
		('NeonNature', 'neonnature2016')";
$retadmin=mysql_query($query, $connection);




//-------------Project Table----------

$drproject="Drop table Project";
$retproject=mysql_query($drproject, $connection);

$project="CREATE TABLE Project
(
	projectID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	p_title varchar(255),
	p_desc varchar(255),
	p_skills varchar(255),
	p_payment varchar(10),
	p_startdate date,
	p_enddate date,
	p_vetted boolean,
	p_status varchar(10),
	employerID int NOT NULL,
	FOREIGN KEY (employerID) references Employers(employerID),
	adminID int NOT NULL,
	FOREIGN KEY (adminID) references Admin(adminID)
)";

$retproject =mysql_query ($project, $connection);


$query="INSERT INTO Project
		(p_title, p_desc, p_skills, p_payment, p_startdate, p_enddate, p_vetted, p_status, employerID, adminID)
		VALUES
		('Website Development for Golden Lion Hotel', 'Developing a dynamic website for Golden Lion Hotel with transactions','PHP, HTML5' , '$300', '2016-09-01', '2016-12-01', 'false', 'Pending', '1', '1' )";
$retproject=mysql_query($query, $connection);


$query="INSERT INTO Project
		(p_title, p_desc, p_skills, p_payment, p_startdate, p_enddate, p_vetted, p_status, employerID, adminID)
		VALUES
		('Website Development for Yummy Gummy Restaurant', 'Developing a dynamic website for Yummy Gummy Restaurant with transactions', 'PHP, HTML5', '$400', '2016-09-12', '2016-12-31', 'false', 'Pending', '2', '1' )";
$retproject=mysql_query($query, $connection);


$query="INSERT INTO Project
		(p_title, p_desc, p_skills, p_payment, p_startdate, p_enddate, p_vetted, p_status, employerID, adminID)
		VALUES
		('Software Development for Ice Ice Crazy Restaurant', 'Developing a management system software for Ice Ice Crazy Restaurant', 'Java, MySQL' ,'$200', '2016-09-01', '2016-12-31', 'false', 'Pending', '3', '1' )";
$retproject=mysql_query($query, $connection);


$query="INSERT INTO Project
		(p_title, p_desc, p_skills, p_payment, p_startdate, p_enddate, p_vetted, p_status, employerID, adminID)
		VALUES
		('Software Development for Michael Hotel', 'Developing a management system software for Michael Hotel', 'Java, MySQL', '$250', '2016-10-01', '2016-12-01', 'false', 'Pending', '4', '1' )";
$retproject=mysql_query($query, $connection);

if ($retproject)
{
	echo "<p> Project Table Created!</p>";
}
else
{
	echo "<p> Something went wrong while creating Project Table. Please retry later: ".mysql_error()." </p>";
}


//-------------Application Table----------

$drapplication="Drop table Application";
$retapplication=mysql_query($drapplication, $connection);

$application="CREATE TABLE Application
(
	appID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
	studentID int NOT NULL,
	projectID int NOT NULL,
	FOREIGN KEY (studentID) references Students(studentID),
	FOREIGN KEY (projectID) references Project(projectID),
	applieddate timestamp,
	acceptedstatus varchar(10)
)";

$retapplication =mysql_query ($application, $connection);



$query="INSERT INTO Application
		(studentID, projectID, applieddate, acceptedstatus)
		VALUES
		('1', '1', '2016-08-12', 'Pending')";
$retapplication=mysql_query($query, $connection);

$query="INSERT INTO Application
		(studentID, projectID, applieddate, acceptedstatus)
		VALUES
		('1', '2', '2016-08-12', 'Pending')";
$retapplication=mysql_query($query, $connection);

$query="INSERT INTO Application
		(studentID, projectID, applieddate, acceptedstatus)
		VALUES
		('2', '2', '2016-08-13', 'Pending')";
$retapplication=mysql_query($query, $connection);

$query="INSERT INTO Application
		(studentID, projectID, applieddate, acceptedstatus)
		VALUES
		('3', '2', '2016-08-14', 'Pending')";
$retapplication=mysql_query($query, $connection);



if ($retapplication)
{
	echo "<p> Application Table Created!</p>";
}
else
{
	echo "<p> Something went wrong while creating Application Table. Please retry later: ".mysql_error()." </p>";
}


?>