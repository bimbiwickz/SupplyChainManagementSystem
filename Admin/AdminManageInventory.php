<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$query_selectCategory = "SELECT * FROM categories";
			$result_selectCategory = mysqli_query($con,$query_selectCategory);
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['chkId'])) {
					$chkId = $_POST['chkId'];
					foreach($chkId as $id) {
						$query_deleteCategory = "DELETE FROM categories WHERE cat_id='$id'";
						$result = mysqli_query($con,$query_deleteCategory);
					}
					if(!$result) {
						echo "<script> alert(\"Categories assigned to any product can not be deleted\"); </script>";
						header('Refresh:0');
					}
					else {
						echo "<script> alert(\"Category Deleted Successfully\"); </script>";
						header('Refresh:0');
					}
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
		<h1>View Category</h1>
		<form action="" method="POST" class="form">
		<table class="table_displayData">
			<tr>
				<th> <input type="checkbox" onClick="toggle(this)" /> </th>
				<th>Sr. No.</th>
				<th>Name</th>
				<th>Description</th>
				<th> Edit </th>
			</tr>
			<?php $i=1; while($row_selectCategory = mysqli_fetch_array($result_selectCategory)) { ?>
			<tr>
				<td> <input type="checkbox" name="chkId[]" value="<?php echo $row_selectCategory['cat_id']; ?>" /> </td>
				<td> <?php echo $i; ?> </td>
				<td> <?php echo $row_selectCategory['cat_name']; ?> </td>
				<td> <?php echo $row_selectCategory['cat_details']; ?> </td>
				<td> <a href="AdminEditCategory.php?id=<?php echo $row_selectCategory['cat_id']; ?>"><span class="material-icons">settings</span></a> </td>
			</tr>
			<?php $i++; } ?>
		</table>
		<input type="submit" value="Delete" class="submit_button"/>
		<a href="AdminAddCategory.php"><input type="button" value="+ Add Category" class="submit_button"/></a>
		</form>
	</section>
</body>
</html>