<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');
$mail='';
if(isset($_GET['mail']) && $_GET['mail']!='')
{
$mail=get_safe_value($con, $_GET['mail']);
}
 $sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
 }
if(isset($_POST['submit']))
{
	$mail=get_safe_value($con, $_POST['email']);
}
?>

<nav class="navbar navbar-expand-sm navbar-green bg-secondary">
    <div class="container" style="background:green">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link" style="color:white">Home</a>
            </li>
			<?php 
			foreach($cat_arrays as $list){
			?>
			<li class="nav-item">
                <a href="product_details.php?id=<?php echo $list['id'] ?>" class="btn btn-dark mr-1" style="color:white"><?php echo $list['Category'] ?></a>
            </li>
			<?php
			}
			?>
			<li class="nav-item">
                <a href="contact_us.php" class="nav-link" style="color:white">Cuntact us</a>
            </li>
			
			
			
        </ul>
		<a class='alart alert-dark float-right mr-2' href='cart.php'><button class='btn btn-light float-right'>&olarr; BACK TO CART</button></a>
        <a href="login.php"><button class="btn btn-danger">Login</button></a>
    </div>
    </nav>
<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-11 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-2 py-2">
                       <div>
					   <h3><div style="background-color: purple; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white; ">Your True Partner. We are here to help you.</span></div></h3>
                           
						   <h2 class="text-center mt-2">Email Required here</h2>
						   <form method="post">
						   <h2 class="text-center mt-2"><input type="email" name="email" placeholder="Enter your email" required></h2>
                           <h2 class="text-center mt-2"><button class="btn btn-dark" type="submit" name="submit">OK</button></h2>
						   </form>
						   <?php
						   $notifications=0;
						   $not_id='';
						   $not_sql="select * from notification where email='$mail' and status=1";
										$re=mysqli_query($con,$not_sql);
										while($row=mysqli_fetch_assoc($re))
										{
											$not_id=$row['not_id'];
											$notifications++;
										}
										
							?>
						   <a href="notifications.php?type=get&no=<?php echo $not_id?>"><h2 class="text-center float-right"><?php echo $notifications?> Notifications</h2></a>
                           <hr>
                        </div>
                         <div class="card-body">
                             <div class="table-stats order-table ov-h">
								<table class="table">
									<thead>
										<tr class="alert alert-danger">
											
											<th>Order ID</th>
											<th>Order Date</th>
											<th>Payment Type</th>
											<th>Payment Status</th>
											<th>Order status</th>
											
										</tr>
									</thead>
										<tbody>	
										<?php
										if($mail!='')
										{
										$o_sql="select orders.*,order_status.name as order_status_str from orders,order_status where orders.email='$mail' and order_status.id=orders.order_status";
										$res=mysqli_query($con,$o_sql);
										while($row=mysqli_fetch_assoc($res)){
										?>
											<tr>
												<td><h2><a href="order_det.php?id=<?php echo $row['id'] ?>&mail=<?php echo $mail?>"><button class="btn btn-dark"><?php echo $row['id'] ?></button></a></h2></td>
												<td><h2><?php echo $row['add_time'] ?></h2></td>
												<td><h2><?php echo $row['pay_type'] ?></h2></td>
												<td><h2><?php echo $row['pay_status'] ?></h2></td>
												<td><h2><?php echo $row['order_status_str'] ?></h2></td>
											</tr>
										<?php } }?>
										</tbody>
								</table>
								
					   <h3><div style="background-color:red; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">THANK YOU FOR SHOPPING WITH US</span></div></h3>
								<hr>
								<a href="index.php"><button class="btn btn-secondary float-left">START SHOPPING</button></a>
							  
						 </div>
                        </div>
                          <div class="card-footer">
                         
                        </div>
                        </form>
                    </div>
					<br><br>
                </div>
			</div>
            </div>
	<?php require_once('includes/footer.php')?>