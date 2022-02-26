<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$query_selectCategory = "SELECT cat_id,cat_name FROM categories";
			$query_selectUnit = "SELECT id,unit_name FROM unit";
			$result_selectCategory = mysqli_query($con,$query_selectCategory);
			$result_selectUnit = mysqli_query($con,$query_selectUnit);
			$name = $price = $unit = $category = $rdbStock = $description = "";
			$nameErr = $priceErr = $requireErr = $confirmMessage = "";
			$nameHolder = $priceHolder = $descriptionHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtProductName'])) {
					$nameHolder = $_POST['txtProductName'];
					$name = $_POST['txtProductName'];
				}
				if(!empty($_POST['txtProductPrice'])) {
					$priceHolder = $_POST['txtProductPrice'];
					$resultValidate_price = validate_price($_POST['txtProductPrice']);
					if($resultValidate_price == 1) {
						$price = $_POST['txtProductPrice'];
					}
					else {
						$priceErr = $resultValidate_price;
					}
				}
				if(isset($_POST['cmbProductUnit'])) {
					$unit = $_POST['cmbProductUnit'];
				}
				if(isset($_POST['cmbProductCategory'])) {
					$category = $_POST['cmbProductCategory'];
				}
				if(empty($_POST['rdbStock'])) {
					$rdbStock = "";
				}
				else {
					if($_POST['rdbStock'] == 1) {
						$rdbStock = 1;
					}
					else if($_POST['rdbStock'] == 2) {
						$rdbStock = 2;
					}
				}
				if(!empty($_POST['txtProductDescription'])) {
					$description = $_POST['txtProductDescription'];
					$descriptionHolder = $_POST['txtProductDescription'];
				}
				if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 1) {
					$rdbStock = 0;
					$query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category','$rdbStock')";
					if(mysqli_query($con,$query_addProduct)) {
						echo "<script> alert(\"Product Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Product Failed";
					}
			}
				else if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 2) {
						$query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category',NULL)";
					if(mysqli_query($con,$query_addProduct)) {
						echo "<script> alert(\"Product Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Product Failed";
					}
				}
				else {
					$requireErr = "* All Fields are Compulsory with valid values except Description";
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
<title>Add Products</title>

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
                <a href="AdminAddProducts.php" class="active">
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
                <span>Add Products</span>
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
		<h1>Fill the following details.</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
            <li>
                <div class="label-block"> <label for="product:name">Product Name</label> </div>
                <div class="input-box"> <input type="text" id="product:name" name="txtProductName" placeholder="Product Name" value="<?php echo $nameHolder; ?>" required /> </div> <span class="error_message"><?php echo $nameErr; ?></span>
            </li>
            <li>
                <div class="label-block"> <label for="product:price">Price</label> </div>
                <div class="input-box"> <input type="text" id="product:price" name="txtProductPrice" placeholder="Price" value="<?php echo $priceHolder; ?>" required /> </div> <span class="error_message"><?php echo $priceErr; ?></span>
            </li>
            <li>
                <div class="label-block"> <label for="product:unit">Unit Type</label> </div>
                <div class="input-box">
                <select name="cmbProductUnit" id="product:unit">
                    <option value="" disabled selected>--- Select Unit ---</option>
                    <?php while($row_selectUnit = mysqli_fetch_array($result_selectUnit)) { ?>
                    <option value="<?php echo $row_selectUnit["id"]; ?>"> <?php echo $row_selectUnit["unit_name"]; ?> </option>
                    <?php } ?>
                </select>
                </div>
            </li>
            <li>
                <div class="label-block"> <label for="product:category">Category</label> </div>
                <div class="input-box">
                <select name="cmbProductCategory" id="product:category">
                    <option value="" disabled selected>--- Select Category ---</option>
                    <?php while($row_selectCategory = mysqli_fetch_array($result_selectCategory)) { ?>
                    <option value="<?php echo $row_selectCategory["cat_id"]; ?>"> <?php echo $row_selectCategory["cat_name"]; ?> </option>
                    <?php } ?>
                </select>
                </div>
            </li>
            <li>
                <div class="label-block"> <label for="product:stock">Stock Management</label> </div>
                <div class="rbuttons">
                    <input type="radio" name="rdbStock" value="1">Enable
                    <input type="radio" name="rdbStock" value="2">Disable
                </div>
            </li>
            <li>
                <div class="label-block"> <label for="product:description">Description</label> </div>
                <div class="input-box"> <textarea type="text" id="product:description" name="txtProductDescription" placeholder="Description"><?php echo $descriptionHolder; ?></textarea> </div>
            </li>
            <li>
                <input type="submit" value="Add Product" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
            </li>
		</ul>
		</form>
	</section>

</body>
</html>