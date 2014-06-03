<?php
	//add connection
	include("../connection/connection.php");
	$id=$_GET['id'];
	
	$sql="delete from userdetails where id='$id'";
	$pdo->exec($sql);
	$sql2="delete from user where userid='$id'";
	$pdo->exec($sql2);
	
	echo 'true';
?>