<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}

$user = "\"".$_COOKIE['user']."\"";
$member=$_GET['member'];
$temp = $user;
$user = substr($user, 1, -1);

//-----------------Picture Retrieval
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

$showDivFlag=true;
if ($member <> $user && !(empty($member))){
    $user = $member;
    $showDivFlag=false;
 }else {
 }

$tbl_name="profile"; // Table name 
if ($showDivFlag) {
  $sql = "SELECT * FROM $tbl_name WHERE email= $temp";
} 
else {
  $temp = '"'.$member.'"';
  $sql = "SELECT * FROM $tbl_name WHERE email= $temp";
}

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
#echo $row;
$photo_file = $row['picture_name'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title>Geekster</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />     
      <link href="style.css" rel="stylesheet" type="text/css" />
      <style id="jsstyle" type="text/css"></style>
      <link href="img/icon.png" rel="shortcut icon" />

      <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
      <script type="text/javascript" src="js/cufon-yui.js"></script>
      <script type="text/javascript" src="js/arial.js"></script>
      <script type="text/javascript" src="js/cuf_run.js"></script>

      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap-responsive.css" rel="stylesheet">
      <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
          
      <link rel="stylesheet" href="http://static1.meetupstatic.com/0560321913878657420/style/chapterbase.css" type="text/css" />
      <link rel="stylesheet" href="http://static2.meetupstatic.com/041222114214907467412/style/module.css" type="text/css" />
      <link rel="stylesheet" type="text/css" media="print" href="http://static1.meetupstatic.com/3625510117719833664301118/style/print.css" />
      <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.meetup.com/pinterestmeetup/events/rss/Silicon+Valley+Pinterest+Meetup/" />
      <link rel="stylesheet" href="http://static1.meetupstatic.com/449131316923795040/style/meetup_jquery_ui.css" type="text/css" />


  </head>
<body>
<div class="main">
  <div class="main_resize">
    
    <div class="header">
        <div class="logo">
          <STYLE>H2 {font:normal 24px Arial, Helvetica, sans-serif;
            padding:4px 0;
            margin:0;
            color:#595959;}
            </STYLE>
            <h1><a href="newsfeed.php"><span>Geek</span>Ster</a></h1>
            <h2>An online community for all the awesome geeks out there!</h2>          
          </div>
     <div class="hbg"><img src="img/geekgrp.jpg" width="300" height="120" alt="" align= "right"/></div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li ><a href="newsfeed.php">NewsFeed</a></li>
          <li ><a href="profile.php">Profile</a></li>
          <li ><a href="findgroups.php">Find Groups</a></li>
          <li class"active"><a href="creategroup.php">Create a Group</a></li>
          <li><a href="logout.php">Log out</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>


	
	
    <div style='height: 550px; width: 30%; border: 0px solid black; float: left;' class="hbg">
      <br>
      <img src="img/profilepics/<?php echo $photo_file ?>" width="223" height="191" alt="" />
      <br>
    </div>

    <div style='height: 550px; width: 60%; border: 0px solid green; float: left;' class="info">
      <?php
      include 'api.php';
      $res = mysql_query('SELECT firstname, lastname, birthdate, aboutme, interests FROM profile
      WHERE email = "'.$user .'"');
      while($row = mysql_fetch_array($res))
      {  
        echo'<div class="info">
        <h1>'.$row['firstname'].' '.$row['lastname'].'</h1><br></br>
        <h3>Birth Day:</h3> '.$row['birthdate'].'<br></br>
        <h3>About Me:<br></h3> '.$row['aboutme'].' <br></br> <h3>Interests:<br></h3> '.$row['interests'].'
        </div>';
      }
      ?>
    <div class='info'>
        <div class="CommunityTitle">
        <h3>Communities Owned:<h3>
        </div>
        <?php
          include 'api.php';

          $res = mysql_query('SELECT c.name, c.id
          FROM community c, profile p
          WHERE p.email=c.owner AND p.email = "'.$user .'"');

          $oflag = 0;

          while($row = mysql_fetch_array($res))
          { 
            echo'<div class="info">
            <a href="communitymember.php?communityid='.$row['id'].'" >'.$row['name'].'</a>
            </div>';
            $oflag =  1;
          }

          if($oflag==0 && $showDivFlag){
            echo'<div class="info">
            You have not yet created any group.
            </div>';
          }
        ?>
        
        <div class="info">
        <h3>Member of:<h3>
        </div>
        
        <?php
        include 'api.php';

        $res = mysql_query('SELECT c.name, c.id
            FROM community c, profile p, member_of mo
            WHERE p.email = "'.$user.'" AND p.email = mo.member AND mo.communityid = c.id 
            GROUP BY c.name' );

        $flag = 0;

        while($row = mysql_fetch_array($res))
        {  
          echo'<div class="info">
          <a href="communitymember.php?communityid='.$row['id'].'" >'.$row['name'].'</a>
          </div>';
          $flag = 1;
        }

        if($flag==0 && $oflag==0 && $showDivFlag){
          echo'<div class="info">
          You are not yet a member of any group.
          </div>';
        }

        ?>
      </div>

    </div>

    <div class="menu_nav" <?php if (!$showDivFlag){?>style="display:none"<?php } else {?>style='height: 550px; width: 7%; border: 0px solid green; background-color: #ffffff;padding-right: 5px; float: left;'<?php } ?>>
      <ul>    
        <li class="edit"><a href="editprofile.php">Edit</a></li>
      </ul>
       <div class="clr"></div>
    </div>

  </div>
</div>
</body>
<!-- 

  <div class = "footer" aign = "center">
                <div style="font-size: 90% ;  position: absolute;  left:200px; right:200px; height:40px; bottom: 0px" align="center">
                  <p align = "center">Copyright &copy; CS2102 Group 21 Geekster. All rights reserved.</p>
                </div>
              </div> -->

</html>