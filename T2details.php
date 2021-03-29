<!DOCTYPE html>
<html>
	<head>
	<?php
		require("header.php");
        $id=$_GET["id"];
        //echo $id;
	?>
	</head>
	<body>
	
	<div class="con">
    <fieldset class="roow">
         <?php
				$sql="select * from product where id='".$id."'";
                $q=$con->prepare($sql);
				$q->execute();
						$s=$q->fetch();
						
						if($q->rowcount()){
                            
							$sid=$s[0];
                            $type=$s['type'];
                            $name=$s['name'];
                            $disc=$s['disc'];
                            $list=$s['list'];
                            $img=$s['img'];
                            $price=$s['price'];
                        }
        
                echo'
	<legend>Products/'.$type.'/Details</legend>
		<div class="details">
			<div class="detail">
				<img src="'.$img.'">
               
					<h2 style="margin-top:20px;">'.$name.'</h2>
					<p>'.$disc.'</p>
				<div style="margin-left:460px;">'.$list.'</div>
			</div>
			';
				if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_SESSION['userid']))
					{
						$pro=$name;
						$sql="select * from product where name='".$pro."'";
						$q=$con->prepare($sql);
						$q->execute();
						$s=$q->fetch();
						$uid=$_SESSION['userid'];
						if($q->rowcount()==1){
							$order_id=$s[0];
							$sql="select * from orders where uid=".$_SESSION["userid"]." and pid=".$order_id; 
							$q=$con->prepare($sql);
							$q->execute();
							$s=$q->fetch();
							if($q->rowcount()==1 )//&& $s['color']==$color
							{
								$n=$s['qty'];
								$sql="update orders set qty=:n where pid=:id and uid=:u";
								$q=$con->prepare($sql);
								if($q->execute(array("n"=>$n+1,"id"=>$order_id,"u"=>$_SESSION["userid"])))
								echo "<script>alert('$pro is added again')</script>";
							}	
							else{
								$sql="insert into orders(uid,pid,qty,shipping) values (:uid,:pid,:qty,:ship)";
								$q=$con->prepare($sql);
								if($q->execute(array("uid"=>$uid,"pid"=>$order_id,"qty"=>'1',"ship"=>"free")))
								echo "<script>alert('$pro is added to cart')</script>";
							}
						}
					}
					else if(!empty($_POST['s']) && empty($_SESSION['userid']))
					{
						if(!empty($_SESSION['Name']))
							echo '<script>alert("Log out then log in to start shopping")</script>';
						else
							echo '<script>alert("You Should sign up first !")</script>'; 
					}
					
			echo'
			<div class="d1">
			<form action="" method="post" >
                <h2><span>Price: $'.$price.'</span>
			<input type="submit" name="s" class="btn b" style="margin-left:-25px;font-size:25px;" value="Buy Now" >
			</form>
		';?>
		
	</fieldset>
	</div>
    
	<?php
		require("footer.php");
	?>
	</body>
</html>