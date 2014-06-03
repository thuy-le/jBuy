<?php
header("content-type: image/jpg") ;
//add connection
include("../connection/connection.php");
$id = $_GET["id"];
$query = "SELECT image FROM deal where dealid = $id";
$results = $pdo->query($query);
$row = $results->fetch();
echo $row['image'];

?> 