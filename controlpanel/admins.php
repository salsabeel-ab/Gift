<?php
@SESSION_START();
if(isset($_SESSION["AName"])){
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$country=$_POST['country'];
		$password=$_POST['password'];
			if(empty($username)|| empty($email) || empty($country) || empty($password)){
				
				if(empty($username))
				{
					$errors['name']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your name </spen>";
				}
				if(empty($email))
				{
					$errors['email']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your Email</spen>";
				}
				if(empty($password))
				{
					$errors['password']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your password</spen>";
				}
				if(empty($country))
				{
					$errors['country']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your country</spen>";
				}
				
			}
			else if(strlen($username)<5 || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($phone)<9 || strlen($password)<8)
			{
				if(strlen($username)<5){
					$errors['uname']="<span class='error' style='margin-left:10px; color:red;'>Name must be more than 5</spen>";
				}
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$errors['mail']="<span class='error' style='margin-left:10px; color:red;'>Please enter valid Email</spen>";
				}
				if(strlen($password)<8){
					$errors['ps']="<span class='error' style='margin-left:10px; color:red;'>password must be more than 8</spen>";
				}
				if(strlen($phone)<9){
					$errors['ph']="<span class='error' style='margin-left:10px; color:red;'>phone must be more than 9</spen>";
				}
			
			}
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admins</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
<!--	<link href="css/pe-icon-7-stroke.css" rel="stylesheet">
		<link href="css/light-bootstrap-dashboard.css" rel="stylesheet"> */

	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
	<?php
		require("header.php");
		//require("conn.php");
	?>
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">admin</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Admin Table</h1>
			</div>
		</div><!--/.row-->
				
		<?php
			if(isset($_GET['action'],$_GET['id'])){
					switch($_GET['action']){
						case "edit":
						echo "<script>alert('edit')</script>";
						$sql="select * from admin where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1){
							
							$row=$q->fetch();
							$id=$row['id'];
							$name=$row[1];
							$email=$row[2];
							$password=$row[3];
							$phone=$row[4];
							$country=$row[5];
						}
						
						break;
							
						case "delete":
						$sql="delete from admin where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						//echo "Delete".$_GET['id'];
						break;
						default:echo "ERROR";break;
						}
				}
				if(isset($_POST['submit']) and !empty($_POST['id'])){
						
							$id=$_POST['id'];
							$name=$_POST['name'];
							$email=$_POST['email'];
							$password=$_POST['password'];
							$phone=$_POST['phone'];
							$country=$_POST['country'];
							//if(!empty($_POST['password']))
								
							//$q->execute(array("sname"=>$n));
							 if($_POST['password']!=0){
								 $sql="update admin set name=:name,email=:email,password=:password,phone=:phone,country=:country where id=:sid";
								$q=$con->prepare($sql);
								$q->execute(array("name"=>$name,"email"=>$email,"password"=>password_hash($_POST['password'],PASSWORD_DEFAULT),"phone"=>$phone,"country"=>$country,"sid"=>$id));
								echo $q->rowcount();
							  }/*
							 else{ 
								 $sql="update admin set name=:name,email=:email,phone=:phone,country=:country where id=:sid";
								$q=$con->prepare($sql);
								$q->execute(array("name"=>$name,"email"=>$email,"phone"=>$phone,"country"=>$country,"sid"=>$id));
								echo $q->rowcount();
							 }*/
						}
						else if(isset($_POST['submit']) and empty($_POST['id'])){
						
								$sql="insert into admin(name,email,password,phone,country) values (:uid,:mail,:pwd,:phone,:country)";
					$q=$con->prepare($sql);
					$q->execute(array("uid"=>$_POST['name'],"mail"=>$_POST['email'],"pwd"=>password_hash($_POST['password'], PASSWORD_DEFAULT),"phone"=>$_POST['phone'],"country"=>$_POST['country']));
						}
				// }
		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
				
				<div class="content" style="padding:50px;">
					<h1>Edit profile</h1>
						<br>
                                <form method="post" action="admins.php">
								<div  class="aaa">
									<input  type="hidden" id="id" name="id" value="<?php if(isset($id))echo $id  ?>" >
                
                                    <div class="row">
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" id="name" name="name" value="<?php if(isset($name)) echo $name  ?>" class="form-control" placeholder="Username" >
												<?php if (isset($errors['name'])) echo $errors['name'] ?>
												<?php if (isset($errors['uname'])) echo $errors['uname'] ?>
											</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="text" name="email" class="form-control" style="margin-left:15px;" placeholder="Email" value="<?php if(isset($email)) echo $email  ?>">
												<?php if (isset($errors['email'])) echo $errors['email'] ?>
												<?php if (isset($errors['mail'])) echo $errors['mail'] ?>
											</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control"  placeholder="phone" value="<?php if(isset($phone)) echo $phone  ?>">
												<?php if (isset($errors['ph'])) echo $errors['ph'] ?>
											</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control" style="margin-left:-70px;" placeholder="Country" value="<?php if(isset($country)) echo $country  ?>">
												<div  style="margin-left:-70px;"><?php if (isset($errors['country'])) echo $errors['country'] ?></div>
											</div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="password" ><br><br>
												<?php if (isset($errors['password'])) echo $errors['password'] ?>
												<?php if (isset($errors['ps'])) echo $errors['ps'] ?><br><br>
												<button type="submit" name="submit" value="save" class="btn btn-info btn-fill pull-right">Update Profile</button>

											</div>
                                        </div>
                                    </div>

                                    </div>
                                </form>
                            </div><br><br><br>
				<?php
		
				$sql="select * from admin";
				$q=$con->prepare($sql);
				$q->execute();
				
				if($q->rowcount()>0){
					
					// echo $q->rowcount();
					echo "<table border='5' style=\"margin-left:60px\">";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Name</th>";
					echo "<th>Email</th>";
					echo "<th>country</th>";
					echo "<th>phone</th>";
					echo "<th colspan='2'>Action</th>";
					echo "</tr>";
					
					$rows=$q->fetchall();
					foreach($rows as $row){
						$sid=$row['id'];//[0]
						$sname=$row[1];//['student_name']
						$semail=$row[2];//['email']
						$scountry=$row[5];//['country']
						$sphone=$row[4];//['mobile']
						echo "<tr>";
						echo "<td>$sid</td>";
						echo "<td>$sname</td>";
						echo "<td>$semail</td>";
						echo "<td>$scountry</td>";
						echo "<td>$sphone</td>";
						echo "<td style='padding:2px;'><a href='?action=edit&id=$sid'><i class='fa fa-edit'></i></i></a></td>";
						echo "<td style='padding:2px;'><a href='?action=delete&id=$sid'><i class='fa fa-trash'></i></a></td>";
						
						
						
						echo "</tr>";
						
					}
					echo "</table>";
					echo "</br>";
					echo "</br>";

				}
						
				else{
					echo "Empty";
			}
				require("footer.php");
				}
else
	header('location:new.php');
			
			?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
