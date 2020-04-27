<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');
if(!(isset($_SESSION['cart']))){
			header('location:cart.php');
		}
$products='';
if(isset($_GET['products']) && $_GET['products']!='')
{
	$products=get_safe_value($con,$_GET['products']);
	
}
$sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
 }
 

if(isset($_GET['type']) && $_GET['type']!='')
	{
		$type=get_safe_value($con,$_GET['type']);
		if($type=='delete')
		{
			$key=get_safe_value($con,$_GET['key']);
			unset($_SESSION['cart'][$key]);
		}
		
	}
$totals=0;
	if(!(isset($_SESSION['cart']))){}
	else{
	foreach($_SESSION['cart'] as $key=>$val){
	    $prd_Arr=get_product($con, '', '', $key);
		$price=$prd_Arr[0]['price'];
		$qty=$val['p_qty'];
		$amt=$qty*$price;								
		$totals=$totals+$amt;		
	}
	}
if(isset($_POST['submit']))
{
	$u_no=get_safe_value($con, $_POST['id_no']);
	$name=get_safe_value($con, $_POST['name']);
	$email=get_safe_value($con, $_POST['email']);
	$phone=get_safe_value($con, $_POST['phone']);
	$pay_type=get_safe_value($con, $_POST['pay_type']);
	$t_price=$totals;
	$pay_status='Pending';
	$order_status='1';
	$add_time=date('Y-m-d h:i:s');
	
		if(!(isset($_SESSION['cart']))){
			header('location:cart.php');
		}
	else{
	$sql_ins="insert into orders(id_no,u_name,email,phone,pay_type,t_price,pay_status,order_status,add_time)values('$u_no','$name','$email','$phone','$pay_type','$t_price','$pay_status','$order_status','$add_time')";
	mysqli_query($con, $sql_ins);
	}
	    $order_id=mysqli_insert_id($con);
		
		foreach($_SESSION['cart'] as $key=>$val){
	    $prd_Arr=get_product($con, '', '', $key);
		$price=$prd_Arr[0]['price'];
		$qty=$val['p_qty'];
		
		$det_ins="insert into order_details(order_id,product_id,quantity,price)values('$order_id','$key','$qty','$price')";
		mysqli_query($con, $det_ins);
	}
	unset($_SESSION['cart']);
	header('location:ending.php');
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
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Checkout</h2>
                          
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
											<th>ACTION</th>
											
										</tr>
									</thead>
										<tbody>	
										<?php 
										$total=0;
										$items=0;
										foreach($_SESSION['cart'] as $key=>$val){
											$prd_Arr=get_product($con, '', '', $key);
											$newId=$prd_Arr[0]['id'];
											$name=$prd_Arr[0]['name'];
											$price=$prd_Arr[0]['price'];
											$image=$prd_Arr[0]['image'];
											$qty=$val['p_qty'];
											$amt=$qty*$price;
											
											$total=$total+$amt;
											$items=$items+$qty;
										
										?>
											<tr>
												
												<td><img height="100" width="100" src="uploads/products/<?php echo $prd_Arr['0']['image']?>"/></td>
												<td><h2><?php echo $name ?></h2>
												<h2>Quantity: <?php echo $qty ?></h2>
												</td>
												<td><h2>Ksh. <?php echo $price ?></h2>
												<h2>Ksh. <?php echo $amt ?></h2>
												</td>
												<td><?php 
												echo "<a class='alart alert-danger' href='?type=delete&key=$key'><button class='btn btn-danger'>&neArr; Remove</button></a>";
												?></td>
											</tr>
										<?php } ?>
										<td><h1>TOTALS</h1></td>
												<td><h2><?php echo $items ?></h2></td>
												<td><h2>Ksh. <?php echo $total ?></h2></td>
												
										</tbody>
								</table>
								<div class="alert alert-success">
								<h2 class="align-centre">PAYMENT INFORMATION</h2>
								<form method="post">
								<div class="alert alert-light">
								<input type="radio" name="pay_type" value="credit" required />Credit card <br>
								<input type="radio" name="pay_type" value="cheque" required />Money order/Cheque <br>
								<input type="radio" name="pay_type" value="paybill" required />Mpesa Paybill <br>
								<input type="radio" name="pay_type" value="till" required />Mpesa Till number <br>
								<input type="radio" name="pay_type" value="cash" required />Cash on delivery <br>
								</div>
								
								<div class="alert alert-light">
								<h2 class="align-centre">Your details*</h2>
								<input type="text" name="id_no" placeholder="Enter ID no" class="form-control py-2 mb-2" required>
								<input type="text" name="name" placeholder="Enter name" class="form-control py-2 mb-2" required>
								<input type="email" name="email" placeholder="Enter email" class="form-control py-2 mb-2" required>
								<input type="text" name="phone" placeholder="Enter phone number" class="form-control py-2 mb-2" required>
								<?php $cart_total=$total ?>
								<button class="btn btn-dark float-right" type="submit" name="submit">Submit</button>
								<br><br>
								</div>
								</form>
								<hr>
								</div>
					   <h3><div style="background-color:red; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">THANK YOU FOR SHOPPING WITH US</span></div></h3>
								<hr>
								<a href="index.php"><button class="btn btn-secondary float-left">CONTINUE SHOPPING</button></a>
							  
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