<?php
session_start();
//connection
include("../connection/connection.php");
if(isset($_SESSION['userID']))
{
	$userID = $_SESSION['userID'];
	
	$oldpass=$_POST['oldpass'];
	
	$newpass=$_POST['newpass'];
	
	$sql="select * from user where userid=$userID";
	
	$result = $pdo->query($sql);
	
	$row = $result->fetch();
	if($oldpass==$row['password'])
	{
		$sql2="UPDATE `user` SET `password` = :password WHERE `userid` =:userid LIMIT 1 ;
";
		$statement = $pdo->prepare($sql2);
		$statement->bindValue('password', $newpass);
		$statement->bindValue('userid', $userID);
		$statement->execute();
		echo 'success';	
	}
	else echo 'Your old password is incorrect';
}

else{
header('Location: ../layout/index.php');	
}
?>