<?php

//add connection
include("../connection/connection.php");

$sender = $_POST["sender"];
$comment = $_POST["comment"];
$dealID = $_POST["dealID"];

$sql = "insert into comment(sender,content,dealid) values(:sender, :content, :dealid)";
$stm = $pdo->prepare($sql);
$stm->bindValue("sender", $sender);
$stm->bindValue("content", $comment);
$stm->bindValue("dealid", $dealID);
$stm->execute();

echo "Comment Sent. Thank you!";

?>