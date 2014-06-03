<?php
	//add connection
	include("../connection/connection.php");
	$id=$_GET['id'];
	$sql="delete from `order` where id='$id'";
	$pdo->exec($sql);
	echo 'true';
?>