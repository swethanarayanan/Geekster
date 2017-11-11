<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title>Geekster</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link href="style.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
      <script type="text/javascript" src="js/cufon-yui.js"></script>
      <script type="text/javascript" src="js/arial.js"></script>
      <script type="text/javascript" src="js/cuf_run.js"></script>

      <link rel="stylesheet" href="http://static1.meetupstatic.com/0560321913878657420/style/chapterbase.css" type="text/css" />
      <link rel="stylesheet" href="http://static2.meetupstatic.com/041222114214907467412/style/module.css" type="text/css" />
      <link rel="stylesheet" type="text/css" media="print" href="http://static1.meetupstatic.com/3625510117719833664301118/style/print.css" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.meetup.com/pinterestmeetup/events/rss/Silicon+Valley+Pinterest+Meetup/" />
    <link rel="stylesheet" href="http://static1.meetupstatic.com/449131316923795040/style/meetup_jquery_ui.css" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <style id="jsstyle" type="text/css"></style>

  </head>
<body>
<div class="main">
  <div class="main_resize">
    
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Geek</span>Ster</a></h1>
        <h2>An online community for all the awesome geeks out there!</h2>
      </div>
     <div class="hbg"><img src="img/geekgrp.jpg" width="400" height="120" alt="" align= "right"/></div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li ><a href="newsfeed.php">NewsFeed</a></li>
          
          <li class="active"><a href="profilepage.php">Profile</a></li>
          <li ><a href="groups.html">Groups</a></li>
          <li><a href="login.html">Log out</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>


    <div style='height: 550px; width: 30%; border: 0px solid black; float: left;' class="hbg">
      <br>
      <img src="img/monkey.jpg" width="223" height="191" alt="" />
      <br>
      <div class='Communitylist'>
        <div class="CommunityTitle">
        <h2>Communities Owned<h2>
        </div>
        <?php
        include 'api.php';

        $res = mysql_query('SELECT c.name
        FROM community c, profile p
        WHERE p.email=c.owner AND p.loginstatus=1' );

        while($row = mysql_fetch_array($res))
        {  
          echo'<div class="Communitylist">
          '.$row['name'].' '.$row['id'].'
          </div>'; 
        }
        ?>
        
        <div class="CommunityTitle">
        <h2>Member of<h2>
        </div>
        
        <?php
        include 'api.php';

        $res = mysql_query('SELECT c.name
            FROM community c, profile p, member_of mo
            WHERE p.loginstatus=1 AND p.email = mo.member AND mo.communityid = c.id AND c.owner<>p.email 
            GROUP BY c.name' );

        while($row = mysql_fetch_array($res))
        {  
          echo'<div class="Communitylist">
          '.$row['name'].' '.$row['id'].'
          </div>'; 
        }
        ?>
      </div>
    </div>

    <div style='height: 550px; width: 60%; border: 0px solid green; float: left;' class="info">
      <?php
      include 'api.php';
      $res = mysql_query('SELECT firstname, lastname, birthdate, aboutme, interests FROM profile
      WHERE loginstatus = 1' );
      while($row = mysql_fetch_array($res))
      {  
        echo'<div class="info">
        <h1>'.$row['firstname'].' '.$row['lastname'].'</h1>
        <h3>Birth Day:</h3> '.$row['birthdate'].'
        <h3>About Me:<br></h3> '.$row['aboutme'].' <br> <h3>Interests:<br></h3> '.$row['interests'].'
        </div>'; 
      }
      ?>

    </div>

    <div style='height: 550px; width: 7%; border: 0px solid green; background-color: #ffffff;padding-right: 5px; float: left;' class="menu_nav">
      <ul>    
        <li class="edit"><a href="editprofile.php">Edit</a></li>
      </ul>
       <div class="clr"></div>
    </div>

<div class="footer" align="left">
  <div class="footer_resize">
    <p class="lf">&copy; Copyright <a href="#">CS2102 Group 21</a>.</p>
   
    <div class="clr"></div>
  </div>
</div>

</html>