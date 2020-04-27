<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
	if(isset($_GET['type']) && $_GET['type']!='')
	{
		$type=get_safe_value($con,$_GET['type']);
		if($type=='delete')
		{
			$id=get_safe_value($con,$_GET['id']);
			
		}
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
									<thead class="alert alert-danger">
										<tr>
											<th class="serial">No.</th>
											<th>ID</th>
											<th>NAME</th>
											<th>EMAIL</th>
											<th>MOBILE</th>
											<th>DATE</th>
											<th></th>
										</tr>
									</thead>
										<tbody>
										<?php 
										$num=1;
										while($row=mysqli_fetch_assoc($result)) { ?>
											<tr>
												<td class="serial"><a class="alert alert-secondary"><?php echo $num?></a></td>
												<td><?php echo $row['id'] ?></td>
												<td><?php echo $row['name'] ?></td>
												<td><?php echo $row['email'] ?></td>
												<td><?php echo $row['phone'] ?></td>											
												<td><?php echo $row['add_time'] ?></td>
												<td><?php 
												
												echo "<a class='alart alert-danger float-right ml-2' href='?type=contact&id=".$row['id']."'><button class='btn btn-success float-right'>Contact via email</button></a>";

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