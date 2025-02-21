<?php

include 'connect.php';

session_start();
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_employee = $conn->prepare("DELETE FROM `employees` WHERE id = ?");
   $delete_employee->execute([$delete_id]);
   header('location:emp_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cafe Delight</title>
   <link rel="shortcut icon" href="../vendor/images/logo1.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="admin_style.css">

</head>
<body>

<?php include 'emp_header.php' ?>
<section class="accounts">

   <h1 class="heading">Employee Account</h1>

   <div class="box-container">

   <div class="box">
      <p>Add New Employee</p>
      <a href="register_employee.php" class="option-btn">Add</a>
   </div>

   <?php
      $select_account = $conn->prepare("SELECT * FROM `employees`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p>  id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> name : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p>  Phone No : <span><?= $fetch_accounts['number']; ?></span> </p>
      <p>  Address : <span><?= $fetch_accounts['address']; ?></span> </p>
      <div class="flex-btn">
         <a href="emp_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn">delete</a>
               </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>
<script src="admin_script.js"></script>

</body>
</html>