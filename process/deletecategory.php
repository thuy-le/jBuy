<?php
	//add connection
	include("../connection/connection.php");
	$id=$_GET['id'];
	$sql="delete from category where categoryid='$id'";
	$pdo->exec($sql);
	echo 'true';
?>