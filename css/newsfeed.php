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

</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Geek</span>Ster</a></h1>
        <h2>An online community for all the awesome geeks out there!</h2>
      </div>
     
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="newsfeed.php">NewsFeed</a></li>
          <li><a href="profile.html">Profile</a></li>
          <li ><a href="groups.html">Groups</a></li>
          <li><a href="login.html">Log out</a></li>
        </ul>
        <div class="clr"></div>
      </div>
      </div>
  
<div class="mygroups">
	<h2>My Groups</h2>
	<?php
    
	include 'api.php';
            
	$res = mysql_query('SELECT * FROM(SELECT c.name, t.topicid, c.last_updated FROM community c, profile p, member_of mo, topic t
	WHERE p.email = mo.member AND mo.communityid = c.id AND t.communityid = c.id  
    GROUP BY c.name
	UNION
	SELECT c.name, \' \', c.last_updated FROM community c, profile p, member_of mo WHERE p.email = mo.member AND mo.communityid = c.id AND c.id NOT IN(SELECT t.communityid FROM topic t) GROUP BY c.name )temp 
	ORDER BY last_updated' );
	// echo '<table border=\'1\'>';
	// echo '<tr>';
	// echo '<th>Community Name</th>';
	// echo '<th>Topic ID</th>';
	// echo '<th>Last Updated</th>';
	// echo '</tr> ';
	
	// while($row = mysql_fetch_array($res))
	// {
		// echo '<tr>';
		// echo '<td>';
		// echo $row['name'] ;
		// echo '</td>';
		// echo '<td>';
		// echo $row['id'] ;
		// echo '</td>';
		// echo '<td>';
		// echo $row['last_updated'] ;
		// echo '</td>';
		// echo '</tr>';
	// }
	?>
</div>
</div>
</div>

    
        
          
  

</body>
</html>