<?php require_once('includes/header.php')?>
	<?php require_once('admin/connect.php')?>
	<?php require_once('admin/functions.php')?>
	<?php
	$message='';
	if(isset($_POST['submit']))
	{
		$username=get_safe_value($con, $_POST['UEmail']);
		$password=get_safe_value($con, $_POST['UPassword']);
		$pass=md5($password);
		$sql="select * from users where email='$username' and password='$pass' and status=1";
		$result=mysqli_query($con, $sql);
		$count=mysqli_num_rows($result);
		if($count>0)
		{
			$_SESSION['ADMIN_LOGIN']='yes';
			$_SESSION['ADMIN_USERNAME']=$username;
			header('location:display.php');
			die();
		}else
		{
			$message="Please enter correct details";
		}
	
	}
	?>
	<nav class="navbar navbar-expand-sm navbar-green bg-secondary">
    <div class="container" style="background:green">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="index.php" class="btn btn-dark ml-2" style="color:white">Home</a>
            </li>
			<li class="nav-item">
                <a href="contact_us.php" class="btn btn-dark ml-2" style="color:white">Cuntact us</a>
            </li>
			
			
			
        </ul>
        <a href="login.php"><button class="btn btn-danger">Login</button></a>
    </div>
    </nav>
	<br><br>
	<div class="col-lg-8 m-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-5 py-2">
                       <div class="card-title">
                           <h2 class="text-center mt-2">LOGIN HERE</h2>
                           <p></p>
                           <hr>
                        </div>
                         <div class="card-body">
                              <form method="post">
                               <input type="email" name="UEmail" placeholder="Enter email" class="form-control py-2 mb-2" required>
                                <input type="password" name="UPassword" placeholder="Enter password" class="form-control py-2 mb-2" required>
                               <button class="btn btn-dark float-right" type="submit" name="submit">Login</button>
                               </form>
                             </div>
                          <div class="card-footer">
                         
                        </div>
                        </form>
						<p class="bg-danger text-center lead"><?php echo $message ?></p>
                    </div>
                </div>
			</div>
            </div>
			<br><br>
        </div><?php require_once('includes/footer.php')?>