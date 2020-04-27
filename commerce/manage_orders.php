<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
	
	$sql_del="select * from users where status=1 order by id desc";
	$result=mysqli_query($con, $sql_del);
	
	?>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
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
											
											<th>Order ID</th>
											<th>Order Date</th>
											<th>email</th>
											<th>Payment Type</th>
											<th>Payment Status</th>
											<th>Order status</th>
											
										</tr>
									</thead>
										<tbody>	
										<?php
										
										$o_sql="select orders.*,order_status.name as order_status_str from orders,order_status where order_status.id=orders.order_status order by orders.id desc";
										$res=mysqli_query($con,$o_sql);
										while($row=mysqli_fetch_assoc($res)){
										?>
											<tr>
												<td><a href="manage_orders_details.php?id=<?php echo $row['id'] ?>"><button class="btn btn-dark"><?php echo $row['id'] ?></button></a></td>
												<td><?php echo $row['add_time'] ?></td>
												<td><?php echo $row['email'] ?></td>
												<td><?php echo $row['pay_type'] ?></td>
												<td><?php echo $row['pay_status'] ?></td>
												<td><?php echo $row['order_status_str'] ?></td>
											</tr>
										<?php } ?>
										</tbody>
								</table>
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