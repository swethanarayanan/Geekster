    <?php
     session_start();
    if(!isset($_SESSION['user']))
    {
    header("Location: login.php?errormsg=Please login first");
    exit(1);
    }

    
    include 'api.php';

    $user = "\"".$_COOKIE['user']."\"";

    if(isset($_POST['creategroup']))
    {

      $owner = $user ;
      $name = $_POST['group_name'];
      $description = $_POST['group_description'];
      $category = $_POST['group_category'];


      $result = mysql_query("INSERT into community(name,owner,description,category,date_created,no_of_members) values('".$name ."',".$owner.",'".$description."','".$category."',CURDATE(),1)");   
      if(!$result)
       die(mysql_error());
      $grpid=mysql_query("SELECT id from community where name='".$name."' and owner=".$owner."");
      $rowgrpid = mysql_fetch_array($grpid);
      $result2 = mysql_query("INSERT into member_of (communityid, member) values (".$rowgrpid[0]."," .$user.")");

      if(!$result2)
       die(mysql_error());
      else
      {
        //echo "Location: communitymember.php?communityid=".$rowgrpid[0];
        header("Location: communitymember.php?communityid=".$rowgrpid[0]);
        exit(1); 
      } 
    
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

            <form  id="formcreategroup" method="post" name="formcreategroup">
              <legend>Create a group    </legend>

             <!--  <div id="CompletePhoto">
                <div class="frame">
                  <img src="img/default-profile.png" alt="Photo of Account Creator" />
                </div> -->
                
            <!--     <div class="buttons">
                  
                  <label for="id_img" class="Button WhiteButton Button13 ContrastButton upload" data-text-uploading="Uploading&hellip;">Upload your Photo</label>
                </div>
                
              </div> -->
              <label>Group name</label>
              <input type="text" name="group_name" placeholder="Type a group name">
              <label>Description</label>
              <textarea rows="10" type="text" name="group_description" placeholder="Give a description"></textarea> 
              <label>Category</label>
              <input type="text" name="group_category" placeholder="Write down a category">
              <br></br>
              <button type="submit" name="creategroup" value="creategroup" class="btn">Submit</button>   
            </form>
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