<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$id = $_GET['id'];
			$query_selectCategoryDetails = "SELECT * FROM categories WHERE cat_id='$id'";
			$result_selectCategoryDetails = mysqli_query($con,$query_selectCategoryDetails);
			$row_selectCategoryDetails = mysqli_fetch_array($result_selectCategoryDetails);
			$categoryName = $categoryDetails = "";
			$categoryNameErr = $requireErr = $confirmMessage = "";
			$categoryNameHolder = $categoryDetailsHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtCategoryName'])) {
					$categoryNameHolder = $_POST['txtCategoryName'];
					$categoryName = $_POST['txtCategoryName'];
				}
				if(!empty($_POST['txtCategoryDetails'])) {
					$categoryDetails = $_POST['txtCategoryDetails'];
					$categoryDetailsHolder = $_POST['txtCategoryDetails'];
				}
				if($categoryName != null) {
					$query_UpdateCategory = "UPDATE categories SET cat_name='$categoryName',cat_details='$categoryDetails' WHERE cat_id='$id'";
					if(mysqli_query($con,$query_UpdateCategory)) {
						echo "<script> alert(\"Category Updated Successfully\"); </script>";
						header('Refresh:0;url=view_category.php');
					}
					else {
						$requireErr = "Updating New Category Failed";
					}
				}
				else {
					$requireErr = "* Valid Category Name is required";
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
                <a href="AdminManageInventory.php" class="active">
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
                <span>Manage Inventory</span>
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

    <!-- content -->

    <section class="content-section">
		<h1>Update Category</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="categoryName">Category Name</label> </div>
			<div class="input-box"> <input type="text" id="categoryName" name="txtCategoryName" placeholder="Category Name" value="<?php echo $row_selectCategoryDetails['cat_name']; ?>" required /> </div> <span class="error_message"><?php echo $categoryNameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="categoryDetails">Details</label> </div>
			<div class="input-box"><textarea id="categoryDetails" name="txtCategoryDetails" placeholder="Details"><?php echo $row_selectCategoryDetails['cat_details']; ?></textarea> </div>
		</li>
		<li>
			<input type="submit" value="Update Category" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
</body>
</html>