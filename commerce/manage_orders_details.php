<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
	$order_id='';
	if(isset($_GET['id']) && $_GET['id']!='')
    {
	$order_id=get_safe_value($con, $_GET['id']);
	}else
	{
		header('location:manage_orders.php');
	}
	if(isset($_POST['order_upt']))
	{
		$order_upt=$_POST['order_upt'];
		$pay_upt=$_POST['pay_upt'];
		
		$upd_sql="update orders set pay_status='$pay_upt', order_status='$order_upt' where id='$order_id'";
		mysqli_query($con,$upd_sql);
		header('location:manage_orders.php');
	}
	$sql_del="select * from users where status=1 order by id desc";
	$result=mysqli_query($con, $sql_del);
	
	?>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-11 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-1 py-2">
                       <div>
					   <ul>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Users List</h2>
                        </ul>
						   
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
										
										
										$o_d_sql="select distinct(order_details.id),order_details.*,e_product.name,
										e_product.image from 
										order_details,e_product,orders where order_details.order_id='$order_id' and 
										order_details.product_id=e_product.id";
										$total_prc=0;
										$res=mysqli_query($con,$o_d_sql);
										while($row=mysqli_fetch_assoc($res)){
											$total_prc=$total_prc+($row['price']*$row['quantity']);
										
										?>
											<tr>
												<td><img height="80" width="80" src="uploads/products/<?php echo $row['image']?>"/></td>
												<td><?php echo $row['name'] ?></td>
												<td>Ksh. <?php echo $row['price'] ?></td>
												<td><?php echo $row['quantity'] ?></td>
												<td>Ksh. <?php echo $row['price']*$row['quantity'] ?></td>
											</tr>
											
										<?php } ?>
										<td></td>
											<td>GRAND TOTAL</td>
											<td></td>
											<td></td>
											<td>Ksh. <?php echo $total_prc?></td>
											<td></td>
										</tbody>
								</table>
								<hr>
								<div class="alert alert-success">
								<h2>Customer details</h2>
								<?php 
								$qry="select * from orders where id='$order_id'";
	                            $result=mysqli_query($con, $qry);
								$row=mysqli_fetch_assoc($result);
								$u_name=$row['u_name'];
								$id_no=$row['id_no'];
								$mail=$row['email'];
								$phone=$row['phone'];
								?>
								<h2 class="alert alert-light">Customer name: <?php echo $u_name ?>  <br> Email: <?php echo $mail ?></h2><h2 class="alert alert-light"> Customer ID: <?php echo $id_no ?> <br>Phone: <?php echo $phone ?></h2>
								<h2>Status:</h2>
								<?php 
								$st_sql="select order_status.name,orders.pay_status from order_status,orders where orders.id='$order_id' and orders.order_status=order_status.id";
								$status_arr=mysqli_fetch_assoc(mysqli_query($con, $st_sql));
							
								echo '<h2 class="alert alert-light">Payment status: '.$status_arr["pay_status"].'</h2>';
								echo '<h2 class="alert alert-light">Order status: '.$status_arr["name"].'</h2>';
								?>
								<div>
								<form method="post">
								<label for="pay_upt">Update payment status</label>
								<select name="pay_upt" class="form-control py-2 mb-2" required>
								<option value="Pending">Pending</option>
								<option value="Processing">Processing</option>
								<option value="Cancelled">Cancelled</option>
								<option value="Completed">Completed</option>
								<option value="Money returned">Money returned</option>
								
								</select>
								<label for="order_upt">Update order status</label>
									<select name="order_upt" class="form-control py-2 mb-2" required>
									<option>Select status</option>
									<?php
									$opt=mysqli_query($con, "select * from order_status");
									while($row=mysqli_fetch_assoc($opt))
									{			
										echo "<option value=".$row['id'].">".$row['name']."</option>";
										
									}
									?>
								 </select>
								<input type="submit" class="form-control py-2 mb-2 alert alert-danger"/>
								</form>
								</div>
								</div>
								
								
							  </div>
                             </div>
                          <div class="card-footer">
                         
                        </div>
                        </form>
                    </div>
                </div>
			</div>
            </div>
			<br><br>
        </div><?php require_once('includes/footer.php')?>