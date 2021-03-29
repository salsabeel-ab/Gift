<!DOCTYPE html>
<html>
<?php require("conn.php") ;
 SESSION_START();
?>
	<head>
	<title>Gift Marketing</title>
	<link rel="icon" href="22.gif"/>
	<link rel="stylesheet" href="s.css"/>
		<link rel="stylesheet" href="awesome/css/font-awesome.css" type="text/css" >
		<link rel="stylesheet" href="awesome/css/font-awesome.min.css"/>
		<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
	</head>
	<body>
		<div class="nav">
			<div class="menu">
				<ul>
					<li ><a href="index.php" style="border-left:2px solid #eb1460">&nbsp;Home</a></li>
					<div class="dropdown">
					  <li><span style="border-left:2px solid #ff5505">&nbsp;Products</span></li>
					  <div class="dropdown-content">
						<a href="stuff.php?type=Baby stuff">Baby Stuff</a>
						<a href="stuff.php?type=Clothes">Clothes</a>
						<a href="stuff.php?type=Toys">Toys</a>
					  </div>
					</div>
					<div class="dropdown">
					  <li><span style="border-left:2px solid #ff5505">&nbsp;Checkout</span></li>
					  <div class="dropdown-content">
					  <?php 
										if(empty($_SESSION['Name'])||empty($_SESSION['AName']))
										{
											echo'<a href="signup.php">Sign up</a>';
                                            echo'<a href="login.php">Log in</a>';
									 
										}
										else{
									        echo '<a href="carts.php">Cart</a>';
											echo '<a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a>';
                                        }
                                    ?>
						
						
						
					  </div>
					</div>
					<li><a href="about.php" style="border-left:2px solid #374">&nbsp;About us</a></li>
					<li><a href="contact.php" style="border-left:2px solid #337ab7">&nbsp;Contact</a></li>
				</ul>
			<div class="crt">
				<!--<img src="user.svg" class="cart" style="MARGIN-TOP:10px;">&nbsp;-->
				<a href="carts.php"><img src="cart.svg" class="cart" style="MARGIN-TOP:10px;"></a>
			</div>
			
			<div id="left">
				<span><img src="22.gif" alt="logo" id="looog"></span>&nbsp;
				<span id="p1">ift</span>
			</div>
			</div>
		</div>
		<div class="co">
	
		</div>
	</body>
</html>