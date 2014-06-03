<?php
  //connection
  include("../connection/connection.php");

  $uid = $_POST["uid"];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
   
   $sqlInsert2='update userdetails set fullname=:fullname, email=:email, phone=:phone, address=:address where id=:uid';
   $stm2=$pdo->prepare($sqlInsert2);
   $stm2->bindValue(":uid",$uid);
   $stm2->bindValue(":fullname",$fullname);
   $stm2->bindValue(":email",$email);
   $stm2->bindValue(":phone",$phone);
   $stm2->bindValue(":address",$address);
   $stm2->execute();
   
   echo "ok.";
?>