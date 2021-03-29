<!DOCTYPE html>
<html>
	<head>
	<?php
		require("header.php");
	?>
	</head>
	<body>
		
<img src="images/b1.jpg" class="k">
		<br>
		
			<div class="thumb">
					<img src="images/s1.jpg" id="myImage" onclick="changeImage()">
<script>
function changeImage() {
    var image = document.getElementById('myImage');
    if (image.src.match("s1")) {
        image.src = "images/s5.jpg";
    }
	else if (image.src.match("s5")) {
        image.src = "images/s4.jpg";
    }	else {
        image.src = "images/s1.jpg";
    }
}
</script>
				<div class="dis">
					<a href="stuff.php?type=Baby stuff"><h2>Baby Stuff</h2><a>
				<p>
					<div style="margin-left:350px;">
					<li>Car seat clicks easily into stroller with included adapterLarge storage basket for on-the-go essentials</li>
					<li>Large storage basket for on-the-go essentials</li>
					</div>
				</p>
				</div>
			</div>
			<div class="thumb1">
					<img src="images/j7.jpg" id="myImage2" onclick="changeImage2()">
<script>
function changeImage2() {
    var image = document.getElementById('myImage2');
    if (image.src.match("j7")) {
        image.src = "images/j6.jpg";
    }
	else if (image.src.match("j6")) {
        image.src = "images/j2.jpg";
    }	else {
        image.src = "images/j7.jpg";
    }
}
</script>
				<div class="dis">
					<a href="stuff.php?type=Toys"><h2>Baby Toy</h2></a>
					<p>
					Help baby learn numbers while teaching him important motor skills with his favorite characters on this wood puzzle!
				</p>
				</div>
			</div>
<?php
		require("footer.php");
	?>
	</body>
</html>