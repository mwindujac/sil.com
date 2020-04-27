<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');

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
		if($type=='emptyCart')
		{
			unset($_SESSION['cart']);
			header('location:index.php');
		}
		if($type=='update')
		{
			$key=get_safe_value($con,$_GET['key']);
			$id=get_safe_value($con,$_GET['id']);
			header('location:individual_product.php?id='.$id.'');
		}
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
		<a href="myorder.php"><button class="btn btn-light mr-2">MY ORDER</button></a>
		 <?php 
			if(isset($_SESSION['cart']))
				{
					echo "<a class='alart alert-dark float-right mr-2' href='?type=emptyCart'><button class='btn btn-light float-right'>&olarr; DROP ALL</button></a>";
				}else
					{
						echo "<a class='alart alert-dark float-right mr-2' href='index.php'><button class='btn btn-light float-right'>&orarr; ADD PRODUCT</button></a>";		
					}
		?>
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
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Cart</h2>
                          
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
										$total=0;
										$items=0;
										if(!(isset($_SESSION['cart']))){
										echo '<h1><div style="background-color:red; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">Dear customer, your cart is empty</span></div></h1>';
										}else{
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
												
												<td><img height="150" width="150" src="uploads/products/<?php echo $prd_Arr['0']['image']?>"/></td>
												<td><h2><?php echo $name ?></h2></td>
												<td><h2>Ksh. <?php echo $price ?></h2></td>
												<td><h2><?php echo $qty ?></h2>
												<?php echo "<a class='alart alert-danger' href='?type=update&key=$key&id=$newId'><button class='btn btn-secondary'>Update Quantity</button></a>"; ?>
												</td>
												<td><h2>Ksh. <?php echo $amt ?></h2></td>
												<td><?php 
													
												echo "<a class='alart alert-danger' href='?type=delete&key=$key'><button class='btn btn-danger'>&neArr; Delete</button></a>";
												?></td>
											</tr>
										<?php } }?>
										<td><h1>TOTALS</h1></td>
												<td><h2></h2></td>
												<td><h2></h2></td>
												<td><h2><?php echo $items ?></h2></td>
												<td><h2>Ksh. <?php echo $total ?></h2></td>
										</tbody>
								</table>
								<hr>
					   <h3><div style="background-color:red; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">THANK YOU FOR SHOPPING WITH US</span></div></h3>
								<hr>
								<a href="index.php"><button class="btn btn-secondary float-left">CONTINUE SHOPPING</button></a>
                                <a href="checkout.php"><button class="btn btn-dark float-right">CHECK OUT</button></a>								
							  </div>
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