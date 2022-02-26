<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$id = $_GET['id'];
			$query_selectUnitDetails = "SELECT * FROM unit WHERE id='$id'";
			$result_selectUnitDetails = mysqli_query($con,$query_selectUnitDetails);
			$row_selectUnitDetails = mysqli_fetch_array($result_selectUnitDetails);
			$unitName = $unitDetails = "";
			$unitNameErr = $requireErr = $confirmMessage = "";
			$unitNameHolder = $unitDetailsHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtUnitName'])) {
					$unitNameHolder = $_POST['txtUnitName'];
					$result = validate_name($_POST['txtUnitName']);
					if($result == 1) {
						$unitName = $_POST['txtUnitName'];
					}
					else{
						$unitNameErr = $result;
					}
				}
				if(!empty($_POST['txtunitDetails'])) {
					$unitDetails = $_POST['txtunitDetails'];
					$unitDetailsHolder = $_POST['txtunitDetails'];
				}
				if($unitName != null) {
					$query_UpdateUnit = "UPDATE unit SET unit_name='$unitName',unit_details='$unitDetails' WHERE id='$id'";
					if(mysqli_query($con,$query_UpdateUnit)) {
						echo "<script> alert(\"Unit Updated Successfully\"); </script>";
						header('Refresh:0;url=view_unit.php');
					}
					else {
						$requireErr = "Updating Unit Failed";
					}
				}
				else {
					$requireErr = "* Valid Unit Name is required";
				}
			}
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
<title>Manage Inventory</title>

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
                <a href="AdminManageUnit.php" class="active">
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
                <span>Manage Unit</span>
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
		<h1>Update Unit</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="unitName">Unit Name</label> </div>
			<div class="input-box"> <input type="text" id="unitName" name="txtUnitName" placeholder="Unit Name" value="<?php echo $row_selectUnitDetails['unit_name']; ?>" required /> </div> <span class="error_message"><?php echo $unitNameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="unitDetails">Details</label> </div>
			<div class="input-box"><textarea id="unitDetails" name="txtunitDetails" placeholder="Details"><?php echo $row_selectUnitDetails['unit_details']; ?></textarea> </div>
		</li>
		<li>
			<input type="submit" value="Update Unit" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
</body>
</html>