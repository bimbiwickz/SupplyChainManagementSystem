<?php
	include("../includes/config.php");
	include("../includes/validate_data.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			$username = $password = $areacode = $phone = $email = $address = "";
			$usernameErr = $passwordErr = $phoneErr = $emailErr = $requireErr = $confirmMessage = "";
			$usernameHolder = $phoneHolder = $emailHolder = $addressHolder = "";
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(!empty($_POST['txtRetailerUname'])) {
					$usernameHolder = $_POST['txtRetailerUname'];
					$resultValidate_username = validate_username($_POST['txtRetailerUname']);
					if($resultValidate_username == 1) {
						$username = $_POST['txtRetailerUname'];
					}
					else{
						$usernameErr = $resultValidate_username;
					}
				}
				if(!empty($_POST['txtRetailerPassword'])) {
					$resultValidate_username = validate_password($_POST['txtRetailerPassword']);
					if($resultValidate_username == 1) {
						$password = $_POST['txtRetailerPassword'];
					}
					else {
						$passwordErr = $resultValidate_username;
					}
				}
				if(!empty($_POST['txtRetailerPhone'])) {
					$phoneHolder = $_POST['txtRetailerPhone'];
					$resultValidate_phone = validate_phone($_POST['txtRetailerPhone']);
					if($resultValidate_phone == 1) {
						$phone = $_POST['txtRetailerPhone'];
					}
					else {
						$phoneErr = $resultValidate_phone;
					}
				}
				if(!empty($_POST['txtRetailerEmail'])) {
					$emailHolder = $_POST['txtRetailerEmail'];
					$resultValidate_email = validate_email($_POST['txtRetailerEmail']);
					if($resultValidate_email == 1) {
						$email = $_POST['txtRetailerEmail'];
					}
					else {
						$emailErr = $resultValidate_email;
					}
				}
				if(!empty($_POST['txtRetailerAddress'])) {
					$address = $_POST['txtRetailerAddress'];
					$addressHolder = $_POST['txtRetailerAddress'];
				}
				if($username != null && $password != null && $phone != null) {
					$query_addRetailer = "INSERT INTO retailer(username,password,address,phone,email) VALUES('$username','$password','$address','$phone','$email')";
					if(mysqli_query($con,$query_addRetailer)) {
						echo "<script> alert(\"Retailer Added Successfully\"); </script>";
						header('Refresh:0');
					}
					else {
						$requireErr = "Adding Client Failed";
					}
				}
				else {
					$requireErr = "* Valid Username, Password, Areacode & Email are compulsory";
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
<title>Add Clients</title>

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
                <a href="AdminAddClient.php" class="active">
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
                <span>Add Clients</span>
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
		<h1>Add client details below</h1>
		<form action="" method="POST" class="form">
		<ul class="form-list">
		<li>
			<div class="label-block"> <label for="retailer:username">Username</label> </div>
			<div class="input-box"> <input type="text" id="retailer:username" name="txtRetailerUname" placeholder="Username" value="<?php echo $usernameHolder; ?>" required /> </div> <span class="error_message"><?php echo $usernameErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="retailer:password">Password</label> </div>
			<div class="input-box"> <input type="password" id="retailer:password" name="txtRetailerPassword" placeholder="Password" required /> </div> <span class="error_message"><?php echo $passwordErr; ?></span>
		</li>
		<!-- <li>
			<div class="label-block"> <label for="retailer:areaCode">Area Code</label> </div>
			<div class="input-box">
				<select name="cmbAreaCode" id="retailer:areaCode">
					<option value="" disabled selected>--- Select Area Code ---</option>
			<?php while($row_selectArea = mysqli_fetch_array($result_selectArea)) { ?>
			<option value="<?php echo $row_selectArea["area_id"]; ?>"><?php echo $row_selectArea["area_code"]." (".$row_selectArea["area_name"].")"; ?></option>
			<?php } ?>
				</select>
			 </div>
		</li> -->
		<li>
			<div class="label-block"> <label for="retailer:phone">Phone</label> </div>
			<div class="input-box"> <input type="text" id="retailer:phone" name="txtRetailerPhone" placeholder="Phone" value="<?php echo $phoneHolder; ?>" /> </div> <span class="error_message"><?php echo $phoneErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="retailer:email">Email</label> </div>
			<div class="input-box"> <input type="text" id="retailer:email" name="txtRetailerEmail" placeholder="Email" value="<?php echo $emailHolder; ?>" required /> </div> <span class="error_message"><?php echo $emailErr; ?></span>
		</li>
		<li>
			<div class="label-block"> <label for="retailer:address">Address</label> </div>
			<div class="input-box"> <textarea type="text" id="retailer:address" name="txtRetailerAddress" placeholder="Address"><?php echo $addressHolder; ?></textarea> </div>
		</li>
		<li>
			<input type="submit" value="Add Retailer" class="submit_button" /> <span class="error_message"> <?php echo $requireErr; ?> </span><span class="confirm_message"> <?php echo $confirmMessage; ?> </span>
		</li>
		</ul>
		</form>
	</section>
</body>
</html>