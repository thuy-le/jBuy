<?php
	//add connection
	include("../connection/connection.php");
	
	$categoryname=$_POST['scategoryname'];


	$sql_sel = "select * from category where categoryname = :categoryname";
	
	$stat_sel = $pdo->prepare($sql_sel);
	
	$stat_sel->bindValue(":categoryname",$categoryname);
	$stat_sel->execute();
	
	if($row = $stat_sel->fetch())
	{echo "wrong name";}
	
	else{	
	$sql="insert into category(categoryname) values(:categoryname)";
	$stm=$pdo->prepare($sql);
	$stm->bindValue(":categoryname",$categoryname);
	$stm->execute();
	echo "true";
	}
?>