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
                <a href="index.php">
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
                <a href="ClientHelp.html" class="active">
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
                <span>Help</span>
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
        <br>
        <p> Here's a quick reference guide to help you out. Please do not hesitate to contact us if you have any questions or concerns. We are always there to assist you.
        <br>
        <h1>Dashboard</h1>
            Your username, phone number, email address, and address may all be found in your dashboard. If you like, you can modify your information at any moment using the edit button. On the dashboard, we clearly display the specifics of your recent orders so that you can quickly determine what you ordered.
        <br>
        <h1>Product</h1>
            You can find out what you may buy from our store on the product page. You can see all of the goods as well as their pricing. Every morning, we update our price lists..
        <br>
        <h1>All orders</h1>
            In here you can see your all orders that you ordered from us. All details that you should know about your orders are clearly mentioned in here.
        <br>
        <h1>Place order</h1>
            You can put your orders in this section. All you have to do now is enter the number of each item you wish to purchase. In the total price column, the application automatically calculates your total price.
        </p>
    </section>
</body>
</html>