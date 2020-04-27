<?php 
    require_once('includes/header.php');
	require_once('admin/connect.php');
	require_once('admin/functions.php');
	require_once('includes/logged_nav.php');
	
	$sql_del="select * from contacts order by id desc";
	$result=mysqli_query($con, $sql_del);
	
	?>
	<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-1 py-2">
                       <div>
					   <ul>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Contacts List</h2>
                        </ul>
						   
                        </div>
                         <div class="card-body">
                              <div class="table-stats order-table ov-h">
								<table class="table">
									<thead>
										<tr>
											<th class="serial">No.</th>
											<th>ID</th>
											<th>NAME</th>
											<th>EMAIL</th>
											<th>MOBILE</th>
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
												<td><?php echo $row['name'] ?></td>
												<td><?php echo $row['email'] ?></td>
												<td><?php echo $row['mobile'] ?></td>
												<td><?php echo $row['comment'] ?></td>
												<td><?php echo $row['added_on'] ?></td>
												<td><?php 
												echo "<a class='alart alert-danger float-right ml-2' href='send_message.php?id=".$row['id']."'>
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