<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}

$user = "\"".$_COOKIE['user']."\"";
?>

<?php

include 'api.php';


$first=$_POST['FirstName']; 
$last=$_POST['LastName']; 
$bdate=$_POST['BirthDate'];
$about=$_POST['AboutMe'];
$interest=$_POST['Interests'];

$query= mysql_query("UPDATE profile set firstname = '$first' WHERE email= ".$user );
$query= mysql_query("UPDATE profile set lastname = '$last' WHERE email= ".$user);
$query= mysql_query("UPDATE profile set birthdate = '$bdate' WHERE  email= ".$user);
	#DATE_FORMAT( STR_TO_DATE(  $bdate,  '%m/%d/%Y' ) ,  '%Y-%m-%d' ) ");
$query= mysql_query("UPDATE profile set aboutme = '$about' WHERE email= ".$user);
$query= mysql_query("UPDATE profile set interests = '$interest' WHERE email= ".$user);

header("Location: profile.php");

?>