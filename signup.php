 <?php require("conn.php");
 SESSION_START();
?>
 <?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
		$username=$_POST['uid'];
		$email=$_POST['mail'];
		$card=$_POST['card'];
		$password=$_POST['pwd'];
		$passwordrepeat=$_POST['pwd-repeat'];
			if(empty($username)|| empty($email) || empty($password) || empty($passwordrepeat )|| empty($card)){
				if(empty($username))
				{
					$errors['name']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your name </spen>";
				}
				if(empty($email))
				{
					$errors['email']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your Email</spen>";
				}
				if(empty($card))
				{
					$errors['c']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your credit card</spen>";
				}
				if(empty($password))
				{
					$errors['password']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your password</spen>";
				}
				if(empty($passwordrepeat))
				{
					$errors['r-password']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter password varify</spen>";
				}
			}
			else if(strlen($username)<5 or strlen($card)<5 or !filter_var($email,FILTER_VALIDATE_EMAIL) or strlen($password)<8 or $password !== $passwordrepeat)
			{
				if(strlen($username)<5){
				$errors['uname']="<spen class='error' style='margin-left:10px; color:red;'>Name must be more than 5</spen>";
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$errors['mail']="<spen class='error' style='margin-left:10px; color:red;'>Please enter valid Email</spen>";
			}
				if(strlen($card)<5){
				$errors['cc']="<spen class='error' style='margin-left:10px; color:red;'>credit card must be more than 5</spen>";
			}
			if(strlen($password)<8){
				$errors['ps']="<spen class='error' style='margin-left:10px; color:red;'>password must be more than 8</spen>";
			}
			if($password !== $passwordrepeat)
			{
				$errors['varify']="<spen class='error' style='margin-left:10px; color:red;'>Passwords doesn't match</spen>";
			}
		}
		else
		{
			$sql="insert into user(email,name,password,creditcard) values (:mail,:uid,:pwd,:card)";
			$q=$con->prepare($sql);
			if($q->execute(array("mail"=>$email,"uid"=>$username,"pwd"=>password_hash($password, PASSWORD_DEFAULT),"card"=>$card)))
			{
				//$_SESSION["Name"]=$username;
				//$_SESSION["Pass"]=$password;
                //echo "<h1 style='margin-left:600px;'>welcome ".$_SESSION["Name"]." ^_^</h1>";
                header('REFRESH:2;URL=login.php');
			}
            else
			echo "<h1 style='margin-left:450px;'>Something Wrong, maybe this email is already used! </h1>";
        }
		
			
		
		
		}
		

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign up</title>
	<link href="s.css" rel="stylesheet">
</head>
<body style="background:rgba(255, 160, 122, 0.86);
    padding-top: 60px;
    font-size: 14px;
    color: #444444;">
		<div class="colo" style="margin-left:27%">
			<div class="login" style="width:60%">
				<div class="panel-heading">Sign up</div>
				<div class="panel-body">
							<form class="login1" action="" method="post">
											<div class="form-group">
											<label style="padding-left:10px;">Enter Email Address:</label><br>
											<input class="form-control" type="text" name="mail" placeholder="user@gmail.com"><br>
											<?php if (isset($errors['email'])) echo $errors['email'] ?>
											<?php if (isset($errors['mail'])) echo $errors['mail'] ?>
											</div>
											<div class="form-group">
											<label style="padding-left:10px;">Enter User name</label><br>
											<input class="form-control" type="text" placeholder="more than 5" name="uid"><br>
											<?php if (isset($errors['name'])) echo $errors['name'] ?>
											<?php if (isset($errors['uname'])) echo $errors['uname'] ?>
											</div>
											<div class="form-group">
											<label style="padding-left:10px;">Enter Credit card number</label><br>
											<input class="form-control" type="text" placeholder="more than 5" name="card"><br>
											<?php if (isset($errors['c'])) echo $errors['c'] ?>
											<?php if (isset($errors['cc'])) echo $errors['cc'] ?>
											</div>
											<div class="form-group">
											<label style="margin-left:10px;">Enter Password</label><br>
											<input class="form-control" type="password" name="pwd" placeholder="more than 8"><br>
											<?php if (isset($errors['password'])) echo $errors['password'] ?>
											<?php if (isset($errors['ps'])) echo $errors['ps'] ?>
											</div>
											<div class="form-group" style="height: 120px;">
											<label style="margin:10px;">Repeat Password</label><br>
											<input class="form-control" type="password" name="pwd-repeat" placeholder="repeat password"><br>
											<?php if (isset($errors['r-password'])) echo $errors['r-password'] ?>
											<?php if (isset($errors['varify'])) echo $errors['varify'] ?><br>
											</div>
											<!--<div class="form-group">
											<label style="margin-left:10px;">Gander:</label><br><br>
											<input  name='gander' type='radio' value='male' style="margin-left:10px;" checked ><label for='male'>Male</label><br>
											<input  name='gander' type='radio'   value='female' style="margin-left:10px;"><label for='female'>female</label><br>
											</div>-->
                                            <label style="margin:10px; margin-top:-500px;"><a href="login.php" style="font-family: Montserrat;
	                                        font-size:16px;">Already registerd?</a></label><br>
											<input type="submit" name="Sign-up" style="margin:10px;" class="btn" value="sign up" >
											</form>
				</div>
			</div>
            <h3 style="font-size:22px;margin:20px;margin-left:160px;"><a href="index.php"style="color:#fff;">Back to the main page</a></h3>
		</div><!-- /.col-->
</body>
</html>
