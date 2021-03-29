<!DOCTYPE html>
<html>
	<head>
	<title>e-commerce</title>
	<link rel="stylesheet" href="s.css"/>
	<link rel="icon" href="logoo.png"/>
		<link rel="stylesheet" href="awesome/css/font-awesome.css" type="text/css" >
		<link rel="stylesheet" href="awesome/css/font-awesome.min.css"/>
	</head>
	<body>
<style>
  
        </style>
<div class="footer">
			
			<div id="summary">
				<div class="h"><ul><a href="index.php"><h3 id="h1">  Home</h3></a>
					<li>Gift marketing</li>
					<li>Services</li>
					<li>Thumbnails</li>
				</ul></div>
				<div class="d"><ul><h3 id="h2"> Products</h3>
					<a href="stuff.php"><li>Baby Stuff</li></a>
						<a href="clothes.php"><li>Clothes</li></a>
						<a href="toys.php"><li>Toys</li></a>
				</ul></div>
				<div class="f"><ul><h3 id="h3"> Checkout</h3>
					<a href="carts.php"><li>Cart</li></a>
					<a href="signup.php"><li>Sign up</li></a>
					<?php if(empty($_SESSION['Name']))
						{
					echo '<a href="login.php"><li>Log in</li></a>';
						}
						else{
							echo '<a href="logout.php"><li>Log out</li></a>';
						}
						?>
				</ul></div>
				
				<div class="o"><ul><a href="about.php"><h3 id="h4"> About Us</h3></a>
					<li>Our goals</li>
					<li>Our vision</li>
				</ul></div>
				<div class="c"><ul><a href="contact.php"><h3 id="h5"> Contact</h3></a>
					<li><i class="fa fa-share-alt-square"></i>Share with frinds</li>
					<li><i class="fa fa-facebook" title="facebook website"></i>&nbsp;Facebook</li>
					<li><i class="fa fa-youtube" title="youtube website"></i>&nbsp;Youtube</li>
				</ul></div>
			</div>
			<div class="scrollup">
				<a href="#">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
			
			<div class="copy">
				<span>&copy; </span>CopyRights Reserved<span > by Gift Market 2019</span>
			</div>
		</div>
		
	</body>
</html>
