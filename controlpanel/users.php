<?php
@SESSION_START();
if(isset($_SESSION["AName"])){
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
			if(empty($username)|| empty($email) ){
				
				if(empty($username))
				{
					$errors['name']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your name </spen>";
				}
				if(empty($email))
				{
					$errors['email']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your Email</spen>";
				}
				/* if(empty($password))
				{
					$errors['password']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your password</spen>";
				} */
				
			}
			else if(strlen($username)<5 || !filter_var($email,FILTER_VALIDATE_EMAIL)  )
			{
				if(strlen($username)<5){
					$errors['uname']="<span class='error' style='margin-left:10px; color:red;'>Name must be more than 5</spen>";
				}
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$errors['mail']="<span class='error' style='margin-left:10px; color:red;'>Please enter valid Email</spen>";
				}
				/* if(strlen($password)<8){
					$errors['ps']="<span class='error' style='margin-left:10px; color:red;'>password must be more than 8</spen>";
				} */
			
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users</title>
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
				<li class="active">Users</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Users Table</h1>
			</div>
		</div><!--/.row-->
				<?php
			
				if(isset($_GET['action'],$_GET['id'])){
					switch($_GET['action']){
						
						case "edit":
						
						$sql="select * from user where id=:sid";
						//echo "<script>alert('edit')</script>";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1){
							
							$row=$q->fetch();
							$id=$row['id'];
							$name=$row[1];
							$email=$row[2];
							$password=$row[3];
						}
						break;
							/* if(isset($name)){
								$sql="update admin set name=:sname ,email=:mail,pwd=:spass,phone=:sphone,country=:country  where id=:sid";
								$q=$con->prepare($sql);
								//$q->execute(array("sname"=>$n));
								$q->execute(array("sname"=>$_POST['name'],"mail"=>$m,"pwd"=>password_hash($password, PASSWORD_DEFAULT),"phone"=>$_POST['phone'],"country"=>$_POST['country']));
							}
							else{
								$m='<a href="">'.$_POST['email'].'</a>';
								$sql="insert into admin(name,email,phone,country) values (:uid,:mail,:phone,:country)";
								$q=$con->prepare($sql);
								$q->execute(array("uid"=>$_POST['name'],"mail"=>$m,"pwd"=>password_hash($password, PASSWORD_DEFAULT),"phone"=>$_POST['phone'],"country"=>$_POST['country']));
							}
						}	
						 */
						
						break;
						case "delete":
						$sql="delete from user where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						//echo "Delete".$_GET['id'];
						break;
						case "active":
						$sql="update user set state='1' where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1)
						{
							echo "Active done";
						}
						//echo "ACTIVE".$_GET['id'];
						break;
						case "unactive":
						$sql="update user set state='0' where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1)
						{
							echo "Unactive done";
						}
						//echo "UNACTIVE".$_GET['id'];
						break;
						default:echo "ERROR";break;
					}
				}
				if(isset($_POST['save']) and !empty($_POST['id'])){
						
							$id=$_POST['id'];
							$name=$_POST['name'];
							$email=$_POST['email'];
                            $credit=$_POST['credit'];
							if(1){
								 //echo "<script>alert('pass')</script>";
								 $sql="update user set name=:name,email=:email,password=:password,creditcard=:c where id=:sid";
								$q=$con->prepare($sql);
$q->execute(array("name"=>$name,"email"=>$email,"password"=>password_hash($_POST['password'],PASSWORD_DEFAULT),"c"=>$_POST['credit'],"sid"=>$id));
								echo $q->rowcount();
							 }
							 if($_POST['password']!=0){
								 $sql="update user set name=:name,email=:email,creditcard:c where id=:sid";
								 //echo "<script>alert('no pass')</script>";
								$q=$con->prepare($sql);
								$q->execute(array("name"=>$name,"email"=>$email,"sid"=>$id,"c"=>$_POST['credit']));
								echo $q->rowcount();
							 }
						}
						else if(isset($_POST['save']) and empty($_POST['id'])){
						
								$sql="insert into user(name,email,password,creditcard) values (:uid,:mail,:pwd,:c)";
								
					$q=$con->prepare($sql);
					$q->execute(array("uid"=>$_POST['name'],"mail"=>$_POST['email'],"pwd"=>password_hash($_POST['password'], PASSWORD_DEFAULT),"c"=>$_POST['credit']));
                        echo "<script>alert('insert')</script>";
						}
				// }
				?>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
				
				<div class="content" style="padding:50px;">
					<h1>Edit profile</h1>
						<br>
                                <form method="post" >
								<div  class="aaa">
									<input  type="hidden" id="id" name="id" value="<?php if(isset($id))echo $id  ?>" readonly>
                
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Credit Card</label>
                                                <input type="text" id="credit" name="credit" value="<?php if(isset($credit)) echo $credit  ?>" class="form-control" placeholder="credit card" >
												<?php if (isset($errors['name'])) echo $errors['name'] ?>
												<?php if (isset($errors['uname'])) echo $errors['uname'] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="password"><br><br>
												<?php if (isset($errors['password'])) echo $errors['password'] ?>
												<?php if (isset($errors['ps'])) echo $errors['ps']?>
												<button type="submit" name="save" value="save" class="btn btn-info btn-fill pull-right">Update Profile</button>

											</div>
                                        </div>
                                       
                                    </div>

                                    </div>
                                </form>
                            </div><br><br><br>
				
				<?php
			
				$sql="select * from user";
				$q=$con->prepare($sql);
				$q->execute();
				
				if($q->rowcount()>0){
					
					// echo $q->rowcount();
					echo "<table border='5' style=\"margin-left:60px\">";
					echo "<tr>";
					echo "<th>ID</th>";
					echo "<th>Name</th>";
					echo "<th>Email</th>";
                    echo "<th>Credit card</th>";
					echo "<th colspan='3'>Action</th>";
					echo "</tr>";
					
					$rows=$q->fetchall();
					foreach($rows as $row){
						$id=$row['id'];//[0]
						$name=$row[2];//['name']
						$email=$row[1];//['email']
                        $credit=$row[4];//['credit']
						echo "<tr>";
						echo "<td>$id</td>";
						echo "<td>$name</td>";
						echo "<td>$email</td>";
                        echo "<td>$credit</td>";
						echo "<td style='padding:2px;'><a href='?action=edit&id=$id'><i class='fa fa-edit'></i></a></td>";
						echo "<td style='padding:2px;'><a href='?action=delete&id=$id'><i class='fa fa-trash'></i></a></td>";
						
						
						
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
