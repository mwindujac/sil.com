<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
						$mail=$_SESSION['ADMIN_USERNAME'];
						$qry="select * from users where email='$mail'";
	                    $result=mysqli_query($con, $qry);
	                    $row=mysqli_fetch_assoc($result);
	                    $role=$row['role'];
						if($role=='Main')
						{	
						}
						else
						{
							header('location:users.php');
						}
	if(isset($_GET['type']) && $_GET['type']!='')
	{
		$type=get_safe_value($con,$_GET['type']);
		if($type=='delete')
		{
			$id=get_safe_value($con,$_GET['id']);
			$cnt_delete="delete from users where id='$id'"; 
			mysqli_query($con, $cnt_delete);
		}
		if($type=='status')
		{
			$operation=get_safe_value($con,$_GET['operation']);
			$id=get_safe_value($con,$_GET['id']);
			if($operation=='active')
			{
				$status='1';
			}else
			{
				$status='0';
			}
			$status_update="update users set Status='$status' where id='$id'"; 
			mysqli_query($con, $status_update);
		}
		if($type=='role')
		{
			$operation=get_safe_value($con,$_GET['operation']);
			$id=get_safe_value($con,$_GET['id']);
			if($operation=='upper')
			{
				$role='Main';
			}else
			{
				$role='Minor';
			}
			$role_update="update users set role='$role' where id='$id'"; 
			mysqli_query($con, $role_update);
		}
	}
	$sql_del="select * from users order by id desc";
	$result=mysqli_query($con, $sql_del);
	?>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-1 py-2">
                       <div>
					   <ul>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited User Manager</h2>
						   <a class="float-right" href="admin_add.php"><button class="btn btn-success">ADD ADMIN</button></a>
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
											<th>DATE ADDED</th>
											<th>ROLE</th>
											<th>STATUS</th>
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
												if($row['role']=='Main')
												{
													echo "<a class='alart alert-success' href='?type=role&operation=lower&id=".$row['id']."'><button class='btn btn-secondary'>Main</button></a>";
												}
												else
												{
													echo "<a class='alart alert-danger' href='?type=role&operation=upper&id=".$row['id']."'><button class='btn btn-danger'>Minor</button></a>";
												}
												?></td>
												<td><?php 
												if($row['status']==1)
												{
													echo "<a class='alart alert-success' href='?type=status&operation=deactive&id=".$row['id']."'><button class='btn btn-secondary'>Active</button></a>";
												}
												else
												{
													echo "<a class='alart alert-danger' href='?type=status&operation=active&id=".$row['id']."'><button class='btn btn-danger'>Not Active</button></a>";
												}
												echo "<a class='alart alert-danger float-right ml-2' href='?type=delete&id=".$row['id']."'><button class='btn btn-danger float-right'>Delete</button></a>";

												echo "<a class='alart alert-danger float-right mr-4' href='admin_add.php?id=".$row['id']."'><button class='btn btn-success float-right'>Edit</button></a>";
												?></td>
											</tr>
											<?php  $num=$num+1?>
										<?php } ?>
										</tbody>
								</table>
								<hr>
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