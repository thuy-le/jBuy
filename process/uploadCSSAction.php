<?php

$themeName = $_POST['themeName'];
$themeLink = "../images/".$_POST['themeLink'];


//add connection
include("../connection/connection.php");

$sql="insert into theme(name,link) values(:name,:link)";
$stm=$pdo->prepare($sql);
$stm->bindValue(":name",$themeName);
$stm->bindValue(":link",$themeLink);
$stm->execute();
echo "true";



?>