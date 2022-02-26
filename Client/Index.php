<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['retailer_login'])) {
		if($_SESSION['retailer_login'] == true) {
			$id = $_SESSION['retailer_id'];
			$query_selectRetailer = "SELECT * FROM retailer WHERE retailer_id='$id'";
			$result_selectRetailer = mysqli_query($con,$query_selectRetailer);
			$row_selectRetailer = mysqli_fetch_array($result_selectRetailer);
			$query_selectOrder = "SELECT * FROM orders WHERE retailer_id='$id' ORDER BY order_id DESC LIMIT 5";
			$result_selectOrder = mysqli_query($con,$query_selectOrder);
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
<title>Client Dashboard</title>

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
                <a href="ClientProducts.php">
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
                <a href="ClientHelp.html">
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
                <span>Client Dashboard</span>
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
		Welcome <?php echo $_SESSION['sessUsername']; ?>
		<article>
			<h2>My Profile</h2>
			<table class="table_displayData">
				<tr>
					<th>Username</th>
					<!-- <th>Area Code</th> -->
					<th>Phone</th>
					<th>Email</th>
					<th>Address</th>
					<th> Edit </th>
				</tr>
				<tr>
					<td> <?php echo $row_selectRetailer['username']; ?> </td>
					<!-- <td> <?php echo $row_selectRetailer['area_code']; ?> </td> -->
					<td> <?php echo $row_selectRetailer['phone']; ?> </td>
					<td> <?php echo $row_selectRetailer['email']; ?> </td>
					<td> <?php echo $row_selectRetailer['address']; ?> </td>
					<td> <a href="../retailer/edit_profile.php"><span class="material-icons">settings</span></a> </td>
				</tr>
			</table>
		</article>
		<article>
			<h2>My Recent Orders</h2>
			<table class="table_displayData" style="margin-top:20px;">
			<tr>
				<th> Order ID </th>
				<th> Date </th>
				<th> Approved </th>
				<th> Status </th>
				<th> Details </th>
			</tr>
			<?php $i=1; while($row_selectOrder = mysqli_fetch_array($result_selectOrder)) { ?>
			<tr>
			
				<td> <?php echo $row_selectOrder['order_id']; ?> </td>
				
				<td> <?php echo date("d-m-Y",strtotime($row_selectOrder['date'])); ?> </td>
				<td>
					<?php
						if($row_selectOrder['approved'] == 0) {
							echo "Not Approved";
						}
						else {
							echo "Approved";
						}
					?>
				</td>
				<td>
					<?php
						if($row_selectOrder['status'] == 0) {
							echo "Pending";
						}
						else {
							echo "Completed";
						}
					?>
				</td>
				<td> <a href="view_order_items.php?id=<?php echo $row_selectOrder['order_id']; ?>">Details</a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		</article>
	</section>
</body>
</html>