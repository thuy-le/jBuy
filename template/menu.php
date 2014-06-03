<?php
//addconnection
include("../connection/connection.php");

//selcect all category for menu
$menusql = "select * from category ORDER BY categoryid ASC";
$menu_stat = $pdo->prepare($menusql);
$menu_stat->execute();

if($isUser==1){
?>

<div class="menu">        
  <ul>        
	<?php 
    if($menu==-1){
    ?>
      <li><a href="../layout/index.php" class="current">Home</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/index.php">Home</a></li>
    <?php }?>
    
    <?php 
    if($menu>=0){
    ?>
      <li><a href="../layout/deals.php" class="current">Deals</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/deals.php">Deals</a></li>
    <?php }?>
    
	<?php 
    if($menu==-3){
    ?>
      <li><a href="../layout/categories.php" class="current">Categories</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/categories.php">Categories</a></li>
    <?php }?>
    
    
    <?php 
    if($menu==-4){
    ?>
      <li><a href="../layout/changePassword.php" class="current">Password</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/changePassword.php">Password</a></li>
    <?php }?>
  
  </ul>        
</div>        
<div class="desc"><p>justbuy.vn - What are you waiting for? Just buy it with the best price ever!!!</p></div>
<div class="clearfloat"></div>

<?php }
else{
?>

<div class="menu">        
  <ul>        
	<?php 
    if($menu==-1){
    ?>
      <li><a href="../layout/index.php" class="current">Home</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/index.php">Home</a></li>
    <?php }?>
    
    <?php 
    if($menu==0){
    ?>
      <li><a href="../layout/deals.php" class="current">All Deals</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/deals.php">All Deals</a></li>
    <?php }?>
    
    <?php 
    while($menurow = $menu_stat->fetch()){
    $menuid = $menurow["categoryid"];
    $menuname = $menurow["categoryname"];
    if($menu==$menuid){
    ?>
      <li><a href="../layout/deals.php?id=<?php echo $menuid ?>" class="current"><?php echo $menuname ?></a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/deals.php?id=<?php echo $menuid ?>"><?php echo $menuname ?></a></li>
    <?php }?>
    
    <?php } ?>
    
    <?php 
    if($menu==-2){
    ?>
      <li><a href="../layout/contactus.php" class="current">Contact Us</a></li>
    <?php }
    else{
    ?>
      <li><a href="../layout/contactus.php">Contact Us</a></li>
    <?php }?>
  
  </ul>        
</div>        
<div class="desc"><p>justbuy.vn - What are you waiting for? Just buy it with the best price ever!!!</p></div>
<div class="clearfloat"></div>
<?php }?>

<?php 
if($isUser==1){
?>

<script>
$('.menu').hide();
$('.desc').hide();
</script>

<?php }?>