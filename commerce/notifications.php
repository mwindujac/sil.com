<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	if(isset($_GET['no']) && $_GET['no']!='')
	{
	$not_id=get_safe_value($con, $_GET['no']);
	}
	else
	{
		header('location:myorder.php');
	}
	$sql="select * from e_category where Status=1 order by Category asc";
	$result=mysqli_query($con, $sql);
	$cat_arrays=array();
		while($row=mysqli_fetch_assoc($result))
		{
			$cat_arrays[]=$row;
		}
	$sql_del="select * from notification where not_id='$not_id' and status=1 order by id desc";
	$result=mysqli_query($con, $sql_del);
	
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
		<a href="cart.php"><button class="btn btn-light mr-2">VIEW CART</button></a>
        <a href="login.php"><button class="btn btn-danger">Login</button></a>
    </div>
    </nav>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-1 py-2">
                       <div>
					   <ul>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Contacts</h2>
                        </ul>
						   
                        </div>
                         <div class="card-body">
                              <div class="table-stats order-table ov-h">
								<table class="table">
									<thead>
										<tr>
											<th class="serial">No.</th>
											<th>ID</th>
											<th>CONCERN</th>
											<th>DATE</th>
											<th></th>
										</tr>
									</thead>
										<tbody>
										<?php 
										$num=1;
										while($row=mysqli_fetch_assoc($result)) { ?>
											<tr>
												<td class="serial"><?php echo $num?></td>
												<td><?php echo $row['id'] ?></td>
												<td><?php echo $row['inform'] ?></td>
												<td><?php echo $row['added_on'] ?></td>
												<td><?php 
												echo "<a class='alart alert-danger float-right ml-2' href='contact_us.php'>
												<button class='btn btn-success float-right'>Contact</button></a>";

												?></td>
											</tr>
											<?php  $num=$num+1?>
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