<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
	$notf_id='';
	if(isset($_GET['id']) && $_GET['id']!='')
	{
		$notf_id=get_safe_value($con,$_GET['id']);
	}
	if(isset($_GET['type']) && $_GET['type']!='')
	{
		$type=get_safe_value($con,$_GET['type']);
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
			$status_update="update notification set status='$status' where id='$id'"; 
			mysqli_query($con, $status_update);
		}
		
		if($type=='delete')
		{
			$id=get_safe_value($con,$_GET['id']);
			$ct_delete="delete from notification where id='$id'"; 
			mysqli_query($con, $ct_delete);
		}
	}
	
	$sql="select * from notification where not_id='$notf_id'order by id desc";
	$result=mysqli_query($con, $sql);
	
	?>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-11 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-1 py-2">
                       <div>
					   <ul>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited</h2>
                       
                        </ul>
						   
                        </div>
                         <div class="card-body">
                              <div class="table-stats order-table ov-h">
								<table class="table">
									<thead>
										<tr>
											<th class="serial">No.</th>
											<th>ID</th>
											<th>MESSAGE</th>
											<th>ACTIVATY STATUS</th>
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