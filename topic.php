<?php
session_start();

include 'api.php';

if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}

 	//$_SESSION['communityid']=$_GET['communityid'];
	//echo $_SESSION['communityid'];



//$_SESSION['user']="\"nswe@gmail.com\"" ;

$topicid = $_GET['topicid']; 
$communityid = $_GET['communityid'];
$author = "\"".$_COOKIE['user']."\"";

$result1 = mysql_query("SELECT * from community where id =". $communityid);
$row1 = mysql_fetch_array($result1);
if($row1)
{
  $communityname = $row1[name];
}

$result =mysql_query("SELECT topicname from topic where topicid = ".$topicid);
$row = mysql_fetch_array($result);
if($row)
{

  $topic = $row[topicname];

}

if(isset($_POST['newpost']))
{

  $content = $_POST['post'];
  $result = mysql_query("INSERT into posts(topicid,communityid,author,content) values (". $topicid .",".$communityid.",".$author.",'".$content."')");
  $result2 = mysql_query("UPDATE community SET last_updated=CURRENT_TIMESTAMP where id =".$communityid);
  if(!$result)
    die(mysql_error());
  else
  {
    //echo "success";
  }
}

?>

<html>
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


          <p></p>
          <div id="C_contextHead">
            <div id="C_contextHeadBody">
              <div class="hbg">
                <h2 id="bannerGroupName" width="923" height="291">
                  <span><?php echo $communityname;  ?></span>
                </h2>
              </div>
            </div>
          </div>

          <p></p>

          <div class="clr"></div>
          <ul class="nav nav-tabs">
          <li ><a href="<?php echo "communitymember.php?communityid=".$communityid ?>">About</a></li>
          <li ><a href="<?php echo "wall.php?communityid=".$communityid ?>">Wall</a></li>
          <li ><a href="<?php echo "members.php?communityid=".$communityid ?>">Members</a></li>
          <li><a href="<?php echo "leavegroup.php?communityid=".$communityid ?>">Leave the Group</a></li>
          </ul>
          <div class="clr"></div>
          <p></p>

        <div>
          <?php

          echo "<h4>"."<b>"."Topic : ". $topic."</b>"."</h4>";
          echo "<p></p>";

          $result = mysql_query("select t.content,p.firstname,p.lastname from posts t,profile p where t.communityid =" . $communityid . " and t.topicid = $topicid and t.author=p.email Order by t.time DESC");

          while($row = mysql_fetch_array($result))
          {
            echo "<b>".$row[firstname]." ".$row[lastname]."</b>"."<br></br>";
            echo  $row[content]."<br></br>"."<hr width=\"100%\" >";
          }
          ?>

          <div>

            <form  id="postpost" method="post" name="newpostform">
            <textarea name="post" style="width: 65em;" title="What&#039;s on your mind?" placeholder="What&#039;s on your mind?" role="textbox" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-owns="typeahead_list_uzxrovk15">What&#039;s on your mind?</textarea>
            <br></br>
            <button type="submit" name="newpost" value="newpost" class="btn">Post</button>   
          </form>

        </div>
        <p></p>


        </div>

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