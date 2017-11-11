 <?php
 session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}


// $_SESSION['user']= "\"nswe@gmail.com\"";

 $communityid=$_GET['communityid'];
 $user = "\"".$_COOKIE['user']."\"";

 include 'api.php';

 $tem=mysql_query("SELECT * FROM member_of WHERE communityid =".$communityid." and member = ".$user); 
 $temr=mysql_fetch_array($tem);
 
 if(!$temr)      { //check for nonmember

    $res=mysql_query("SELECT firstname from profile Where email IN (SELECT owner from community where id=".$communityid.")");
    $own= mysql_fetch_array($res);
  //$oo= sqlanywhere_result_all($res);
    $owner=$own[0];
    $result = mysql_query("SELECT * from community where id =". $communityid);
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

    if(isset($_POST['Join']))
    {

      $result2 = mysql_query("INSERT into member_of (communityid, member) values (".$communityid.",". $user.")");
      $result3 = mysql_query("UPDATE community SET no_of_members=no_of_members+1 where id =".$communityid);
    
    //echo "joined";
      header("Location: communitymember.php?communityid=".$communityid);
      exit(1); 
    }
  }
  else { 
    header("Location: communitymember.php?communityid=".$communityid);
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
                  <span><?php echo "Community Name : ".$communityname;  ?></span>
                </h2>
              </div>
            </div>
          </div>

          <div class="clr"></div>
          <ul class="nav nav-tabs">
            <li class="active"><a href="#about">About</a></li>
          </ul>
          <div class="clr"></div>
   
      
        <a name="about">
        <table width="88%" border="0" cellspacing="0" cellpadding="5" class="main">
          <tr> 
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr> 
    <!--         <td width="280" valign="top">
             <div id="slideshow">
              <div id="s1" class = "pics">
                <img src = "img/java.jpg" width="272"/>     
              </div> 

              <p>&nbsp; </p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p></td> -->
              <td width="573" valign="top">
                <h2 class="titlehdr">Community Details
                </h2>  
                <?php echo "You are a not a member of this Community";  ?></p>  
                <form id="form1" name="form1" method="post">
                  <table width="100%" border="0" cellpadding="4" cellspacing="4" class="loginform">
                    <tr> 
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td width="27%">Category:</td>
                      <td width="73%"><?php echo $category;  ?></td>
                    </tr>
                    <td width="27%">Description:</td>
                    <td width="73%"><?php echo $desc;  ?></td>
                  </tr>
                  <tr> 
                    <td width="27%">Owner:</td>
                    <td width="73%"><?php echo $owner;  ?></td>
                  </tr>
                  <tr> 
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2"> 
                    <div align="left"> 
                    <p> 
                      <input type="submit" name="Join" value="Join" />
                    </p>
                  </div>
                </td>
                </tr>

                <tr> 
                  <td colspan="2">&nbsp;</td>
                </tr>
                
              </table>
            </form>   
          </td>
        </tr>
      </table>
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