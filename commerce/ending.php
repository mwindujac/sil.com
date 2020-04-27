<?php 
require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');

$sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
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
		<a href="cart.php"><button class="btn btn-light mr-2">VIEW CART</button></a>
        <a href="login.php"><button class="btn btn-danger">Login</button></a>
    </div>
    </nav>
	
	<div>
        <div>
            <div>
                <div class="col-lg-11 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-2 py-2">
                       <div>
					   <a href="cart.php"><h3><div style="background-color:green; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">Order placed successifully</span></div></h3></a>
                           <h2 class="text-center mt-2">Thank you for shopping with us</h2>
                          
                           <hr>
                        </div>
                         <div class="card-body" style="text-align:center">
                            <img src="imgs/cart1.jpg"/>
                               
						 </div>
                        </div>
					   <a href="cart.php"><h3><div style="background-color:green; padding: 15px;	text-align: center;"><span style="font-size: 25px; font-family: Harlow Solid Italic; color:black; color: white;">WELCOME BACK AGAIN, WE ARE HERE TO HELP YOU</span></div></h3></a>
                          <div class="card-footer">
                         
                        </div>
                        </form>
                    </div>
					<br><br>
                </div>
			</div>
            </div>
	<?php require_once('includes/footer.php')?>