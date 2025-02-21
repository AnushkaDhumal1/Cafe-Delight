<?php

include 'connect.php';

session_start();
if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $add = $_POST['address'];
   $add = filter_var($add, FILTER_SANITIZE_STRING);
   $number = sha1($_POST['number']);
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   $select_emp = $conn->prepare("SELECT * FROM `employees` WHERE name = ?");
   $select_emp->execute([$name]);
   
   if($select_emp->rowCount() > 0){
      $message[] = 'username already exists!';
   }else{
         $insert_emp = $conn->prepare("INSERT INTO `employees`(name, address,number) VALUES(?,?,?)");
         $insert_emp->execute([$name, $add,$number]);
      }
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

<?php include 'admin_header.php' ?>
<section class="form-container">

   <form action="" method="POST">
      <h3>register new</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter Employee name" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="address" maxlength="50" required placeholder="enter  address" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" maxlength="10" required placeholder=" Enter Phone number" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
   </form>

</section>
<script src="admin_script.js"></script>

</body>
</html>