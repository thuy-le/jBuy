<?php
//add connection
include("../connection/connection.php");

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

//datetime
if(isset($_POST["datepicker"])){
	$exdate = $_POST["datepicker"];
}

//image upload
$image = "";
$imgLink = "";
$thumbLink = "";
$i=0;
if(isset($_POST["image"]))
{
$image = $_POST["image"];	
while($i<count($image))
{
	$image[$i] = "../images/".$image[$i];
	$extension = explode(".",$image[$i]);
	$extension = end($extension);
	$extension = strtolower($extension);
	$imgName = explode("/",$image[$i]);
	$imgName = end($imgName);
	$endfile = "../photos/".$imgName;
	
	if($extension == "jpeg" || $extension == "jpg"){

	$new_img = imagecreatefromjpeg($image[$i]);
	
	}else if($extension == "png"){
	
	$new_img = imagecreatefrompng($image[$i]);
	
	}else if($extension == "gif"){
	
	$new_img = imagecreatefromgif($image[$i]);
	
	}
	
	$width = imagesx( $new_img );
	$height = imagesy( $new_img );
	
	$newwidth = 960;
	$newheight = 348;
	$tmpimg = imagecreatetruecolor( $newwidth, $newheight );


	// Copy and resize old image into new image.
	imagecopyresampled( $tmpimg, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
	imagejpeg( $tmpimg, $endfile, 100);

	$imgLink = $imgLink.$endfile."*";
	
	if($i==0){
	$thumbfile = "../thumbs/".$imgName;
	$thumbwidth = 220;
	$thumbheight = 159;
	$thumbimg = imagecreatetruecolor( $thumbwidth, $thumbheight );
	imagecopy ( $thumbimg, $new_img, 0, 0, 0, 0, $thumbwidth, $thumbheight );
	imagejpeg( $thumbimg, $thumbfile, 100);
	$thumbLink = $thumbLink.$thumbfile;
	}
	
	unlink($image[$i]);
	$i++;
}
}
else echo "Please choose at least 1 image for this deal"; 
//get details
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
$status = 1;
}
if(isset($_POST["categoryid"])){
$categoryid = $_POST["categoryid"];
}

if($name!="" && $description!="" && $condition!="" && $groupprice!=0 && $originalprice!=0 && $imgLink!="" && $exdate!="" && $maxbuyers!=0){
$sql3 = "INSERT INTO deal ( dealid , dealname , description , conditions , originalprice , groupprice , saving , currentbuyers , maxbuyers , expiredtime , status , categoryid , images, thumb)
VALUES (
'', :name, :description, :condition, :originalprice, :groupprice, :saving, :currentbuyers, :maxbuyers, :exdate, :status, :categoryid, :images, :thumb
)";
$statement = $pdo->prepare($sql3);

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
$statement->bindValue("images", $imgLink);
$statement->bindValue("thumb", $thumbLink);

$statement->execute();

$id = $pdo->lastInsertId();

echo $id."/success";

}
else{echo "Please enter all information";}


?>