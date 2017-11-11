<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: login.php?errormsg=Please login first");
    exit(1);
}

else
{
  $user = "\"".$_COOKIE['user']."\"";
}

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
  
    <link href="journey.css" rel="stylesheet" type="text/css" />
     
</head>
<body>
    

<div class="main">
      <div class="main_resize">
        <div class="header">
        <div class="logo">
             
                <STYLE> H2{font:normal 24px Arial, Helvetica, sans-serif;
                      padding:4px 0;
                      margin:0;
                      color:#595959;
                    }
                </STYLE>
                <H1><a href="newsfeed.php"><span>Geek</span>Ster</a></H1>
                <H2>An online community for all the awesome geeks out there!</H2>          
              </div>
     <div class="hbg"> <img src="img/geekgrp.jpg" width="300" height= "100" alt="" align= "right"/></div>
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

  
    <div class = "content">


        <div class= "sidebar">
            <div class= "gadget">
                             
                           
                     <form id="searchForm1" action="#" method="post"> Search by name:
                       <div class="doc-content journey-search">
                        <div class="journey-mainkeywords-wrap">
                          <input id="mainKeywords" class="text" type="text" name="groupname" size="30" maxlength="100" value="" title="Search by name" autocomplete="off" />
                          <div class="journey-mainkeywords-click"></div>
                          </div>
                     <div style="position: absolute; left: -9999px;">
                      <input type="submit" name = "searchName" value="searchName"  />
                    </div>
                    </div>
                    </form>

                    <form id="searchForm2" action="#" method="post"> Search by category:
                       <div class="doc-content journey-search">
                        <div class="journey-mainkeywords-wrap">
                          <input id="mainKeywords" class="text" type="text" name="groupcat" size="30" maxlength="100" value="" title="Search by category" autocomplete="off" />
                          <div class="journey-mainkeywords-click"></div>
                          </div>
                     <div style="position: absolute; left: -9999px;">
                      <input type="submit" name = "searchCat" value="searchCat"  />
                    </div>
                    </div>
                    </form>


         </div>
        </div>

  <div class ="mainbar">
      <div class =" article">



<!--  this to display pic   -->

<?php
  if(!isset($_POST['searchName']) && !isset($_POST['searchCat']) && !isset($_POST['criteriaName']) && !isset($_POST['criteriaCat']))
      {
      ?>
         <div class ="mainbar">
          <div class =" article">
               <h2> Explore interesting geek groups here </h2>

              <div class="hbg"><img src="img/header_images.jpg" width="638PX" height="400PX" alt="" align= "right"/></div>
            </div>
        </div>
      <?php 

      }
?>



<!-- this is to search by name  -->
<?php 
  session_start();

     if(isset($_POST['searchName']))  
     { include 'api.php';        

       $_SESSION['name']=$_POST["groupname"];
        
      $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description , c.id from community c where c.name like '%". $_SESSION['name']."%'");
      $result = mysql_fetch_array($query_groupidlist);

       if(!$result)       
       {           
            echo '<div class = "row-fluid">
                      <font color = "red">'."No groups found".'</font>
                      </div>';                 
       }       
       else       
       {      
        ?>
           <form name="sortform" action="" method="post">
          <label> Sort by</label>
          <select name="criteriaName"  id="criteriaName" onchange="sortform.submit()" >
            <option value=""> Select...</option>
            <option value="Most_Active"> Most popular</option>
            <option value="Most_Members">Most Members</option>
             <option value="Recently_Active">Recently active</option>
              </select></form>

          <?php

        do   
          {   
            $communityid = $result[3];         
           
            echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'" style="color:#199be2"  >'. $result[0].'</a></h3></div>';      
            echo ' <div class = "commentbody all-round"> ';
            echo ' <h4>'." Category :" .$result[1].'</h4>';
            echo ' <h4>'."Description: ".$result[2].'</h4>';
            echo '</div>';

            echo '<br></br>';
                                                          
          }

          while($result=mysql_fetch_array($query_groupidlist));  

      } //finishes displaying
       
  }     
?> 

<!-- this is to search by category -->
<?php 
  session_start();

     if(isset($_POST['searchCat']))  
     { include 'api.php';        

       $_SESSION['cat']=$_POST["groupcat"];
      
      $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description , c.id from community c where c.category like '%". $_SESSION['cat']."%'");
      $result = mysql_fetch_array($query_groupidlist);

       if(!$result)       
       {           
           echo '<div class = "row-fluid">
                      <font color = "red">'."No groups found".'</font>
                      </div>';                
       }       
       else       
       {      
        ?>
           <form name="sortform" action="" method="post">
          <label> Sort by</label>
          <select name="criteriaCat"  id="criteriaCat" onchange="sortform.submit()" >
            <option value=""> Select...</option>
            <option value="Most_Active"> Most popular</option>
            <option value="Most_Members">Most Members</option>
             <option value="Recently_Active">Recently active</option>
              </select></form>

          <?php

        do   
          {   
            $communityid = $result[3];         
           
            echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'" style="color:#199be2">'. $result[0].'</a></h3></div>';      
            echo ' <div class = "commentbody all-round"> ';
            echo ' <h4>'." Category :" .$result[1].'</h4>';
            echo ' <h4>'."Description: ".$result[2].'</h4>';
            echo '</div>';

            echo '<br></br>';
                                                          
          }

          while($result=mysql_fetch_array($query_groupidlist));  

      } //finishes displaying
       
  }     
?> 



<!-- this is to do sorting with search by name -->
<?php 
    
     if(isset($_POST['criteriaName']))  
     {  
        include 'api.php';
        $sort_input =  $_POST['criteriaName'];
       
         $query_MaxUp = mysql_query("SELECT max(c.last_updated) from community c where c.name like '%". $_SESSION['name']."%'") ;
        $_SESSION['MaxUP'] = mysql_fetch_array($query_MaxUp);


        if($sort_input == "Recently_Active")
          {
            $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description, c.id,  c.last_updated 
                                              from community c
                                               where c.name like '%". $_SESSION['name']."%' order by c.last_updated desc");
            $result = mysql_fetch_array($query_groupidlist);

           }
       elseif($sort_input == "Most_Members")
           {   $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description, c.id ,  c.no_of_members 
                                                FROM community c 
                                                WHERE c.name like '%". $_SESSION['name']."%' 
                                                order by c.no_of_members desc");
                 $result = mysql_fetch_array($query_groupidlist);
          
            
           }
        elseif ($sort_input == "Most_Active")
           {                         
                $query_groupidlist = mysql_query(" SELECT c.name, c.category , c.description, c.id , p.no_posts, p.last_updated
                                                  from community c, popular_groups p
                                                   where c.name like '%".$_SESSION['name']."%' and c.id =p.id
                                                   order by p.no_posts desc, p.last_updated desc ");
                   $query_groupidlist2 = mysql_query(" SELECT c.name, c.category , c.description, c.id 
                                                from community c
                                                where  c.name like '%". $_SESSION['name']."%'                                                  
                                                 and c.id not in ( Select p.id from popular_groups p )
                                                order by c.last_updated desc ");


                $result = mysql_fetch_array($query_groupidlist); 
                $resultnext =  mysql_fetch_array($query_groupidlist2);
            
         }
        else
        { 
echo '<div class = "row-fluid">
                      <font color = "red">'."Invalid selection".'</font>
                      </div>';    
        }

    if((($sort_input == "Recently_Active" ||$sort_input == "Most_Members") && !$result ) || ($sort_input == "Most_Active" && ( !$result && !$resultnext)))

    {echo '<div class = "row-fluid">
                      <font color = "red">'."No groups found".'</font>
                      </div>';    


    }
       
       else
        {

        
          ?> 

             <form name="sortform" action="" method="post">
            <label> Sort by</label>
            <select name="criteriaName"  id="criteriaName" onchange="sortform.submit()" >
              <option value=""> Select...</option>
              <option value="Most_Active"> Most popular</option>
              <option value="Most_Members">Most Members</option>
               <option value="Recently_Active">Recently active</option>
                </select></form>

            <?php

          if($result)
          {
             


        do   
          {   
            

           $communityid = $result[3];         
           
            echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'"style="color:#199be2" >'. $result[0].'</a></h3></div>';      
            echo ' <div class = "commentbody all-round"> ';
            echo ' <h4>'." Category :" .$result[1].'</h4>';
            echo ' <h4>'."Description: ".$result[2].'</h4>';
            echo '</div>';

            echo '<br></br>';
                                              
          }

          while($result=mysql_fetch_array($query_groupidlist));  


        }
                                         if($resultnext)

                                               { 

                                                 do   
                                                {   
                                                  

                                                 $communityid = $resultnext[3];         
                                                 
                                                  echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'"style="color:#6234fb" >'. $resultnext[0].'</a></h3></div>';      
                                                  echo ' <div class = "commentbody all-round"> ';
                                                  echo ' <h4>'." Category :" .$resultnext[1].'</h4>';
                                                  echo ' <h4>'."Description: ".$resultnext[2].'</h4>';
                                                  echo '</div>';

                                                  echo '<br></br>';
                                                                                    
                                                }

                                                while($resultnext=mysql_fetch_array($query_groupidlist2));  



                                            } //finishes displaying resultnext

     } // finishes displaying results
   }

  ?>


<!-- this is to do sorting with search by name -->
<?php 
    
     if(isset($_POST['criteriaCat']))  
     {  
        include 'api.php';
        $sort_input =  $_POST['criteriaCat'];
       
         $query_MaxUp = mysql_query("SELECT max(c.last_updated) from community c where c.cat like '%". $_SESSION['cat']."%'") ;
        $_SESSION['MaxUP'] = mysql_fetch_array($query_MaxUp);


        if($sort_input == "Recently_Active")
          {
            $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description, c.id,  c.last_updated 
                                              from community c
                                               where c.category like '%". $_SESSION['cat']."%' 
                                               order by c.last_updated desc");
            $result = mysql_fetch_array($query_groupidlist);

           }
       elseif($sort_input == "Most_Members")
           {   $query_groupidlist = mysql_query("SELECT c.name ,c.category, c.description, c.id ,  c.no_of_members 
                                                FROM community c 
                                                WHERE c.category like '%". $_SESSION['cat']."%' 
                                                order by c.no_of_members desc");
                 $result = mysql_fetch_array($query_groupidlist);
          
            
           }
        elseif ($sort_input == "Most_Active")
           {                         
                $query_groupidlist = mysql_query(" SELECT c.name, c.category , c.description, c.id , p.no_posts, p.last_updated
                                                  from community c, popular_groups p
                                                   where c.category like '%".$_SESSION['cat']."%' and c.id =p.id
                                                   order by p.no_posts desc, p.last_updated desc ");
                   $query_groupidlist2 = mysql_query(" SELECT c.name, c.category , c.description, c.id 
                                                from community c
                                                where  c.category like '%". $_SESSION['cat']."%'                                                  
                                                 and c.id not in ( Select p.id from popular_groups p )
                                                order by c.last_updated desc ");


                $result = mysql_fetch_array($query_groupidlist); 
                $resultnext =  mysql_fetch_array($query_groupidlist2);
            
         }
        else
        { 
echo '<div class = "row-fluid">
                      <font color = "red">'."Invalid selection".'</font>
                      </div>';    
        }
     

    if((($sort_input == "Recently_Active" ||$sort_input == "Most_Members") && !$result ) || ($sort_input == "Most_Active" && ( !$result && !$resultnext)))

    {
       echo '<div class = "row-fluid">
                      <font color = "red">'."No groups found".'</font>
                      </div>';    

    }
       
       else
        {

        
          ?> 

             <form name="sortform" action="" method="post">
            <label> Sort by</label>
            <select name="criteriaCat"  id="criteriaCat" onchange="sortform.submit()" >
              <option value=""> Select...</option>
              <option value="Most_Active"> Most popular</option>
              <option value="Most_Members">Most Members</option>
               <option value="Recently_Active">Recently active</option>
                </select></form>

            <?php

          if($result)
          {


        do   
          {   
            

           $communityid = $result[3];         
           
            echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'"style="color:#199be2" >'. $result[0].'</a></h3></div>';      
            echo ' <div class = "commentbody all-round"> ';
            echo ' <h4>'." Category :" .$result[1].'</h4>';
            echo ' <h4>'."Description: ".$result[2].'</h4>';
            echo '</div>';

            echo '<br></br>';
                                              
          }

          while($result=mysql_fetch_array($query_groupidlist));  


        }
                                         if($resultnext)

                                               { 
                                                 do   
                                                {   
                                                  

                                                 $communityid = $resultnext[3];         
                                                 
                                                  echo'<div class="communitybody all-round"><h3><a href="communitymember.php?communityid='.$communityid.'"style="color:#6234fb" >'. $resultnext[0].'</a></h3></div>';      
                                                  echo ' <div class = "commentbody all-round"> ';
                                                  echo ' <h4>'." Category :" .$resultnext[1].'</h4>';
                                                  echo ' <h4>'."Description: ".$resultnext[2].'</h4>';
                                                  echo '</div>';

                                                  echo '<br></br>';
                                                                                    
                                                }

                                                while($resultnext=mysql_fetch_array($query_groupidlist2));  



                                            } //finishes displaying resultnext

     } // finishes displaying results
   }

  ?>





  </div>    <!-- closes main bar and article -->
  <br> </br> <br> </br>
 <div class = "footer">
    <div style="font-size: 90%" align="center">
    <p>Copyright &copy; CS2102 Group 21 Geekster. All rights reserved.</p>
    </div>
    </div>
</div>  <!-- closes content -->
</body>

</html>


