<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}


$_SESSION['user']="\"nswe@gmail.com\"" ;

$communityid=$_GET['communityid'];
$user = "\"".$_COOKIE['user']."\"";


include 'api.php';

 $memberresult = mysql_query("select * from profile where email IN (SELECT member from member_of where communityid=".$communityid.")");

$tem=mysql_query("SELECT * FROM member_of WHERE communityid =".$communityid." and member =".$user.""); 
$temr=mysql_fetch_array($tem);
	 if($temr)    
  { //check for member .""
	 //echo "inside";

  $res=mysql_query("SELECT firstname from profile Where email IN (SELECT owner from community where id=".$communityid.")");
  $own= mysql_fetch_array($res);
  $owner=$own[0]; 


  	
  $result = mysql_query("SELECT * from community where id =".$communityid);
  $row = mysql_fetch_array($result);
     if($row)
     {

      $communityname = $row[name];
      $category = $row[category];
      $desc = $row[description];
    }
    else{
		echo "Group does not exist";
    }

 }
else { 
header("Location: communitynonmember.php?communityid=".$communityid);
	exit(1); 
}

 ?>

<html>
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
            <h1><a href="#"><span>Geek</span>Ster</a></h1>
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


        <div id="C_contextHead">
          <div id="C_contextHeadBody">
            <div class="hbg">
              <h2 id="bannerGroupName" width="923" height="291">
                <span><?php echo $communityname;  ?></span>
              </h2>
            </div>
          </div>
        </div>

        <div class="clr"></div>
        <ul class="nav nav-tabs">
         <li ><a href="<?php echo "communitymember.php?communityid=".$communityid ?>">About</a></li>
          <li ><a href="<?php echo "wall.php?communityid=".$communityid ?>">Wall</a></li>
          <li class="active"><a href="#">Members</a></li>
          <li><a href="<?php echo "leavegroup.php?communityid=".$communityid ?>">Leave the Group</a></li>
        </ul>
        <div class="clr"></div>

        <a name="members">
                <h2 class="titlehdr">Member List </h2>  
                <p></p>
                <b>
                    <?php 

                    while($row = mysql_fetch_array($memberresult))
                    {
                      echo '<a href="profile.php?member='.$row[email].'" >'.$row[firstname]." ".$row[lastname]."<br />"."</a>";
                      echo "<p>"."</p>";
                    }

                    ?>
                </b>
                <p>
                   <?php 

                    while($row = mysql_fetch_array($memberresult))
                    {
                      echo $row[interests]."<br />";
                    }

                    ?>
                </p>

        </a>
      </div>
    </div>
  </div>
</body>
 <div class = "footer">
    <div style="font-size: 90%" align="center">
    <p>Copyright &copy; CS2102 Group 21 Geekster. All rights reserved.</p>
    </div>
    </div>
</html>