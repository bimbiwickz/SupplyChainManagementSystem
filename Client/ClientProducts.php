<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['retailer_login'])) {
			$query_selectProducts = "SELECT * FROM products,categories,unit WHERE products.pro_cat=categories.cat_id AND products.unit=unit.id ORDER BY pro_id";
			$result_selectProducts = mysqli_query($con,$query_selectProducts);
		}
		else {
			header('Location:../index.php');
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
<link rel="stylesheet" href="../includes/MainStyleSheet.css" >

</head>
<body>
<div class="sidebar">
        <div class="logo">
            <span class="material-icons">inventory_2</span>
            <span class="logo-name">SCM System</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="index.php">
                    <span class="material-icons">grid_view</span>
                    <span class="name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="ClientProducts.php" class="active">
                    <span class="material-icons">category</span>
                    <span class="name">Products</span>
                </a>
            </li>
            <li>
                <a href="ClientAllOrders.php">
                    <span class="material-icons">toc</span>
                    <span class="name">All Orders</span>
                </a>
            </li>
            <li>
                <a href="ClientPlaceOrder.php">
                    <span class="material-icons">queue</span>
                    <span class="name">Place Order</span>
                </a>
            </li>
            <li class="log_out">
                <a href="../new_index.php">
                    <span class="material-icons">logout</span>
                    <span class="name">Logout</span>
                </a>
            </li>
            <li>
                <a href="ClientAboutUs.php">
                    <span class="material-icons">info</span>
                    <span class="name">About US</span>
                </a>
            </li>
            <li>
                <a href="ClientHelp.php">
                    <span class="material-icons">help</span>
                    <span class="name">Help</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Home Section -->
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <span class="material-icons">list</span>
                <span>Products</span>
            </div>
            <div class="profile-details">
                <div class="client">
                    <span class="material-icons">people_alt</span>
                    <span class="client">Client</span>
                </div>
                <div class="user">
                    <span class="material-icons">account_circle</span>
                    <a href="#">
                        <span class="username">Client123</span>
                    </a>
                </div>
            </div>
        </nav>
    </section>

    <!-- Content -->
    <section class="content-section">
		<h1>Products list</h1>
		<form action="" method="POST" class="form">
		<table class="table_displayData">
			<tr>
				<th> ID </th>
				<th> Name </th>
				<th> Price </th>
				<th> Unit </th>
				<th> Category </th>
			</tr>
			<?php $i=1; while($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
			<tr>
				<td> <?php echo $row_selectProducts['pro_id']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_name']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_price']; ?> </td>
				<td> <?php echo $row_selectProducts['unit_name']; ?> </td>
				<td> <?php echo $row_selectProducts['cat_name']; ?> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</form>
	</section>
</body>
</html>