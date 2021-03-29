<?php
require("conn.php");
SESSION_START();

	if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['Log-in']))
	{
		$username=$_POST['uid'];
		$email=$_POST['mail'];
		$password=$_POST['pwd'];
			if(empty($username)|| empty($email) || empty($password) ){
				
				if(empty($username))
				{
					$errors['name']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your name </spen>";
				}
				if(empty($email))
				{
					$errors['email']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your Email</spen>";
				}
				if(empty($password))
				{
					$errors['password']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your password</spen>";
				}
			}
			else if(strlen($username)<5 || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8 )
			{
				if(strlen($username)<5){
					$errors['uname']="<spen class='error' style='margin-left:10px; color:red;'>Name must be more than 5</spen>";
				}
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$errors['mail']="<spen class='error' style='margin-left:10px; color:red;'>Please enter valid Email</spen>";
				}
				if(strlen($password)<8){
					$errors['ps']="<spen class='error' style='margin-left:10px; color:red;'>password must be more than 8</spen>";
				}
			
			}
			  else
			{
                  $sql="select * from admin where email='".$email."'";
					$q=$con->prepare($sql);
					if($q->execute())
					if($q->rowcount()>0)
					{
						$s="select password from admin where email='".$email."'";
						$q=$con->prepare($sql);
						$ss=$q->execute();
						$s=$q->fetch();
						if(password_verify($password,$s['3']))
							{
								$_SESSION['userid']=$s['id'];
								$_SESSION['AName']=$_POST['uid'];
								$_SESSION['Aemail']=$_POST['mail'];
								
								echo "<script>alert('welcome Admin ".$_SESSION["AName"]."');</script>";
								header('REFRESH:1;URL=controlpanel/index.php');
							}
						}
                  else{
				$sql="select * from user where email='".$email."'";
					$q=$con->prepare($sql);
					$q->execute();
					$row=$q->fetch();
				if($_POST['uid']==$row['name'])
				{
					if(password_verify($password, $row[3]))
					{
						$_SESSION["Name"]=$username;
						$_SESSION['userid']=$row[0];
						//echo "<h1 style='margin-left:600px;'>welcome ".$_SESSION["Name"]." ^_^</h1>";
						header('REFRESH:1;URL=index.php');
					}
					else
						$errors['ps']="<spen class='error' style='margin-left:10px; color:red;'>Wrong password</spen>";
				}
					
				else 
					echo "Something Wrong !! Make sure you sign up before"; 
				
                  }
			} 
		
	 }
		 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="s.css" rel="stylesheet">
</head>
<body style="background:rgba(255, 160, 122, 0.86);
    padding-top: 60px;
    font-size: 14px;
    color: #444444;">
		<div class="colo">
            <?php if(!empty($_SESSION["Name"]))
                echo "<h1 style='margin-left:200px;'>Welcome ".$_SESSION["Name"]." </h1><br>";
            ?>
			<div class="login">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
                    
							<form class="login1" action="" method="post">
											<div class="form-group">
											<label style="padding-left:10px;">Enter Email Address:</label><br>
											<input class="form-control" type="text" name="mail" placeholder="user@gmail.com"><br><br>
											<?php if (isset($errors['email'])) echo $errors['email'] ?>
											<?php if (isset($errors['mail'])) echo $errors['mail'] ?>
											</div>
											<div class="form-group">
											<label style="padding-left:10px;">Enter User name</label><br>
											<input class="form-control" type="text" placeholder="more than 5" name="uid"><br><br>
											<?php if (isset($errors['name'])) echo $errors['name'] ?>
											<?php if (isset($errors['uname'])) echo $errors['uname'] ?>
											</div>
											<div class="form-group">
											<label style="margin-left:10px;">Enter Password</label><br>
											<input class="form-control" type="password" name="pwd" placeholder="more than 8"><br>
											<?php if (isset($errors['password'])) echo $errors['password'] ?>
											<?php if (isset($errors['ps'])) echo $errors['ps']?>
											</div>
											<!--<div class="checkbox">
											<label>
											<input name="remember" type="checkbox" value="Remember Me">Remember Me
											</label>
											</div>-->
                                            <label style="margin:10px; margin-top:-500px;"><a href="signup.php" style="font-family: Montserrat;
	                                        font-size:16px;">Not registerd yet?</a></label><br>
											<input type="submit" name="Log-in" class="btn" value="log in" style="margin:10px;">
											</form>
				</div>
			</div>
                <h3 style="font-size:22px;margin:20px;margin-left:160px;"><a href="index.php"style="color:#fff;">Back to the main page</a></h3>
		</div><!-- /.col-->
</body>
</html>
