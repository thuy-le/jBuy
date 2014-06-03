<?php
	$categoryId=$_POST['categoryId'];
	$categoryName=$_POST['categoryName'];
	$sql="update category set categoryname='$categoryName' where categoryid=$categoryId";
	$pdo=new PDO("mysql:host=localhost;dbname=s3357672","s3357672","qwerty1234");
	$pdo->exec($sql);
	header('location:categoryList.php');
?>