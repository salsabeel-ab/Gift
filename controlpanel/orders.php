<?php
@SESSION_START();
if(isset($_SESSION["AName"])){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel='stylesheet' href="css/font-awesome.min.css" />
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
	?>
	
	
		<!----------------------------------------->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<div class="row">
<div class="panel panel-default">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Orders</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Orders Table</h1>
			</div>
		</div><!--/.row-->
			
				<div class="content">
			<?php	if(isset($_GET['action'],$_GET['id'])){
					switch($_GET['action']){
						
						case "delete":
						$sql="delete from orders where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						//echo "Delete".$_GET['id'];
						break;
						
						case "active":
						
						// echo "Active".$_GET['id'];
						$sql="update orders set action='1' where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1){
							echo "Active Done";
						}	
						
						break;
						case "unactive":
						// echo "inactive".$_GET['id'];
						$sql="update orders set action='0' where id=:sid";
						$q=$con->prepare($sql);
						$q->execute(array("sid"=>$_GET['id']));
						if($q->rowcount()==1){
							echo "Unactive Done";
						}	
						break;
						default:echo "Error";break;
					}
				}
				$sql="select * from orders";
				$q=$con->prepare($sql);
				$q->execute();
				
				if($q->rowcount()>0){
					
					// echo $q->rowcount();
					echo "<table border='5' style=\"margin-left:60px\">";
					echo "<tr>";
					echo "<th>Product ID</th>";
					echo "<th>User Name</th>";
					echo "<th>Quantity</th>";
					echo "<th>Total</th>";
                    echo "<th>Action</th>";
					echo "</tr>";
					
					$rows=$q->fetchall();
					foreach($rows as $row){
						$uid=$row['uid'];
                        $pid=$row['pid'];
						$qnt=$row[2];
						$total=$row[4];
                        $sql="select * from user where id=:i";
                        $q=$con->prepare($sql);
                        $q->execute(array("i"=>$uid));
                        $r=$q->fetch();
                        $uname=$r['name'];
                        $sql="select * from product where id=:id";
                        $q=$con->prepare($sql);
                        $q->execute(array("id"=>$pid));
                        $r=$q->fetch();
                        $pname=$r['name'];
						echo "<tr>";
						echo "<td>$uname</td>";
                        echo "<td>$pname</td>";
						echo "<td>$qnt</td>";
						echo "<td>$total</td>";
						echo "<td><i class='fa fa-trash'></i></a></td>";
						
						echo "<tr>";
					}
					echo "</table>";
				}
				else{
					echo "Empty";
			}
			?>	
			</div>	
			</div>				
		</div> <!-- /.row -->
	<!------------------------------------------------- -->
			<?php
				require("footer.php");
}
else
	header('location:new.php');
			?>
		
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
