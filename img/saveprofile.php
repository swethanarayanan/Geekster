<?php
session_start();
?>

<?php

include 'api.php';

 //This is the directory where images will be saved 
$target = "img/"; 
$target = $target . basename( $_FILES['photo']['email']);
echo $target;

$first=$_POST['FirstName']; 
$last=$_POST['LastName']; 
$bdate=$_POST['BirthDate'];
$about=$_POST['AboutMe'];
$interest=$_POST['Interests'];
$pic==($_POST['Photo']);

echo $pic;

move_uploaded_file($_FILES["Photo"]["tmp_name"] , "$target".$_FILES["Photo"]["name"]);


$query= mysql_query("UPDATE profile set firstname = '$first' WHERE loginstatus=1");
$query= mysql_query("UPDATE profile set lastname = '$last' WHERE loginstatus=1");
$query= mysql_query("UPDATE profile set birthdate = '$bdate' WHERE  loginstatus=1");
	#DATE_FORMAT( STR_TO_DATE(  $bdate,  '%m/%d/%Y' ) ,  '%Y-%m-%d' ) ");
$query= mysql_query("UPDATE profile set aboutme = '$about' WHERE loginstatus=1");
$query= mysql_query("UPDATE profile set interests = 'interest' WHERE loginstatus=1");
$query= mysql_query("UPDATE profile set photo = '".$_FILES['Photo']['name']."' WHERE loginstatus=1");
#"'.$row['firstname'].'

echo $_FILES['Photo']['name'];

if(move_uploaded_file($_FILES['photo']['email'], $target)) 
 { 
 
 //Tells you if its all ok 
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory";
 } 
 else { 

 //Gives and error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 } 


#header("Location: profile.php");

?>