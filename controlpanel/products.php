<?php
@SESSION_START();
if(isset($_SESSION["AName"])){
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$type=$_POST['type'];
		$price=$_POST['price'];
		$location=$_POST['location'];
			if(empty($type)|| empty($price) || empty($location)){
				if(empty($type))
				{
					$errors['type']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your name </spen>";
				}
				if(empty($price))
				{
					$errors['price']="<span class='error' style='margin-left:10px; color:red;'>Please Enter your Email</spen>";
				}
				if(empty($location))
				{
					$errors['location']="<spen class='error' style='margin-left:10px; color:red;'>Please Enter your password</spen>";
				}
				
			}
}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
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
	?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active"> Products</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Product Table</h1>
			</div>
		</div><!--/.row-->
					
		<?php
		// if($_SERVER['REQUEST_METHOD']=="POST"){
			
		
			if(isset($_GET['action'],$_GET['id'])){
					switch($_GET['action']){
						
						
						//if(isset($_POST['submit'])){
								
						
						case "edit":
						echo "<script>alert('edit')</script>";
						$sql="select * from product where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1){
							
							$row=$q->fetch();
							$id=$row['id'];
							$idadmin=$row[1];
							$type=$row[2];
							//$password=$row[3];
							$price=$row[3];
							$location=$row[4];
						}
						
						break;
							
						case "delete":
						$sql="delete from product where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						//echo "Delete".$_GET['id'];
						break;
						}
				}
				if(isset($_POST['submit']) and !empty($_POST['id'])){
						
						$id=$_POST['id'];
								$type=$_POST['type'];
							//$idadmin=$_POST['idadmin'];
							$price=$_POST['price'];
							$location=$_POST['location'];
								$sql="update product set id_admin=:a,type=:b,price=:c,location=:d where id=:sid";
								$q=$con->prepare($sql);
					
								$q->execute(array("a"=>$_SESSION['userid'],"b"=>$type,"c"=>$price,"d"=>$location,"sid"=>$id));
								echo $q->rowcount();
		
		
			
						}
						else if(isset($_POST['submit']) and empty($_POST['id'])){
						
								$sql="insert into product (id_admin,type,price,location) values (:id,:t,:p,:l)";
					$q=$con->prepare($sql);
					$q->execute(array("id"=>$_SESSION['userid'],"t"=>$_POST['type'],"p"=>$_POST['price'],"l"=>$_POST['location']));
						}
				// }
		?>

<!--------------------------------------------------------------------------------------->	
	                           
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
				
				<div class="content" style="padding:50px;">
					<h1>Edit profile</h1>
						<br>
                                <form method="post" >
								<div  class="aaa">
									<input  type="hidden" id="id" name="id" value="<?php if(isset($id))echo $id  ?>" readonly>
                                    <!--<input  type="hidden" id="i" name="id-admin" value="" readonly>-->
                                    <div class="row">
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" id="type" name="name" class="form-control" placeholder="Name" value="<?php if(isset($name)) echo $name  ?> ">
												<?php if (isset($errors['type'])) echo $errors['type'] ?>
											</div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price</label>
                                                <input type="text" name="price" class="form-control" style="margin-left:15px;" placeholder="price" value="<?php if(isset($price)) echo "$".$price; ?>">
												<?php if (isset($errors['price'])) echo $errors['price'] ?>
											</div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>List</label>
                                                <input type="text" id="list" name="list" class="form-control" placeholder="List" value="<?php if(isset($extra)) echo $extra  ?> ">
												<?php if (isset($errors['type'])) echo $errors['type'] ?>
											</div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input type="text" name="Type" class="form-control"  placeholder="Type" value="<?php if(isset($type)) echo $type  ?>">
												<?php if (isset($errors['location'])) echo $errors['location'] ?>
											
                                            </div>
                                            
                                            <div class="form-group">
                                            <div class="col">
                                            <textarea name="message" id="message" cols="35" rows="8" class="form-control" placeholder="Disception" value="<?php if(isset($disc)) echo $disc  ?>"></textarea>
                                            </div>
                                            </div>
                                           
                                            <button type="submit" name="submit" value="save" class="btn btn-info btn-fill pull-right" style=" margin-right:-100px;">Update Profile</button>
                                        </div>
                                        <br><br>
												

                                    </div>

                                    </div>
                                </form>
                            </div><br><br><br>
				<?php
	
	$sql="select * from product";
				$q=$con->prepare($sql);
				$q->execute();
				
				if($q->rowcount()>0){
					
					// echo $q->rowcount();
					echo "<table border='5' style=\"margin-left:60px\">";
					echo "<tr>";
					echo "<th>ID</th>";
                    echo "<th>Name</th>";
					echo "<th>Describtion</th>";
				    echo "<th>Extra info</th>";
                    echo "<th>Type of Product</th>";
					echo "<th>Price</th>";
                    echo "<th>Image</th>";
					echo "<th colspan='2'>Action</th>";
					echo "</tr>";
					
					$rows=$q->fetchall();
					foreach($rows as $row){
						$id=$row['id'];//[0]
						$name=$row[1];
						$disc=$row[2];
						$extra=$row[3];
						$type=$row[4];
                        $price=$row[5];
                        $img=$row[6];
						echo "<tr>";
						echo "<td>$id</td>";
						echo "<td>$name</td>";
						echo "<td>$disc</td>";
						echo "<td>$extra</td>";
						echo "<td>$type</td>";
                        echo "<td>$price</td>";
                        echo "<td><img src='../$img' style='height:50px;margin-left:15px;'></td>";
						echo "<td style='padding:2px;'><a href='?action=edit&id=$id'><i class='fa fa-edit'></i></i></a></td>";
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
			
			
	
	
	
			//rooooooomm--------------------------------------------->
			
		
             
				require("footer.php");

		}
else
	header('location:new.php');
			?>
		</div><!--/.row-->
		
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
