<?php
  //connection
  include("../connection/connection.php");

  $username=$_POST['name'];
  $password=$_POST['password'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $phone=$_POST['mobile'];
   
   $sqlInsert='insert into user(username,password,isAdmin) values(:username,:password,:isAdmin)';
   $stm=$pdo->prepare($sqlInsert);
   $stm->bindValue(":username",$username);
   $stm->bindValue(":password",$password);
   $stm->bindValue(":isAdmin",0);
   $stm->execute();
   
   $id = $pdo->lastInsertId();

   $sqlInsert2='insert into userdetails(id,fullname,email,phone,address) values(:id,:fullname,:email,:phone,:address)';
   $stm2=$pdo->prepare($sqlInsert2);
   $stm2->bindValue(":id",$id);
   $stm2->bindValue(":fullname",$fullname);
   $stm2->bindValue(":email",$email);
   $stm2->bindValue(":phone",$phone);
   $stm2->bindValue(":address",$address);
   $stm2->execute();
   
   echo "ok.";
   echo $username;
?>