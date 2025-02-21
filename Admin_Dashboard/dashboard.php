<?php
include 'connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:admin_login.php');
}
?>
<html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Cafe Delight </title> 
  <link rel="shortcut icon" href="../vendor/images/logo1.png">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<meta name="viewport" content="width=device-width initial-scale =1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="description" content="how to create a toggle for light and dark mode using html,css and javascript">
<meta name="description" content="toggle dark/light mode">
<meta name="tags" content="toggle,darkmode,web design,admin dashboard,glassmorphism,codepen">
<meta name="description" content="design a website">
<meta name="description" content="create a glassmorphism website">
    <meta name="keyword" content="dark mode, html,css,javascript, coding, programming, how to,learn">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><link rel="stylesheet" href="./styles.css">
</head>
<body>
 <input type="checkbox" id="nav-toggle"> 
<div class="sidebar">
 	<div class="sidebar-brand">
 		 	<h2><span id="kleenpulse">Cafe Delight</span></h2>
 	</div>
	 <div class="sidebar-menu">
	 	<ul>
	 		</li> 
	 		<li>
	 			<a href="dashboard.php" class="active"><span class="las la-home"></span>
	 				<span>Dashboard</span>
	 			</a>
	 		</li>
			<li>
	 			<a href="users_accounts.php"><span class="las la-users"></span>
	 				<span>Customers</span>
	 			</a>
	 		</li>
	 		<li>
	 		<a href="placed_orders.php"><span><i class="las la-coffee"></i></span>
	 				<span>Orders</span>
	 			</a>
	 		</li>
	 		<li>
	 			<a href="products.php"><span class="las la-shopping-bag"></span>
	 				<span>Products</span>
	 			</a>
	 		</li>
			<li>
	 			<a href="admin_accounts.php"><span class="las la-user-circle"></span>
	 				<span>Admin</span>
	 			</a>
	 		</li>
			<li>
	 			<a href="messages.php"><span class="las la-comments"></span>
	 				<span>Messages</span>
	 			</a>
	 		</li>
	 		<li>
	 			<a href="emp_accounts.php" class="active"><span class="las la-user-circle"></span>
	 				<span>Employees</span>
	 			</a>
	 		</li>
        </ul>
	 </div>
 </div>
<div class="main-content">
	<header>
		<h2 class="heading" id="dashboard">
			<label for="nav-toggle">
				<span class="las la-bars"></span>
			</label>
			Cafe Delight
		</h2>
		<div class="search">
            <div class="icon"></div>
            <div class="input">
                <input type="text" placeholder="search" id="mysearch" autocomplete="on">
            </div>
            <span class="clear" onclick="reset()"></span>
        </div>
		<div class="user-wrapper">
			<div>
				<h4>Cafe Delight</h4>
			    <small>ADMIN</small>
			</div>
		</div>
	</header>
	<main>
		<div id="pop-wrap">
	<h1 class="pop-up">Light Mode Activated</h1>
</div>
<div class="switch" id="switch">
	<div id="toggle">
				<i class="indicator"></i>
			</div>
	</div>
		<div class="cards">
			<div class="card-single">
				<div>
					<a href="admin_accounts.php">
					<?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h1><b><?= $numbers_of_admins; ?></b></h1>
					<span><strong>Admin</strong></span>
				</a>
				</div>
				<div>
					<span class="las la-user-circle"></span>
				</div> 
			</div>
			<div class="card-single">
				<div>
					<?php 
					$select_employees=$conn->prepare("SELECT * FROM `employees`");
         $select_employees->execute();
         $numbers_of_employees = $select_employees->rowCount();
      ?>
	<h1><b><?=$numbers_of_employees; ?></b></h1>
	<a href="emp_accounts.php"><span><strong>Employees</strong></span></a>
					</div>
				<div>
					<span class="las la-user-circle"></span>
				</div>
			</div>
<div class="card-single">
				<div>

					<?php 
					$select_orders=$conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
	<h1><b><?=$numbers_of_orders; ?></b></h1>
	<a href="placed_orders.php"><span><strong>Orders</strong></span></a>
					</div>
				<div>
					<span class="las la-coffee"></span>
				</div>
			</div>
			<div class="card-single">
			<div>
				<?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         };
      ?>
      <h1><b><?= $total_pendings; ?>/-</b></h1>
      <a href="admin_orders.php"><span><strong>Total Pendings</strong></span></a>
      </div>
      <div>
      	<span class="las la-clipboard"></span>
  </div>
</div>
<div class="card-single">
	<div>
		<?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completed->execute(['completed']);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
            $total_completed += $fetch_completed['total_price'];
         };
      ?>
      	<h1><b><?= $total_completed; ?>/-</b></h1>
         <a href="admin_orders.php"><span><strong>Total Completed </strong></span></a>
      </div>
      <div>
      	<span class="las la-clipboard"></span>
  </div>
</div>

      		<div class="card-single">
				<div>
					<?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h1><b><?= $numbers_of_products; ?></b></h1>
					<a href="products.php"><span><strong>Our Products</strong></span></a>
					</div>
				<div>
					<span class="las la-shopping-bag"></span>
				</div>
			</div>
			<div class="card-single">
				<div>
					<?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h1><b><?= $numbers_of_users; ?></b></h1>
	<a href="users_accounts.php">
		<span><strong>Customers</strong></span></a>
					</div>
				<div>
					<span class="las la-users"></span>
			</div>
		</div>
			<div class="card-single">
				<div>
					<?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
					<h1><b><?= $numbers_of_messages; ?></b></h1>
					<a href="messages.php">
					<span><strong>Messages</strong></span></a>
				</div>
				<div>
					<span class="las la-comments"></span>
				</div>
			</div>
		</div>
	</main>
		<footer id="footer">
  <p>All rights are reserved by | Cafe Delight<sup> Tm </sup><?= date('Y'); ?> </p>
</footer>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script><script  src="./script.js"></script>
 </body>
</html>