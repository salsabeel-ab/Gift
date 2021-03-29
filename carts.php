<!DOCTYPE html>
<html>
<head>
<?php
		require("header.php");
	?>
</head>
	<body>
        <div class="con">
            <fieldset class="roow">
				<legend>Cart</legend>
					
						<br>
						<br>
						
						<table>
						  <tr>
							<th colspan="2"></th>
							<th></th>
							<th style='text-align:left;'>Product</th>
							
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						  </tr>
						  
						  <?php 
						  if(empty($_SESSION["userid"])){
							echo '<tr>
								<th style="height:50px">1</th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
							</tr>
							<tr>
								<th style="height:50px">2</th>
							</tr>
							</table>';
						  }
						if(!empty($_SESSION["userid"])){
						
						
						$sql="select * from orders o INNER JOIN product p ON o.pid=p.id where uid=:uid";
						$q=$con->prepare($sql);
						$q->execute(array("uid"=>$_SESSION["userid"]));
				if($q->rowcount()>0){
						  $rows=$q->fetchall();
						foreach($rows as $row){
						//$color=$row['color'];
						$name=$row['name'];
						$price=$row['price'];
						$id=$row['uid'];
						$pid=$row['id'];
						$qty=$row['qty'];
						$img=$row['img'];
						$total=$qty*$price;
								$sql="update orders set total=:n where pid=:id and uid=:u";
								$q=$con->prepare($sql);
								$q->execute(array("n"=>$total,"id"=>$pid,"u"=>$_SESSION["userid"]));
						
						echo " <form method='post'> <tr>";
						echo "<td style='padding:2px;'><a href='?action=edit&id=$id&pid=$pid' style='color:#333;'><i class='fa fa-edit'></i></a></td>";
						echo"	<td style='padding:2px;color:red;'><a href='?action=delete&id=$id&pid=$pid' style='color:#333;'><i class='fa fa-trash'></i></a></td>
							<td ><img src='$img' style='margin-left:50px;'></td>
							<td style='text-align:left;'>$name</td>
							<td>$$price</td>
							<td><input type='number' name='num' size='2' min='1' maxlength='2' value=".$qty." style='width:50px'></td>
							<td>$$total</td> 
						  </tr>
					";}
					if(isset($_GET['action'],$_GET['id']))
					{
						if($_GET['action']=="del")
						{
							if(empty($_POST['save']) && empty($_POST['proceed'])){
								$sql="delete from orders where uid=:u";
								$q=$con->prepare($sql);
								$q->execute(array("u"=>$_GET['id']));
							}
						}
					}
					if(isset($_GET['action'],$_GET['id'],$_GET['pid'])){
							switch($_GET['action']){
							
							
							case "edit":
							if(empty($_POST['save']) && empty($_POST['proceed'])){
							$sql="select * from orders where pid=".$_GET['pid'];
							$q=$con->prepare($sql);
							$q->execute();
							if($q->rowcount()==1){
								//echo "<script>alert('edit the quantity then press update button')</script>";
							}
							break;
							}
						
							case "delete":
							/////////////////////////////////////
							if(empty($_POST['save']) && empty($_POST['proceed'])){
								$sql="delete from orders where pid=:p and uid=:u";
								$q=$con->prepare($sql);
								if($q->execute(array("p"=>$_GET["pid"],"u"=>$_GET["id"])))
								echo "<script>alert(".$name." is deleted)</script>";
								
							}
							break;
							
							}
							if(isset($_POST['save']) and !empty($_GET['pid']) and empty($_POST['proceed'])){
								$n=$_POST['num'];
								$sql="update orders set qty=:n where pid=:id and uid=:u";
								$q=$con->prepare($sql);
								$q->execute(array("n"=>$_POST['num'],"id"=>$_GET['pid'],"u"=>$_GET['id']));
							}
							
							
								}
								
							}
							else{
								echo '<tr>
								<th style="height:50px">1</th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
								<th style="height:50px"></th>
							</tr>
							<tr>
								<th style="height:50px">2</th>
							</tr>
							</table>';
					echo "<div style='margin:20px;'>
					<p>No products selected yet</p>
					</div>";
						}
						}
						
					////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////
					///////////////total should be added/inserted to orders table//////////
					///////////////////////////////////////////////////////////////////
						///////////////////////////////////////////////////////////
						?></table>
						<div class="button">
							<button name="save" class="btn">Update Cart</button>
							
							<a href="index.php" style="font-size:19px;" class="btn">Continue Shopping</a>
							
						</div>
						
						<div class="cont">
							<div class="cert">
							<h2 style="font-size:25px;">Shipping Method</h2>
								<div class="tot">
									<input type="radio" name="r1" value="Nextday"></a>Next day delivery<br>
									<div class="pri">$100</div>
									<input type="radio" name="r1" value="Standerd"></a>Standerd delivery<br>
									<div class="pri">$60</div>
									<input type="radio" name="r1" value="free"></a>Personal pick up<br>
									<div class="pri">Free</div>
									<br>
									<br>
								</div>
							</div>
							<?php 
									if(!empty($_SESSION['userid']))
									{
								echo '
							<div class="cert">
							<h2 style="font-size:25px;">Cart Total</h2>
								<div class="tot">
								<div class="sp">
									<span>Shipping</span><br>
									<div class="pri">';if(!empty($_POST['r1']))echo $_POST['r1'];else echo "Free";echo'</div>
								</div>
								<div class="sp">
									<span>SubTotal</span><br>
									<div class="pri">$';
									$sql="SELECT uid,sum(total) as s from orders o inner join product p on o.pid=p.id where uid=:uid ";
									$q=$con->prepare($sql);
									$q->execute(array("uid"=>$_SESSION['userid']));
									$row=$q->fetch();
									echo $row['s'];echo '</div>'; ?>
								</div>
								
								<div class="sp">
									<p>Total</p>
									<div class="pri">$<?php 
											if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['proceed']) && empty($_POST['save'] )&& empty($_GET['action']) && !empty($_POST['r1']))
											{
												switch($_POST['r1'])
												{
													case"Nextday":
													echo $finaltotal=$row['s']+100;
													break;
													case"Standerd":
													echo $finaltotal=$row['s']+60;
													break;
													default:
													$finaltotal=$row['s'];
													break;
													echo '</div>'; }
											}
											else
												echo $row['s'];
								echo'	</div>
								</div>
								<div style="margin-left:90px;">
								<input name="proceed" class="btn proceed" type="submit" value="Proceed Checkout">';
									echo"<td style='margin-left:20px;'><a href='?action=del&id=$_SESSION[userid]' style='color:rgb(109,209,188);'><i class='fa fa-trash'></i></a></td>
							</div>";
									}
											/* else
												echo '</div><span>Total</span><br>
												<div class="pri"></div>';
												 */
											?>
								</div>
							</div>
						</form>
						</div>
						
			</fieldset>
        </div>
    <?php
		require("footer.php");
	?>
	</body>
</html>
