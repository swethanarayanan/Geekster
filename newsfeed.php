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


				<?php 

				include 'api.php';
				$firstlastnames_res = mysql_query('SELECT firstname, lastname FROM profile 
					WHERE email = '.$user);
				while($firstlastnames_arr = mysql_fetch_array($firstlastnames_res))
				{
					$firstname = $firstlastnames_arr['firstname'];
					$lastname = $firstlastnames_arr['lastname'];

				}
				?>

				<div class = "welcomebody all-round" style = "">
					<h1> <?php echo "Hi ";
								echo $firstname;
								 ?>!</h1>
				</div>
				
					<div class = "horizontalcontainer" >
						<div class="mygroups all-round" style = "width:50%; float: left;">
							<h2>My Groups</h2>


							<?php

							include 'api.php';

							$res1a = mysql_query('SELECT c.id, c.name, c.last_updated FROM community c, profile p, member_of mo, topic t
								WHERE p.email = '.$user.' AND p.email = mo.member AND mo.communityid = c.id AND t.communityid = c.id  
								GROUP BY c.id, c.name, c.last_updated 
								ORDER BY c.last_updated');

							$res1b = mysql_query('SELECT c.id, c.name, c.last_updated FROM community c, profile p, member_of mo 
								WHERE p.email = '.$user.' AND p.email = mo.member AND mo.communityid = c.id AND c.id NOT IN(SELECT t.communityid FROM topic t) 
								GROUP BY c.id, c.name, c.last_updated 
								ORDER BY c.last_updated');

							$rowres1a = mysql_fetch_array($res1a);
							$rowres1b = mysql_fetch_array($res1b);
							if(!$rowres1a&&!$rowres1b)
							{
								echo '<font color = \'red\'>You are not a member of any group yet</font>';
							}

							if($rowres1a)
							{
								do
								{
									echo'<div class="communitybody all-round"><p><h4><a href="communitymember.php?communityid='.$rowres1a['id'].'" style="color:#199be2" >'.
									$rowres1a['name'].'</a></h4><h6><a style = "margin-right:10px;float: right; display:inline_block">'.$rowres1a['last_updated'].'</a></h6></p></div>';
									$res2 = mysql_query('SELECT t.topicid, t.topicname, t.author, t.time FROM topic t
										WHERE t.communityid = '.$rowres1a['id'].'
										ORDER BY t.time');

									while($rowres2 = mysql_fetch_array($res2))
									{
										$res3 = mysql_query(('SELECT firstname, lastname FROM profile  WHERE email = "'.$rowres2['author'].'"'));
										while($rowres3 = mysql_fetch_array($res3))
										{
											$firstname = $rowres3['firstname'];
											$lastname = $rowres3['lastname'];
										}
										echo'<div class="commentbody all-round"><p><a href = "topic.php?communityid='.$rowres1a['id'].'&topicid='.$rowres2['topicid'].'"">'.$rowres2['topicname'].'</a>  -  '.$firstname.' '.$lastname.'<a style = "margin-right:10px;float:right; display:inline_block; ">'.$rowres2['time'].'</a></p></div>';
									}

								}while($rowres1a = mysql_fetch_array($res1a));
							}

							if($rowres1b)
							{
								do
								{
									echo'<div class="communitybody all-round"><p><h4><a href="communitymember.php?communityid='.$rowres1b['id'].'" style="color:#199be2" >'.
									$rowres1b['name'].'</a></h4><h6><a style = "margin-right: 10px; float: right; display:inline_block">'.$rowres1b['last_updated'].'</a></h6></p></div>';

								}while($rowres1b = mysql_fetch_array($res1b));
							}		


							?>
							
						</div>

					</div>

					<div class = "verticalcontainer" style = "float: left; width:50%">
						<div class ="populargroups">
							<h2>Popular Groups</h2>

							<?php

							include 'api.php';

							$max_last_updated_res = mysql_query('SELECT max(last_updated) FROM popular_groups');
							while($max_last_updated_arr = mysql_fetch_array($max_last_updated_res))
							{
								$max_last_updated = $max_last_updated_arr['max(last_updated)'];
							}
							$min_last_updated_res = mysql_query('SELECT "'.$max_last_updated.'"-INTERVAL \'5\' DAY AS mintime FROM popular_groups');
							while($min_last_updated_arr = mysql_fetch_array($min_last_updated_res))
							{
								$min_last_updated = $min_last_updated_arr['mintime'];
							}

							$pop_grp_res = mysql_query('SELECT p.id, p.community FROM popular_groups p 
								WHERE "'.$max_last_updated.'" >= p.last_updated AND p.last_updated >= "'.$min_last_updated.'"');

							$pop_grp_arr = mysql_fetch_array($pop_grp_res);
							if(!$pop_grp_arr)
							{
								echo '<font color = \'red\'>Nobody has posted in any groups yet </font>';
							}
							else
							{
								do
								{
									echo'<div class="communitybody all-round"><p><h4><a href="communitymember.php?communityid='.$pop_grp_arr['id'].'" style="color:#199be2" >'.
									$pop_grp_arr['community'].'</a></h4></p></div>';
								}while($pop_grp_arr = mysql_fetch_array($pop_grp_res));
							}


							?>
						</div>

						<div  class ="suggestedgroups">
							<h2>Suggested Groups</h2>

							<?php

							include 'api.php';

							$suggested_grp_res = mysql_query('SELECT c.id, c.name, c.category FROM community c 
								WHERE c.category IN (SELECT c1.category FROM community c1, member_of mo1 
									WHERE '.$_COOKIE['user'].' = mo1.member AND mo1.communityid = c1.id 
									AND c1.id NOT IN (SELECT c2.id FROM community c2, member_of mo2 
										WHERE '.$_COOKIE['user'].' = mo2.member AND mo2.communityid = c2.id))' );

							$suggested_grp_arr =  mysql_fetch_array($suggested_grp_res);
							if(!$suggested_grp_arr)
							{
								echo '<font color = \'red\'>No groups with the same categories have been found</font>';
							}
							else
							{
								do
								{

									echo'<div class="communitybody all-round">
									<h4>'.$suggested_grp_arr['name'].'</h4><div class = "commentbody all-round">	->	'.$suggested_grp_arr['category'].'</div></div>';

								}while($suggested_grp_arr = mysql_fetch_array($suggested_grp_res));
							}

							?>
							
						</div>
					</div>
					
				

		</div>
	</div>

</body>
	
	<!-- <div class = "footer" aign = "center">
								<div style="font-size: 90% ;  position: absolute;  left:200px; right:200px; height:40px; bottom: 0px" align="center">
									<p align = "center">Copyright &copy; CS2102 Group 21 Geekster. All rights reserved.</p>
								</div>
							</div> -->
</html>

