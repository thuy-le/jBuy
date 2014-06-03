<?php
//add connection
include("../connection/connection.php");

$id="";
$name = "";
$description = "";
$condition = "";
$originalprice = 0;
$groupprice = 0;
$saving = 0;
$currentbuyers = 0;
$maxbuyers = 0;
$exdate = "";
$status = 0;
$categoryid = 0;
$image = "";
$imgData = "";

if(isset($_POST["datepicker"])){
	$exdate = $_POST["datepicker"];
}
 //get name
if(isset($_POST["dealid"])){
$id = $_POST["dealid"];
}

if(isset($_POST["dealname"])){
$name = $_POST["dealname"];
}
if(isset($_POST["description"])){
$description = $_POST["description"];
}
if(isset($_POST["condition"])){
$condition = $_POST["condition"];
}
if(isset($_POST["originalprice"])){
$originalprice = $_POST["originalprice"];
}
if(isset($_POST["groupprice"])){
$groupprice = $_POST["groupprice"];
}
if($groupprice !=0 && $originalprice !=0){
$saving = 100 - (($groupprice/$originalprice)*100);	
}
if(isset($_POST["maxbuyers"])){
$maxbuyers = $_POST["maxbuyers"];
}
if(isset($_POST["status"])){
if($_POST["status"]=='yes')
$status = 1;
else $status = 0;
}
else if(!isset($_POST["status"])){
$status = 0;
}
if(isset($_POST["categoryid"])){
$categoryid = $_POST["categoryid"];
}

if($name!="" && $description!="" && $condition!="" && $groupprice!=0 && $originalprice!=0){
$sql3 = "UPDATE deal SET dealname = :name, description = :description , conditions = :condition, originalprice = :originalprice , groupprice = :groupprice , saving = :saving , currentbuyers = :currentbuyers , maxbuyers = :maxbuyers , expiredtime = :exdate , status = :status , categoryid = :categoryid WHERE dealid = :id";
$statement = $pdo->prepare($sql3);

$statement->bindValue("id", $id);
$statement->bindValue("name", $name);
$statement->bindValue("description", $description);
$statement->bindValue("condition", $condition);
$statement->bindValue("originalprice", $originalprice);
$statement->bindValue("groupprice", $groupprice);
$statement->bindValue("saving", $saving);
$statement->bindValue("currentbuyers", $currentbuyers);
$statement->bindValue("maxbuyers", $maxbuyers);
$statement->bindValue("exdate", $exdate);
$statement->bindValue("status", $status);
$statement->bindValue("categoryid", $categoryid);

$statement->execute();

header("Location: ../layout/dealdetails.php?id=".$id);
}


?>