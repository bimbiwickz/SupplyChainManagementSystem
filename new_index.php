<?php
	include('includes/config.php');
	$reqErr = $loginErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(!empty($_POST['txtUsername']) && !empty($_POST['txtPassword']) && isset($_POST['login_type'])){
			session_start();
			$username = $_POST['txtUsername'];
			$password = $_POST['txtPassword'];
			$_SESSION['sessLogin_type'] = $_POST['login_type'];
			if($_SESSION['sessLogin_type'] == "retailer") {
				//if selected type is retailer than check for valid retailer.
				$query_selectRetailer = "SELECT retailer_id,username,password FROM retailer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectRetailer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['retailer_id'] =  $row['retailer_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['retailer_login'] = true;
					header('Location:client/index.php');
				}
				else {
					$loginErr = "* Username or Password is incorrect.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "manufacturer") {
				//if selected type is manufacturer than check for valid manufacturer.
				$query_selectManufacturer = "SELECT man_id,username,password FROM manufacturer WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectManufacturer);
				$row = mysqli_fetch_array($result);
				if($row) {
					$_SESSION['manufacturer_id'] =  $row['man_id'];
					$_SESSION['sessUsername'] = $_POST['txtUsername'];
					$_SESSION['sessPassword'] = $_POST['txtPassword'];
					$_SESSION['manufacturer_login'] = true;
					header('Location:manufacturer/index.php');
				}
				else {
					$loginErr = "* Username or Password is incorrect.";
				}
			}
			else if($_SESSION['sessLogin_type'] == "admin") {
				$query_selectAdmin = "SELECT username,password FROM admin WHERE username='$username' AND password='$password'";
				$result = mysqli_query($con,$query_selectAdmin);
				$row = mysqli_fetch_array($result);
					if($row) {
						$_SESSION['admin_login'] = true;
						$_SESSION['sessUsername'] = $_POST['txtUsername'];
						$_SESSION['sessPassword'] = $_POST['txtPassword'];
						header('Location:admin/index.php');
					}
					else {
						$loginErr = "* Username or Password is incorrect.";
					}
				}
			}
		else {
			$reqErr = "* All fields are required.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

/* BASIC */

html {
  background-color: #037ef3;
}

body {
  font-family: "Roboto", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display: block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */
h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #037ef3;
  border: none;
  color: white;
  padding: 15px 80px;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  /* -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4); */
  /* box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4); */
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #fff;
  color: #037ef3;
  font-weight: 600;
  border: #037ef3 solid 3px;
}

input[type=text], [type=password] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 100%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

select {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 100%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #0A2558;
}

input[type=text]:placeholder {
  color: #cccccc;
}


/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

* {
  box-sizing: border-box;
}
    </style>
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
  <h1 style="text-align: center;">Welcome to the SCM System</h1>
    <!-- Login Form -->

     <!--php to display if incorrect password and username-->
     <!-- <?php if (isset($_GET['error'])){ ?>
      <p class="error"><?php echo $_GET['error'];?></p>
    <?php }?> -->
    <form  action="" method="POST" class="login-form">
      <label for="login:username">Username :</label>
      <input type="text" id="login:username" name="txtUsername" placeholder="Username" required>
      <label for="login:password">Password :</label>
      <input type="password" id="login:password" name="txtPassword" placeholder="Password" required>
      <br>
      <label for="login:type">Log In As :</label><br>
      <select name="login_type" id="login:type" required>
      <option style="text-align:center;" value="" disabled selected>-- Select Type --</option>
      <option value="admin">Admin</option>
      <!-- <option value="manufacturer">Manufacturer</option> -->
      <option value="retailer">Client</option>
      </select><br>
      <!-- <input style="margin-top: 40px; margin-left: 90px;" type="submit"  value="Log In"> -->
      <input style="margin-top: 40px; margin-left: 90px;" type="submit" value="Login" class="submit_button" /> <span class="error_message"> <?php echo $loginErr; echo $reqErr; ?> </span>
    </form>

  </div>
</div>
</body>
</html>