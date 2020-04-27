<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');
$order_id=get_safe_value($con, $_GET['id']);
$mail=get_safe_value($con, $_GET['mail']);
 $sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
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
		<a href="myorder.php?mail=<?php echo $mail?>"><button class="btn btn-light mr-2">MY ORDER</button></a>
		<a href='cart.php'><button class='btn btn-light float-right'>BACK TO CART</button></a>
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
                           <h2 class="text-center mt-2">Order Details</h2>
                           <hr>
                        </div>
                         <div class="card-body">
                             <div class="table-stats order-table ov-h">
								<table class="table">
									<thead>
										<tr class="alert alert-danger">
											<th>PRODUCT</th>
											<th>NAME</th>
											<th>PRICE</th>
											<th>QUANTITY</th>
											<th>TOTAL</th>
											<th>ACTION</th>
											
										</tr>
									</thead>
										<tbody>	
										<?php
										if($mail!='')
										{
											$total_prc=0;
										$o_sql="select distinct(order_details.id),order_details.*,e_product.name,e_product.image,orders.email from order_details,e_product,orders where order_details.order_id='$order_id' and orders.email='$mail' and order_details.product_id=e_product.id";
										$res=mysqli_query($con,$o_sql);
										while($row=mysqli_fetch_assoc($res)){
											$total_prc=$total_prc+($row['price']*$row['quantity'])
										?>
											<tr>
												<td><img height="80" width="80" src="uploads/products/<?php echo $row['image']?>"/></td>
												<td><h2><?php echo $row['name'] ?></h2></td>
												<td><h2>Ksh. <?php echo $row['price'] ?></h2></td>
												<td><h2><?php echo $row['quantity'] ?></h2></td>
												<td><h2>Ksh. <?php echo $row['price']*$row['quantity'] ?></h2></td>
											</tr>
											
										<?php } }?>
										<td></td>
											<td><h2>GRAND TOTAL</h2></td>
											<td></td>
											<td></td>
											<td><h2>Ksh. <?php echo $total_prc?></h2></td>
											<td></td>
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