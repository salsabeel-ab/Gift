<?php
	define("DSN","mysql:Host=localhost;dbname=gift;charset=utf8");
	define("USER","root");
	define("PASS","");
	
	try{
		$con=new PDO(DSN,USER,PASS);
		//echo "connected";
	}
	catch(PDOEXception $x){
		exit($x->GETMessage());
	}
?>