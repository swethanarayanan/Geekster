<?php

session_start();

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 
$mypassword2=$_POST['mypassword2'];
$myfirstname=$_POST['myfirstname'];
$mylastname=$_POST['mylastname'];

$host="localhost"; // Host name
$username="root"; // Mysql username 
$password="bitnami"; // Mysql password 
$db_name="geekster_db"; // Database name 
$tbl_name="profile"; // Table name 

// Connect to server and select database.
$connect = mysql_connect('localhost', 'root', 'bitnami');
if (!$connect) 
{
     //echo 'error!';
     die(mysql_error());
}
else
{
    //echo 'Successful Connection!';
}
$db_connect = mysql_select_db('geekster_db', $connect);
if (!$db_connect)
{
    //echo 'Error';
    die(mysql_error());
}


// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$mypassword2 = stripslashes($mypassword2);
$myfirstname = stripslashes($myfirstname);
$mylastname = stripslashes($mylastname);

$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$mypassword2 = mysql_real_escape_string($mypassword2);
$myfirstname = mysql_real_escape_string($myfirstname);
$mylastname = mysql_real_escape_string($mylastname);

//Check that user has entered values for all fields
if($myusername=="" || $myfirstname=="" || $mylastname=="" || $mypassword=="")
{
	header("Location: register.php?errormsg=Missing values! Please enter values for all fields");
	exit();
	
}


$sql="SELECT * FROM $tbl_name WHERE email=\"".$myusername."\"";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $myusername))
{
	header("Location: register.php?errormsg=Please Enter a Valid Email Address!");
	exit();
}
   

// If result matched $myusername and $mypassword, table row must be 1 row => Username Exists!
if($count!=0)
{

	header("Location: register.php?errormsg=Username already exists! Please register again with a different username");
	exit();
}

//Check if passwords match
if($mypassword!=$mypassword2)
{
	//Redirect back to register.php
	header("Location: register.php?errormsg=Password mismatch! Please register again");
	exit();
	
}

else //Create New User
{
	//$sql="INSERT INTO profile VALUES(NULL,NULL,'$mypassword','$myusername', NULL, NULL, NULL, NULL)";
	//$result=mysql_query($sql);
	
	mysql_query("INSERT INTO profile (password, email, firstname, lastname, picture_name) VALUES ('$mypassword', '$myusername', '$myfirstname', '$mylastname', 'default.jpg')");
	//mysql_query("UPDATE profile SET WHERE email<>'$myusername'");

	session_register("myusername");
	session_register("mypassword"); 
	$_SESSION['user'] = $myusername;
	setcookie("user", $_SESSION['user'], time()+36000, "/"); //Expire in 10 hours
	header("Location: profile.php");
}
?>