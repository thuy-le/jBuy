<?php
	$id=$_GET['id'];
	$pdo= new PDO("mysql:host=localhost;dbname=s3357672","s3357672","qwerty1234");
	$sql="select * from category where categoryid=$id";
	$result=$pdo->query($sql);
	$row=$result->fetch();
?>
<form action='updatecategoryaction.php' method='post'>
Edit a category<br/>

<input type='text' name='categoryId' value='<?php echo $row['categoryid']; ?>'/>

<input type='text' name='categoryName' value='<?php echo $row['categoryname']; ?>'/>

<input type='submit' value='OK'/>
</form>