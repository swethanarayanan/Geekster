<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}

$user = "\"".$_COOKIE['user']."\"";

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
$tbl_name="profile"; // Table name 


$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 50000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("img/profilepics/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $moved = move_uploaded_file($_FILES["file"]["tmp_name"],"img/profilepics/". $_FILES["file"]["name"]);
	  $name = $_FILES["file"]["name"];

		if ($moved) 
		{
        //echo "Move: Success";
		//Change SQL file name
		mysql_query("UPDATE profile SET picture_name='$name' WHERE email=$user");
		header("Location: profile.php");
		}
    else {
        //echo "Move Failed";
		header("Location: editprofile.php?errormsg=Please make sure your image is less than 40 kb and of the right format (gif/jpeg/png/pjpeg)");
		}
      //echo "Stored in: " . "img/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  //echo "Invalid file";
  header("Location: editprofile.php?errormsg=Please make sure your image is less than 40 kb and of the right format (gif/jpeg/png/pjpeg)");

  }
?>