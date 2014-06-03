<?php
	//add connection
	include("../connection/connection.php");
	$categoryId=$_POST['categoryid'];
	$categoryName = "";
	if(isset($_POST['categoryname']))$categoryName = $_POST['categoryname'];
	$sql1 = 'select * from category';
	$result = $pdo->query($sql1);
	$checkName = 0;
	if($categoryName!=""){

	  while($row = $result->fetch())
	  {
		  if($categoryName == $row['categoryname']) $checkName = 1;	
	  }
	  
	  if($checkName == 0){
			$sql="update category set categoryname='$categoryName' where categoryid=$categoryId";
			$pdo->exec($sql);
			echo 'true';			  
	  }
	  else echo 'This category is existing!';
	}	
	else
	echo 'Please enter a category name';
?>