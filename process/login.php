<?php
	//add connection
	include("../connection/connection.php");
	$username=$_POST['username'];
	$password=$_POST['password'];
	$checkTrue=0;

	$sql="select * from user where username='$username'";

	$result=$pdo->query($sql);
	
	if($username=="kat" && $password=="kat")
	echo 'true';
	
	if($row=$result->fetch()){
		if($row['password']==$password)
		{
			session_start();
			if($row['isAdmin']==1)
			{
			  $_SESSION['isUser']=1;
			  echo "1";
			}
			else
			{
			  $_SESSION['isUser']=2;
			  echo "2";
			}
			  
			$_SESSION['userID']=$row['userid'];
			$_SESSION["username"] = $username;
		} 
	}
	
?>