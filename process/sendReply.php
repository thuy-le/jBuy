<?php

//add connection
include("../connection/connection.php");

$sender = $_POST["sender"];
$comment = $_POST["comment"];
$commentID = $_POST["commentID"];

$sql = "insert into reply(commentid, sender, comment) values(:commentid, :sender, :comment)";
$stm = $pdo->prepare($sql);
$stm->bindValue("sender", $sender);
$stm->bindValue("comment", $comment);
$stm->bindValue("commentid", $commentID);
$stm->execute();

echo "Reply Sent. Thank you!";

?>