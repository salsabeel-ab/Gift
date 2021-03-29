<!--
SESSION_START();
if(isset($_SESSION["name"])){

}
else
	echo "<h1 style='color:red;'>Sorry, You can't view this page </h1>";
-->

<h1 style='color:red;'><script>alert('Sorry, You cant view this page!!')</script> </h1>
<?php
	header('REFRESH:1;URL=login.php');
?>
