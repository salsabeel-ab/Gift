<!DOCTYPE html>
<html>
	<head>
	<?php
		require("header.php");
        $type=$_GET["type"];
	?>
	</head>
	<body>
	<style>
	img:hover{
	box-shadow: 2px 4px 10px #ffa07a;
	}
        
	</style>
        
	<div class="con">
    <fieldset class="roow">
	<legend>Products/<?php echo $type; ?></legend>
		<div class="pro1">
            <?php 
        
        //echo $type;
        $sql="select * from product where type='".$type."'";
        $q=$con->prepare($sql);
        $q->execute();
			//$s=$q->fetch();
        if($q->rowcount()){
       // $s=$q->rowcount();
			//while($s>0){
                //echo "0";
        echo "<table cellpadding='3em'><tr>";					
		$rows=$q->fetchall();
        foreach($rows as $row)
		{
				$sid=$row[0];
                $name=$row['name'];
                $img=$row['img'];
                $price=$row['price'];
                
            echo '<div class="services">
			<a href="T2details.php?id='.$sid.'"><img src='.$img.' style="height:350px;"></a>
			<p>'.$name.'</p><h3>'.$price.'</h3> <a href="T2details.php?id='.$sid.'"><button class="btn">view</button></a>
		</div>';
            }
        }
        ?>
		<!--<div class="services">
			<a href="T2details.php?id=1"><img src="images/s6.jpg" style="height:350px;"></a>
			<p>Finish Baby Box</p><h3>$399.00</h3> <a href="T2details.php?id=1"><button class="btn">view</button></a>
		</div>
		<div class="services">
			<a href="T2details.php?id=2"><img src="images/s4.jpg" style="height:350px;"></a>
			<p>Linen Standerd Crib</p><h3>$369.99 </h3> <a href="T2details.php?id=2"><button class="btn">view</button></a>
		</div>
		<div class="services">
			<a href="T2details.php?id=3"><img src="images/s1.jpg" style="height:350px;"></a>
			<p>Mini Sport Travel System - Carbon</p><h3>$299.99 </h3> <a href="T2details.php?id=3"><button class="btn">view</button></a>
		</div>
		<div class="services">
			<img src="images/s3.jpg" style="height:350px;">
			<p>Sterilizes & Accessories</p><h3>$120.99</h3> <button class="btn">view</button>
		</div>
		<div class="services">
			<img src="images/s5.jpg" style="height:350px;">
			<p>Convertible Crib and Changer</p><h3>$319.99</h3><button class="btn">view</button>
		</div>
		<div class="services">
			<img src="images/s2.jpg" style="height:350px;">
			<p>Baby $ Toddler Cubs</p><h3>$99.00 </h3><button class="btn">view</button>
		</div>
		</div>
        -->
    </div> 
	</fieldset>
	
    </div>
        <span style="height:100px;" name="span"></span>
	<?php
		require("footer.php");
	?>
	</body>
    
</html>