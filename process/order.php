<?php
  //connection
  include("../connection/connection.php");

  $quantity=$_POST['quantity'];
  $total=$_POST['total'];
  $payment=$_POST['payment'];
  $pcustomerid=$_POST['userID'];
  $did=$_POST['dID'];
  $orderdate = "2012-05-05";
  $rcustomerid = $pcustomerid;
  $check = 0;
	  
  if(isset($_POST['gift'])){
	  $check = 1;
	  $rcname=$_POST['giftTxt'];
	  echo $rcname;
	  $sqlSelect = "select * from user where username = '$rcname'";
	  $result = $pdo->query($sqlSelect);
	  $row = $result->fetch();
	  $rcustomerid = $row[0];
  }
    
  $sqlInsert='insert into `order`(dealid,pcustomerid,rcustomerid,quantity,total,paymentmethod,orderdate) values(:dealid,:pcustomerid,:rcustomerid,:quantity,:total,:paymentmethod,:orderdate)';
  $stm=$pdo->prepare($sqlInsert);
  $stm->bindValue(":dealid",$did);
  $stm->bindValue(":pcustomerid",$pcustomerid);
  $stm->bindValue(":rcustomerid",$rcustomerid);
  $stm->bindValue(":quantity",$quantity);
  $stm->bindValue(":total",$total);
  $stm->bindValue(":paymentmethod",$payment);
  $stm->bindValue(":orderdate",$orderdate);
  $stm->execute();

  echo $sqlInsert;
  echo $quantity.$did.$pcustomerid.$orderdate;
?>