<?php
require_once('admin/connect.php');
require_once('admin/functions.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] !='')
{
	
}else
{
	header('location:login.php');
	die();
}
?>

<nav class="navbar navbar-expand-sm navbar-green bg-secondary">
    <div class="container" style="background:green">
       
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="display.php" class="nav-link" style="color:white">Categories</a>
            </li>
			<li class="nav-item">
                <a href="products.php" class="nav-link" style="color:white">Products</a>
            </li>

			<li class="nav-item">
                <a href="users.php" class="nav-link" style="color:white">User Master</a>
            </li
			<li class="nav-item">
                <a href="manage_orders.php" class="nav-link" style="color:white">Order Master</a>
            </li>
			<li class="nav-item">
                <a href="contacts.php" class="nav-link" style="color:white">Contacts</a>
            </li>
        </ul>
		<a href="admin_manager.php"><button class="btn btn-light mr-2">Admins</button></a>
        <a href="logout.php"><button class="btn btn-danger">Log out</button></a>
    </div>
    </nav>