<?php require_once('includes/header.php')?>
<?php require_once('includes/logged_nav.php');
	$email='';
	$error='';
	$id='';
if(isset($_GET['id']) && $_GET['id']!='')
{
	$id=get_safe_value($con, $_GET['id']);
	$qry="select * from contacts where id='$id'";
	$result=mysqli_query($con, $qry);
	$row=mysqli_fetch_assoc($result);
	$email=$row['email'];
}	
if(isset($_GET['type']) && $_GET['type']!='')
	{
		$type=get_safe_value($con,$_GET['type']);
		if($type=='delete')
		{
			$id=get_safe_value($con,$_GET['id']);
			$cnt_delete="delete from contacts where id='$id'"; 
			mysqli_query($con, $cnt_delete);
			header('location:contacts.php');
		}
		if($type=='update')
		{
			$id=get_safe_value($con,$_GET['id']);
			$sel_qry="select * from notification where id='$id'";
			$rst=mysqli_query($con, $sel_qry);
			$rows=mysqli_fetch_assoc($rst);
			$status=$row['status'];
			if($status==1){
			$cnt_update="update notification set status='0' from contacts where id='$id'"; 
			mysqli_query($con, $cnt_update);
			header('location:contacts.php');
			}else{
				$cnt_update="update notification set status='1' from contacts where id='$id'"; 
			mysqli_query($con, $cnt_update);
			header('location:contacts.php');
			}
		}
	}
	if($_SERVER['REQUEST_METHOD']=='POST')
	{		
				$message=$_POST['message'];
				$added_on=date('Y-m-d h:i:s');

				if($message=="")
					{
					$error='<h1 class="alert alert-danger">Please enter your message</h1>';
					}
				else 
				{
					$sql="insert into notification(not_id, email, inform, added_on,status) values ('$id','$email','$message','$added_on','1')";
					mysqli_query($con, $sql);
					header('location:contacts.php');
					
				}
        
	}
	



?>
<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-8 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-2 py-2">
                       <div>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Send message</h2>
                          
                           <hr>
                        </div>
                         <div class="card-body">
                             <div class="form-group">
							 <?php echo $error ?>
							 <?php
							 if($id!='')
							 {
							 echo "<a class='alart alert-danger float-right ml-2' href='notification_manager.php?id=$id'>
									<button class='btn btn-success float-right'>MY REPLY</button></a>";

							echo "<a class='alart alert-danger float-right ml-2' href='?type=delete&id=$id'>
									<button class='btn btn-danger float-right'>Delete Contact</button></a>";
							 }
							 ?>
							<form method="post" enctype="multipart/form-data">
							 <label for="categories" class="form-control-label"><strong>Send notifications</strong></label>
							 	
								<br>

								
							  <input type="email" name="email" placeholder="Enter email" class="form-control py-2 mb-2" required value="<?php echo $email ?>">
							<textarea class="form-control py-2 mb-2" id="message" name="message" rows="6" placeholder="Type your message here"></textarea>

							<hr>
							<button class="btn btn-dark float-right" type="submit" name="submit">>> SEND</button>
							  </form>
							  <br>
							  
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