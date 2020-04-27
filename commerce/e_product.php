<?php require_once('includes/header.php')?>
<?php require_once('includes/logged_nav.php');
	$name='';
	$price='';
	$quantity='';
	$description='';
	$message='';
	$image='';

if(isset($_GET['id']) && $_GET['id']!='')
{
	$id=get_safe_value($con, $_GET['id']);
	$qry="select * from e_product where id='$id'";
	$result=mysqli_query($con, $qry);
	$row=mysqli_fetch_assoc($result);
	$name=$row['name'];
	$price=$row['price'];
	$quantity=$row['quantity'];
	$description=$row['description'];
}	
	//Here is the work
	if($_SERVER['REQUEST_METHOD']=='POST')
	{		
				$category_id=$_POST['category_id'];
				$name=$_POST['name'];
				$price=$_POST['price'];
				$quantity=$_POST['quantity'];
				$description=$_POST['description'];
				
				if(isset($_GET['id']) && $_GET['id']!='')
	              {  
					if(($_FILES['image']['name']!='') && $category_id!='')
					{
					  $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
					  move_uploaded_file($_FILES['image']['tmp_name'],'uploads/products/'.$image);
		              $sql="update e_product set category_id='$category_id', name='$name', price='$price', image='$image', quantity='$quantity', description='$description' where id='$id'";
	                  mysqli_query($con, $sql);
								header('location:products.php');
								die();
							
					}else
						{
							$message="<p class='btn btn-danger form-control py-2 mb-2'>Failed to edit.   Please select a photo or either category not selected</p>";
						}
	               }else
	                { 
						if(($_FILES['image']['name']!='') && $category_id!='')
						{
							$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
							move_uploaded_file($_FILES['image']['tmp_name'],'uploads/products/'.$image);
							$sql="insert into e_product(category_id, name, price, image, quantity, description, Status) values ('$category_id','$name','$price','$image','$quantity','$description','1')";
							mysqli_query($con, $sql);
							header('location:products.php');
		                }else{
							$message="<p class='btn btn-danger form-control py-2 mb-2'>Failed to insert. Please select a photo or either category not selected</p>";
			                 }
			
	                
	            }
        
	}
	



?>
<div class="bg-dark">
        <div>
            <div>
                <div class="col-lg-8 m-auto" style="background-color:purple">
                    <div class="card bg-white mt-2 py-2">
                       <div>
                           <h2 class="text-center mt-2">Suresy Enterprises Limited Category Add</h2>
                          
                           <hr>
                        </div>
                         <div class="card-body">
                             <div class="form-group">
							 <form method="post" enctype="multipart/form-data">
							 <label for="categories" class="form-control-label"><strong>Add Products</strong></label>
								<br>
								<?php echo $message ?>
								<select name="category_id" class="form-control py-2 mb-2" required>
									<option>Select category</option>
									<?php
									$opt=mysqli_query($con, "select id,Category from e_category order by Category asc");
									while($row=mysqli_fetch_assoc($opt))
									{
										if($row['id']==$category_id)
										{
										echo "<option selected value=".$row['id'].">".$row['Category']."</option>";
										}else{
										echo "<option value=".$row['id'].">".$row['Category']."</option>";
										}
									}
									?>
								 </select>

							  <input type="text" name="name" placeholder="Enter name" class="form-control py-2 mb-2" required value="<?php echo $name ?>">
							 <input type="file" name="image" class="btn btn-danger form-control py-2 mb-2">
							 <input type="text" name="price" placeholder="Enter price" class="form-control py-2 mb-2" required value="<?php echo $price ?>">

							  <input type="text" name="quantity" placeholder="Enter number of items" class="form-control py-2 mb-2" required value="<?php echo $quantity ?>">
							  <input type="text" name="description" placeholder="Enter description" class="form-control py-2 mb-2" required value="<?php echo $description ?>">
							<hr>
							<button class="btn btn-dark float-right" type="submit" name="submit">Submit</button>
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