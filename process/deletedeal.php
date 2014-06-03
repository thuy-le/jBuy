<?php
//add connection
include("../connection/connection.php");
$id = $_GET["id"];
$sql = "delete from deal where dealid = $id";
$pdo->exec($sql);
?>