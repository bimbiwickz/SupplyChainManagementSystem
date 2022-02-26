<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			//select last 5 retialers
			$query_selectRetailer = "SELECT * FROM retailer ORDER BY retailer_id DESC LIMIT 5";
			$result_selectRetailer = mysqli_query($con,$query_selectRetailer);
			//select last 5 manufacturers
			$query_selectManufacturer = "SELECT * FROM manufacturer ORDER BY man_id DESC LIMIT 5";
			$result_selectManufacturer = mysqli_query($con,$query_selectManufacturer);
			//select last 5 products
			$query_selectProducts = "SELECT * FROM products,categories,unit WHERE products.pro_cat=categories.cat_id AND products.unit=unit.id ORDER BY pro_id DESC LIMIT 5";
			$result_selectProducts = mysqli_query($con,$query_selectProducts);
		}
		else {
			header('Location:../index.php');
		}
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
<title>Admin Dashboard</title>

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
                <a href="index.php" class="active">
                    <span class="material-icons">grid_view</span>
                    <span class="name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="AdminProducts.php">
                    <span class="material-icons">category</span>
                    <span class="name">Products</span>
                </a>
            </li>
            <li>
                <a href="AdminAddProducts.php">
                    <span class="material-icons">add_box</span>
                    <span class="name">Add Product</span>
                </a>
            </li>
            <li>
                <a href="AdminAllOrders.php">
                    <span class="material-icons">toc</span>
                    <span class="name">All Orders</span>
                </a>
            </li>
            <li>
                <a href="AdminNewOrder.php">
                    <span class="material-icons">queue</span>
                    <span class="name">New Order</span>
                </a>
            </li>
            <li>
                <a href="AdminEmployee.php">
                    <span class="material-icons">people</span>
                    <span class="name">Employees</span>
                </a>
            </li>
            <li>
                <a href="AdminAddClient.php">
                    <span class="material-icons">person_add</span>
                    <span class="name">Add Clients</span>
                </a>
            </li>
            <li>
                <a href="AdminManageInventory.php">
                    <span class="material-icons">manage_history</span>
                    <span class="name">Manage Inventory</span>
                </a>
            </li>
            <li>
                <a href="AdminManageUnit.php">
                    <span class="material-icons">ad_units</span>
                    <span class="name">Manage Unit</span>
                </a>
            </li>
            <li class="log_out">
                <a href="../new_index.php">
                    <span class="material-icons">logout</span>
                    <span class="name">Logout</span>
                </a>
            </li>
            
        </ul>
    </div>

    <!-- Home Section -->
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <span class="material-icons">list</span>
                <span>Admin Dashboard</span>
            </div>
            <div class="profile-details">
                <div class="admin">
                    <span class="material-icons">admin_panel_settings</span>
                    <span class="admin">Admin</span>
                </div>
                <div class="user">
                    <span class="material-icons">account_circle</span>
                    <a href="#">
                        <span class="username"><?php echo $_SESSION['sessUsername']; ?></span>
                    </a>
                </div>
            </div>
        </nav>
    </section>

    <!-- Content -->
    <section class="content-section">
		<h1>Welcome <?php echo $_SESSION['sessUsername']; ?></h1>
		<article>
			<h2>Recently Added Clients</h2>
			<table class="table_displayData">
				<tr>
					<th>Sr. No.</th>
					<th>Username</th>
					<!-- <th>Area Code</th> -->
					<th>Phone</th>
					<th>Email</th>
					<th>Address</th>
				</tr>
				<?php $i=1; while($row_selectRetailer = mysqli_fetch_array($result_selectRetailer)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $row_selectRetailer['username']; ?> </td>
					<!-- <td> <?php echo $row_selectRetailer['area_code']; ?> </td> -->
					<td> <?php echo $row_selectRetailer['phone']; ?> </td>
					<td> <?php echo $row_selectRetailer['email']; ?> </td>
					<td> <?php echo $row_selectRetailer['address']; ?> </td>
				</tr>
				<?php $i++; } ?>
			</table>
		</article>
		
		<!-- <article>
			<h2>Recently Added Manufacturers</h2>
			<table class="table_displayData">
			<tr>
				<th>Sr. No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Username</th>
			</tr>
			<?php $i=1; while($row_selectManufacturer = mysqli_fetch_array($result_selectManufacturer)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_name']; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_email']; ?> </td>
				<td> <?php echo $row_selectManufacturer['man_phone']; ?> </td>
				<td> <?php echo $row_selectManufacturer['username']; ?> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article> -->
		
		<article>
			<h2>Recently Added Products</h2>
			<table class="table_displayData">
			<tr>
				<th> Code </th>
				<th> Name </th>
				<th> Price </th>
				<th> Unit </th>
				<th> Category </th>
				<th> Quantity </th>
			</tr>
			<?php $i=1; while($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
			<tr>
				<td> <?php echo $row_selectProducts['pro_id']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_name']; ?> </td>
				<td> <?php echo $row_selectProducts['pro_price']; ?> </td>
				<td> <?php echo $row_selectProducts['unit_name']; ?> </td>
				<td> <?php echo $row_selectProducts['cat_name']; ?> </td>
				<td> <?php if($row_selectProducts['quantity'] == NULL){ echo "N/A";} else {echo $row_selectProducts['quantity'];} ?> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article>
	</section>
</body>
</html>