<?php
//add connection
include("../connection/connection.php");
$id = $_GET["id"];
$sql = "delete from reply where commentid = $id";
$pdo->exec($sql);
$sql2 = "delete from comment where id = $id";
$pdo->exec($sql2);
?>