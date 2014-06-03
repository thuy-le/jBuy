<?php

//connection
include("../connection/connection.php");

$name=$_GET['name'];
$sqlCheck="select * from user where username='$name'";
$stm=$pdo->prepare($sqlCheck);
$stm->execute();
if($stm->rowCount()>0){
	echo "1";
}else{echo "0";}

?>