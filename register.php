<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="css/patch.css"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.carousel').carousel(/*{
				interval:1000
			}*/);
		});
	</script>
	</script> <link href="img/icon.png" rel="shortcut icon" />
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span7 well">
				<div id="myCarousel" class="carousel">
					<center>
						<div class="carousel-inner">
							<div class="item active"><img src="img/Screenshot1.jpg"></div>
							<div class="item"><img src="img/Screenshot2.jpg"></div>
							<div class="item"><img src="img/Screenshot3.jpg"></div>
							<div class="item"><img src="img/Screenshot4.jpg"></div>
						</div>
					</center>
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>			
			</div>
			<div id="login_register">
				<div class="row-fluid">
					<div class="span4 offset1">
						
							<div class="item">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<img src="img/Logo.png">
							</div>
						</center>
					</div>
					<div class="span4 offset1">
						</br>
						<div class="row-fluid">
							<div class="span4">
								<!-- <label><?php echo $error ?></label> -->
							</div>
						</div>
						<section class="patch-well">
							<center>
								<?php 
								if(isset($_GET['errormsg']))
								{
									echo '<div class = "row-fluid">
											<font color = "red">'.$_GET['errormsg'].'</font>
										  </div>';
								}
								?>
								
								
							</center>
							<form class="well" method="post" action="process_register.php">
								<div class="row-fluid">
									<div class="span4">
										<label>Name</label>
										<input name="myfirstname" type="text" id="myfirstname" placeholder="Firstname"/>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span4">
										<input name="mylastname" type="text" id="mylastname" placeholder="Lastname"/>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span4">
										<label>Email</label>
										<input name="myusername" type="text" id="myusername" placeholder="Enter Email here..."/>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span4">
										<label>Password</label>
										<input name="mypassword" type="password" id="mypassword" placeholder="Type Password here..."/>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span4">
										<input name="mypassword2" type="password" id="mypassword2" placeholder="Re-Type Password here..."/>
									</div>
								</div>
								<div class="row-fluid">
									<button class="btn btn-primary">Submit</button>
									<button class="btn" onclick="clearForm(this.form);">Clear</button>
								</div>
							</form>
						</section>
					</div>
					<div class="span4 offset1">
						</br>
						<section class="patch-well">
							<form>
								<div class="row-fluid">
									<div class="item">
										<text> Registered Users Login here! </text>
											<a class="btn btn-primary" id="Reg_btn" href="login.php">Login</a>
											</a>
									</div>
								</div>
							</form>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/Tooltip.js"></script>	
	<script src="js/Popover.js"></script>	
	<script src="js/Carousel.js"></script>	
</body>
<div class = "footer" aign = "center">
								<div style="font-size: 90% ;  position: absolute;  left:200px; right:200px; height:40px; bottom: 0px" align="center">
									<p align = "center">Copyright &copy; CS2102 Group 21 Geekster. All rights reserved.</p>
								</div>
							</div>
</html>

<script type="text/javascript">
/*
$('.Reg_btn').click(function() {  
var href = $(this).attr('href');
    $('#login_register').hide().load(href).fadeIn('normal');
	return false;
  });  
  */
</script>