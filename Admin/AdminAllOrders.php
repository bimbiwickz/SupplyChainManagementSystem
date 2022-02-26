<?php
	require("../includes/config.php");
	include("../includes/validate_data.php");
	error_reporting(0);
	session_start();
		if(isset($_SESSION['admin_login'])) {
			$error = "";
			$querySelectRetailer = "SELECT *,area.area_id AS area_id FROM retailer,area WHERE retailer.area_id = area.area_id";
			$resultSelectRetailer = mysqli_query($con,$querySelectRetailer);
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['cmbFilter'])) {
					if(!empty($_POST['txtId'])) {
						$result = validate_number($_POST['txtId']);
						if($result == 1) {
							$order_id = $_POST['txtId'];
							$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id AND order_id='$order_id'";
							$result_selectOrder = mysqli_query($con,$query_selectOrder);
							$row_selectOrder = mysqli_fetch_array($result_selectOrder);
							if(empty($row_selectOrder)){
							   $error = "* No order was found with this ID";
							}
							else {
								mysqli_data_seek($result_selectOrder,0);
							}
						}
						else {
							$error = "* Invalid ID";
						}
					}
					else if(!empty($_POST['cmbRetailer'])) {
						$retailer_id = $_POST['cmbRetailer'];
						$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id AND orders.retailer_id='$retailer_id' ORDER BY approved,status,order_id DESC";
						$result_selectOrder = mysqli_query($con,$query_selectOrder);
						$row_selectOrder = mysqli_fetch_array($result_selectOrder);
						if(empty($row_selectOrder)){
						   $error = "* No order was found of the selected Retailer";
						}
						else {
							mysqli_data_seek($result_selectOrder,0);
						}
					}
					else if(!empty($_POST['txtDate'])) {
						$date = $_POST['txtDate'];
						$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id AND date='$date'";
						$result_selectOrder = mysqli_query($con,$query_selectOrder);
						$row_selectOrder = mysqli_fetch_array($result_selectOrder);
						if(empty($row_selectOrder)){
						   $error = "* No order was found with the selected Date";
						}
						else {
							mysqli_data_seek($result_selectOrder,0);
						}
						
					}
					else if(!empty($_POST['cmbStatus'])) {
						if($_POST['cmbStatus'] == "zero") {
							$status = 0;
						}
						else {
							$status = $_POST['cmbStatus'];
						}
						$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id AND status='$status' ORDER BY approved,order_id DESC";
						$result_selectOrder = mysqli_query($con,$query_selectOrder);
						$row_selectOrder = mysqli_fetch_array($result_selectOrder);
						if(empty($row_selectOrder)){
						   $error = "* No order was found";
						}
						else {
							mysqli_data_seek($result_selectOrder,0);
						}
					}
					else if(!empty($_POST['cmbApproved'])) {
						if($_POST['cmbApproved'] == "zero") {
							$approved = 0;
						}
						else {
							$approved = $_POST['cmbApproved'];
						}
						$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id AND approved='$approved' ORDER BY order_id DESC";
						$result_selectOrder = mysqli_query($con,$query_selectOrder);
						$row_selectOrder = mysqli_fetch_array($result_selectOrder);
						if(empty($row_selectOrder)){
						   $error = "* No order was found";
						}
						else {
							mysqli_data_seek($result_selectOrder,0);
						}
					}
					else {
						$error = "* Please enter the data to search for.";
					}
				}
				else {
					$error = "Please choose an option to search for.";
				}
			}
			else {
				$query_selectOrder = "SELECT * FROM orders,retailer,area WHERE orders.retailer_id=retailer.retailer_id AND retailer.area_id=area.area_id ORDER BY approved,status,order_id DESC;";
				$result_selectOrder = mysqli_query($con,$query_selectOrder);
			}
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
                <a href="index.php">
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
                <a href="AdminAllOrders.php" class="active">
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
                <span>All Orders</span>
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

</body>
</html>