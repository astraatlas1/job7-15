<?php
	require_once 'includes/init.php';
	$logged_in = Contact::isLoggedIn();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Smithside Auctions</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">

	<div id="header">
		
	<a href="index.php">
			<img src="images/banner.jpg"  alt="Smithside Auctions" />
		</a> 
	</div><!-- end header -->
	
	<div id="navigation">
		<h3 class="element-invisible">Menu</h3>
		<ul class="mainnav">
        	<li><a href="index.php?content=categories">Lot Categories</a></li>
        	<li><a href="index.php?content=about">About Us</a></li>
        	<li><a href="index.php?content=home">Home</a></li>
			<?php if ($logged_in) : ?>
				<li><a href="index.php?content=logout">Logout</a></li>
			<?php else : ?>
				<li><a href="index.php?content=login">Login</a></li>
			<?php endif; ?>
		</ul>
		<div class="clearfloat"></div>
	</div><!-- end navigation -->

	<div class="message">
		<?php echo $message; ?>
	</div><!-- end message -->	
	
	<div class="sidebar">
		<?php loadContent('sidebar',''); ?>
	</div><!-- end sidebar -->

	<div class="content">
		<?php loadContent('content','home'); ?>
</div><!-- end content -->

	<div class="clearfloat"></div>
	
	<div id="footer" align="center" >
		<p>&copy; 2011 Smithside 	Auctions</p>
	</div><!-- end footer -->

</div><!-- end container -->
</body>
</html>