<?php require_once('includes/header.php')?>
<?php require_once('includes/logged_nav.php');
	$Category='';

if(isset($_GET['id']) && $_GET['id']!='')
{
	$id=get_safe_value($con, $_GET['id']);
	$qry="select * from e_category where id='$id'";
	$result=mysqli_query($con, $qry);
	$row=mysqli_fetch_assoc($result);
	$Category=$row['Category'];
}	
	
if(isset($_POST['submit']))
{
	$category=get_safe_value($con, $_POST['categories']);
	if(isset($_GET['id']) && $_GET['id']!='')
	{
		$sql="update e_category set Category='$category' where id='$id'";
	    mysqli_query($con, $sql);
		header('location:display.php');
	}else
	{
	$sql="insert into e_category(Category, Status) values ('$category','1')";
	mysqli_query($con, $sql);
	header('location:display.php');
	die();
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
							 <label for="categories" class="form-control-label"><strong>Add Categories</strong></label>
							  <input type="text" name="categories" placeholder="Enter category" class="form-control py-2 mb-2" required value="<?php echo $Category ?>">
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