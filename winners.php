<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//Update statement starts here
		$sql = "UPDATE winners SET product_id='$_POST[product_id]',customer_id='$_POST[customer_id]',winners_image='$_POST[winners_image]',winning_bid='$_POST[winning_bid]',end_date='$_POST[end_date]',status='$_POST[status]' WHERE  winner_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('winners record updated successfully..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
		//Update statement ends here		
	}
	else
	{
		$sql = "INSERT INTO winners(product_id,customer_id,winners_image,winning_bid,end_date,status)
		VALUES('$_POST[product_id]','$_POST[customer_id]','$_POST[winners_image]','$_POST[winning_bid]','$_POST[end_date]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('winners record inserted successfully..');</script>";
			echo "<script>window.location='winners.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit ="SELECT * FROM winners WHERE winner_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area bg-gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">winners</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            
            <!-- content-wraper start -->
            <div class="content-wraper mt-10">
                <div class="container-fluid">
					<!-- checkout-area start -->
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-12">
<div class="row">
	<div class="col-lg-12 offset-xl-2 col-xl-8 col-sm-12">
		<form action="" method="post">
			<div class="checkbox-form checkout-review-order">
				<h3 class="shoping-checkboxt-title">winners</h3>
				<div class="row">


		
<div class="col-lg-12">
	<p class="single-form-row">
		<label>Product</label>
		<select name="product_id" id="product_id" class="form-control" >
			<option value=''>Select Product</option>
		</select>
	</p>
</div>

<div class="col-lg-12">
	<p class="single-form-row">
		<label>Customer </label>
		<select name="customer_id" id="customer_id" class="form-control" >
			<option value=''>Select customer</option>
		</select>
	</p>
</div>

<div class="col-lg-12">
	<p class="single-form-row">
		<label>winners image</label>
		<input type="text" name="winners_image" id="winners_image" class="form-control" value="<?php echo $rsedit['winners_image']; ?>" >
	</p>
</div>

<div class="col-lg-12">
	<p class="single-form-row">
		<label>Winning Bid</label>
		<input type="text" name="winning_bid" id="winning_bid" class="form-control"  value="<?php echo $rsedit['winning_bid']; ?>">
	</p>
</div>	
			
<div class="col-lg-12">
	<p class="single-form-row">
		<label>End date</label>
		<input type="datetime-local" name="end_date" id="end_date" class="form-control"  value="<?php echo $rsedit['end_date']; ?>" >
	</p>
</div>
	
	
	
<div class="col-lg-12">
	<p class="single-form-row">
		<label>Status</label>
		<select name="status" id="status" class="form-control">
			<option value=''>Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsedit['status'])
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
	</p>
</div>	

<div class="col-lg-12">
	<p class="single-form-row">
		<center><input type="submit" name="submit" id="submit" class="form-control" style="width: 200px;"></center>
	</p>
</div>	
				</div>
			</div>
		</form>
	</div>
</div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-area end -->
                </div>
            </div>
            <!-- content-wraper end -->
            
            <!-- footer-area start -->
            <?php
			include("footer.php");
			?>