<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');

 
 $sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
 }
$name='';
$email='';
$phone='';
$message='';
$error='';
$added_on='';
 if($_SERVER['REQUEST_METHOD']=='POST')
	{		
				$name=$_POST['name'];
				$email=$_POST['email'];
				$phone=$_POST['phone'];
				$message=$_POST['message'];
				$added_on=date('Y-m-d h:i:s');

				if($message=="")
					{
					$error='<h1 class="alert alert-danger">Please enter your message</h1>';
					}
				else 
				{
					$sql="insert into contacts(name, email, mobile, comment, added_on) values ('$name','$email','$phone','$message','$added_on')";
					mysqli_query($con, $sql);
				}
			
	}
 
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
        <a href="login.php"><button class="btn btn-danger">Login</button></a>
    </div>
    </nav>
	
	        <h2 style="text-align:center" class="bg-danger">Suresy Enterprises Limited <?php echo date('d-m,Y') ?></h2>
            <hr>
          
<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
                    <div class="card mt-1 py-2">
                       <div>
                           <h2 class="text-center mt-2 text-danger"><strong>WELCOME SHOP WITH US</strong></h2>
							<?php echo $error; ?>
						
                           <hr>
                        </div>
                         <div class="card-body">
						 <div class="" style="width:100%; height:500px">
						 <div class="alert alert-success float-left" style="width:50%; height:500px">
						 <div class="alert alert-light">
						 <h1>Send mail here</h1>
						 </div>
							<form method="post" enctype="multipart/form-data">
								<input type="text" id="name" name="name" placeholder="Enter your name*" class="form-control py-2 mb-2" required value="<?php echo $name ?>">
								<input type="email" id="email" name="email" placeholder="Enter your email" class="form-control py-2 mb-2" required value="<?php echo $email ?>">
								<input type="text" id="phone" name="phone" placeholder="Enter phone number" class="form-control py-2 mb-2" required value="<?php echo $phone ?>">
								<textarea class="form-control py-2 mb-2" id="message" name="message" rows="6" placeholder="Type your message here"></textarea>
								<button class="btn btn-danger float-right" type="submt" name="submit">SEND EMAIL</button>
							 </form>
						 </div>
						 
						 <div class="alert alert-danger float-right" style="width:50%; height:500px">
						 <div class="alert alert-light" style="width:98%">
						 <h1>Contact us</h1>
						 </div>
                          <br>
						  <div class="alert alert-light" style="width:98%">
						 <h1>Our address</h1>
						 <p>P.O Box 2500, Eldoret</p>
						 </div>		
							<div class="alert alert-light" style="width:98%">
						 <h1>Plone</h1>
						 <p>0768775952, 0740531699</p>
						 </div>	

						 </div>
						 </div>
						 <hr>
						 <div class="alert alert-danger" style="width:100%">
						 <div class="alert alert-light" style="width:98%">
						 <h1>Send mail here</h1>
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

<script>
/*
function send_message()
{
	
	var name=document.getElementById("name").value;
	var email=document.getElementById("email").value;
	var phone=document.getElementById("phone").value;
	var message=document.getElementById("message").value;
	var err=""
	if(name=="")
	{
		alert('Please enter name');
	}
	else if(email=="")
	{
		alert('Please enter email');
	}
	else if(phone=="")
	{
		alert('Please enter phone');
	}
	 else if(message=="")
	{
		alert('Please enter message');
	}
	else 
	{
		jQuery.ajax({
			url:'send_message.php',
			type:'post',
			data:'$name'+name+'$email'+email+'$phone'+phone+'$message'+message,
			success:function(result)
			{
				alert(result);
			}
			
			
		});
	}
	
}
*/
</script>

	<?php require_once('includes/footer.php')?>