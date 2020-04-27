<?php require_once('includes/header.php');
require_once('admin/connect.php');
require_once('admin/functions.php');
require_once('add_to_cart.php');

 
 $qty="";
 $prc="";
 $sql="select * from e_category where Status=1 order by Category asc";
 $result=mysqli_query($con, $sql);
 $cat_arrays=array();
 while($row=mysqli_fetch_assoc($result))
 {
	$cat_arrays[]=$row;
 }
 $obj=new add_to_list();
 $productTotal=$obj->productTotal();
 $product_id='';
 if(isset($_GET['id']) && $_GET['id']!='')
{
$product_id=mysqli_real_escape_string($con, $_GET['id']);
}else
{
	header('location:index.php');
}
 $get_product=get_product($con, '', '', $product_id);

 if($_SERVER['REQUEST_METHOD']=='POST')
	{		
				$qty=$_POST['qty'];
				$prc=$get_product['0']['price'];
				$type='add';
				header("location:cart_manager.php?id=$product_id&type=$type&qty=$qty");
				
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
		<a href="cart.php?products=<?php echo $productTotal ?>"><button class="btn btn-light mr-2">VIEW CART</button></a>
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

                         <div class="card-body">
						 <div class="" style="width:100%; height:500px">
						 <div class="alert alert-success float-left" style="width:50%; height:500px">
						 <img class="md-3" height="480px" width="99%" src="uploads/products/<?php echo $get_product['0']['image']?>" alt="product images"/>
						 </div>
						 
						 <div class="alert alert-danger float-right" style="width:50%; height:500px">
							<form method="post">
						 <div class="alert alert-light" style="width:98%">

						 <h2>Product name:<?php echo '  '.$get_product['0']['name']?></h2>
						 </div>
						 
						 <h2><span>Price: Ksh.</span> <?php echo $get_product['0']['price']?></h2><br>
						 <?php $prc=$get_product['0']['price'];
						 ?>
						 <h2><span>Availability:</span> In stock</h2><br>
						
						 <hr>
						 <h2>Select number of products</h2>
						 <select name="qty" class="form-control" id="p_qty">
						 
						<?php
						$i=1;
						while($i<1001)
						{
				            echo "<option value=".$i.">".$i."</option>";
							$i++;
						}
						?>
						 </select>
						 <hr>
						 <a href="cart.php" class="alert alert-success float-left"><span><?php echo $productTotal ?> products selected</span></a>
						 <button class="btn btn-danger float-right">&rAarr; Add to cart</button>
							</form>
						 </div>
						 </div>
						 <hr>
						 <div class="alert alert-danger" style="width:100%">
						 <h1>Description</h1>
						 <p><?php echo $get_product['0']['description']?></p>
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
function manage_cart(P_id)
{
	var p_qty=jQuery("#p_qty").val();
	jQuery.ajax((
	url:'sel_cart.php';
	type:'post';
	data:'p_id='+p_id+'p_qty='+p_qty+'$type='+type,
	success:function(result){}
	));
}
	</script>
	<?php require_once('includes/footer.php')?>