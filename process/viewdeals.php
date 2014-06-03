<?php 
//add connection
include("../connection/connection.php");

//declare avriables
$name = "";
$description = "";
$originalprice = 0;
$groupprice = 0;
$saving = 0;
$currentbuyers = 0;
$maxbuyers = 0;
$status = 0;
$categoryid = 0;

session_start();

$isUser=0;
//get user session
if(isset($_SESSION["isUser"]))
$isUser=$_SESSION["isUser"];


if(isset($_GET["id"])){

if($_GET["id"]=='new')
{
	$sql = "SELECT * FROM `deal` ORDER BY dealid DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Newest Deals";
	$_SESSION['menu']=0;
}

else if($_GET["id"]=='hot')
{
	$sql = "SELECT * FROM `deal` ORDER BY saving DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Hottest Deals";
	$_SESSION['menu']=0;
}

else if($_GET["id"]=='revenue')
{
	$sql = "SELECT dealid, dealname, description, conditions, originalprice, groupprice, saving, currentbuyers, maxbuyers, expiredtime, status, categoryid, images, thumb, (groupprice*currentbuyers) as revenue FROM `deal` ORDER BY revenue DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Best Revenue";
}

else if($_GET["id"]=='mostwanted')
{
	$sql = "SELECT * FROM `deal` ORDER BY currentbuyers DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Most Wanted";
}

else if($_GET["id"]>0){
//check if there is a specific category
$categoryid = $_GET["id"];

//set session for menu
$_SESSION['menu']=$categoryid;

//select all deals from the category
$sql = "select * from deal where categoryid = :category";
$statement = $pdo->prepare($sql);
$statement->bindValue("category", $categoryid);

//get + set category name
$c_sql = "select * from category where categoryid = :category";
$c_stat = $pdo->prepare($c_sql);
$c_stat->bindValue("category", $categoryid);
$c_stat->execute();
$c_row = $c_stat->fetch();
$head = $c_row["categoryname"];
}

else if($_GET["id"]==0){
	
//set session for menu
	$_SESSION['menu']=0;
	
	//selct all deals
	$sql = "select * from deal ORDER BY dealname";
	$statement = $pdo->prepare($sql);
	
	//set category name
	$head = "All deals";	
}

}

else{
	//set session for menu
	$_SESSION['menu']=0;
	
	//selct all deals
	$sql = "select * from deal ORDER BY dealname";
	$statement = $pdo->prepare($sql);
	
	//set category name
	$head = "All deals";
}

$statement->execute();

?>

		<div>
          <h1><a href="#" class="h1"><?php echo $head ?></a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          
          <ul class="paging">
          <?php
		  while($row = $statement->fetch()){
			$id = $row["dealid"];  
			$name = $row["dealname"];  
			$description = $row["description"];
			$originalprice = $row["originalprice"];
			$groupprice = $row["groupprice"];
			$saving = $row["saving"];
			$currentbuyers = $row["currentbuyers"];
			$maxbuyers = $row["maxbuyers"];
			$status = 0;
			$categoryid = 0;
			$available = $maxbuyers - $currentbuyers;
			$images = $row["images"];
			$total = $currentbuyers*$groupprice;
		  ?>
          <li>
          <div class="record">
            <?php
		   $imgLink = explode("*", $images);
		   $img = $imgLink[0];
		   ?>
            <img src="<?php echo $img ?>" width="641" height="222" alt=""/>
            <div class="discount2"><p><?php echo $saving ?>%</p></div>
            
            <!--left content-->            
            <div class="left">
              <h2><a href="../layout/dealdetails.php?id=<?php echo $id ?>" class="h2"><?php echo $name ?></a></h2>
              <p><?php echo substr($description,0,251) ?></p>
            </div>
            
            <!--right content-->            
            <div class="right">
              <p><span class="label">Price:</span><span class="text">$<?php echo $groupprice ?></span></p>
              <p><span class="label">Original:</span><span class="text">$<?php echo $originalprice ?></span></p>
              <p><span class="label">Available:</span><span class="text"><?php echo $available ?> / <?php echo $maxbuyers ?></span></p>
              <?php if($isUser==1){ ?>
              <p><span class="label">Sold:</span><span class="text"><?php echo $currentbuyers ?></span></p>
              <p><span class="label">Revenue:</span><span class="text"><?php echo $total ?></span></p>
              <?php }?>
              <div class="clearfloat3"></div>
             <p>
              
              <?php if($isUser==1){ ?>
              <a href="../process/updatedeal.php?id=<?php echo $id ?>" class="details">Update</a>
              <input type="button" id="<?php echo $id; ?>" onclick="deleteD()" class="delbutton" value="Delete"/>
              <?php }
			  else{
			  ?>
              <a href="#" class="details">Buy</a>
              <?php }?>
              
               </p>
            </div>
            
            <div class="clearfloat"></div>
            <div class="hr2"></div> 
           </div>
           </li>
          <?php
		  }
		  ?>
          
         </ul>
          <!-- end .deals --></div>
          
          <div class="cbot"></div>
		</div>
<script type="text/javascript">
    $(document).ready(function() { 
    $("ul.paging").quickPager();   
    $("ul.paging2").quickPager({pagerLocation:"both"});
    });
    </script>
