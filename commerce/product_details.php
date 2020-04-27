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
 //id sessionn
 $cat_id='';
 if(isset($_GET['id']) && $_GET['id']!='')
 {
 $cat_id=mysqli_real_escape_string($con, $_GET['id']);
 }else
 {
	 header('location:index.php');
 }
 $get_product=get_product($con, '', $cat_id);
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
	
	        <h2 style="text-align:center" class="bg-danger">Suresy Enterprises Limited <?php echo date('d-m,Y') ?></h2>
            <hr>

<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-12 m-auto" style="background-color:purple">
                    <div class="card mt-1 py-2">
                       <div>
                           <h2 class="text-center mt-2 text-danger"><strong>WELCOME TO SHOP WITH US</strong></h2>
						   <select class="btn btn-success float-right">
						   <option>Select sorting order</option>
						   <option>Sort by popularity</option>
						   <option>Sort by average rating</option>
						   <option>Sort by newness</option>
						   </select>
						   
                          
                           <hr>
                        </div>
                         <div class="card-body">
						 <?php if(count($get_product)>0) { ?>
                             <div class="form-group">
							 
							 <?php
							  foreach($get_product as $list)
							  {
							 ?>
							 <div class="mt-2" style="float:left ;margin-right:5px; text-align:center; border:solid 2px">
							    
								<a href="individual_product.php?id=<?php echo  $list['id']?>"><img height="305" width="470" src="uploads/products/<?php echo $list['image']?>" alt="product images"/></a>
								<h3><a href="product_details.php"><?php echo  $list['name']?></a></h3>
								
									<a class="btn btn-light"><strong><?php echo "Price: Ksh. ",$list['price']?></strong></a>
									<br>
									<a><?php echo  $list['description']?></a>
							</div>
								
							
							  <?php } ?>
							  </div>
						    <?php } else{
								echo '<p class="btn btn-danger form-control">~Data not found~</p>';
							} ?>
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