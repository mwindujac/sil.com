<?php require_once('includes/header.php')?>
<?php require_once('includes/logged_nav.php');
	$name='';
	$email='';
	$phone='';
	$error='';

if(isset($_GET['id']) && $_GET['id']!='')
{
	$id=get_safe_value($con, $_GET['id']);
	$qry="select * from users where id='$id'";
	$result=mysqli_query($con, $qry);
	$row=mysqli_fetch_assoc($result);
	$name=$row['name'];
	$email=$row['email'];
	$phone=$row['phone'];
}	
	
if(isset($_POST['submit']))
{
	$name=get_safe_value($con, $_POST['name']);
	$email=get_safe_value($con, $_POST['email']);
	$password=get_safe_value($con, $_POST['password']);
	$phone=get_safe_value($con, $_POST['phone']);
	$password2=get_safe_value($con, $_POST['password2']);
	$added_on=date('Y-m-d h:i:s');
	if(isset($_GET['id']) && $_GET['id']!='')
	{
		$sql="update users set name='$name', email='$email', phone='$phone' where id='$id'";
	    mysqli_query($con, $sql);
		header('location:admin_manager.php');
	}else
	{
		if(strlen($password)<6 || strlen($password)>10)
		{
			$error='<h2 class="alert alert-danger">Enter password between 6 & 10 characters. Use mixed uppercase and lowercase, and numbers</h2>';
		}
		else{
		if($password==$password2){
		$pass=md5($password);
	$sql="insert into users(name, email, password, phone, add_time, status, role) values ('$name','$email','$pass','$phone','$added_on','1','Minor')";
	mysqli_query($con, $sql);
	header('location:admin_manager.php');
	die();
		}
		else
		{
			$error='<h2 class="alert alert-danger">Passwords do not match</h2>';
		}
	}
	}
}


?>
<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-8 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-5 py-2">
                       <div>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Category Add</h2>
                          
                           <hr>
                        </div>
                         <div class="card-body">
                             <div class="form-group">
							 <form method="post">
							 <label for="categories" class="form-control-label"><strong>ADMINS</strong></label>
							 <br>
							 <?php echo $error ?>
							  <input type="text" name="name" placeholder="Enter name" class="form-control py-2 mb-2" required value="<?php echo $name ?>">
							  <input type="email" name="email" placeholder="Enter email" class="form-control py-2 mb-2" required value="<?php echo $email ?>">
							  <input type="text" name="phone" placeholder="Enter phone" class="form-control py-2 mb-2" required value="<?php echo $phone ?>">

							  <?php
							  if(isset($_GET['id']) && $_GET['id']!=''){}
							  else{
							  echo '<input type="password" name="password" placeholder="Enter password" class="form-control py-2 mb-2" required>';
							  echo '<input type="password" name="password2" placeholder="Confirm password" class="form-control py-2 mb-2" required>';
							  }
							?>
							<hr>
							<button class="btn btn-dark float-right" type="submit" name="submit">Submit</button>
							  </form>
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