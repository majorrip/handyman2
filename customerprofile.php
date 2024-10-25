<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE customer SET customer_fname='" . $_POST['customer_fname'] . "',customer_lname='" . $_POST['customer_lname'] . "',email_id='" . $_POST['email_id'] . "',address='" . $_POST['address'] . "',state='" . $_POST['state'] . "',city='" . $_POST['city'] . "',landmark='" . $_POST['landmark'] . "',pincode='" . $_POST['pincode'] . "',mobile_no='" . $_POST['mobile_no'] . "', customer_role='" . $_POST['customer_role'] . "' WHERE  customer_id='". $_SESSION['customer_id'] ."'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Profile updated successfully...');</script>";
	}
}
if(isset($_SESSION['customer_id']))
{
	$sqledit = "SELECT * FROM customer WHERE customer_id='" .  $_SESSION['customer_id'] . "'";
	$qsqledit= mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
           <div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="customer-login-register">
							
							
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Customer <span>Profile</span></h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
				<form action="" method="post" class="creditly-card-form agileinfo_form" onsubmit="return validatecustomer()">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
											<div class="first-row form-group">
<div class="controls">
<label class="control-label">First Name</label><span class="errormsg" id="errcustomer_fname"></span>
<input class="billing-address-name form-control" type="text" name="customer_fname" id="customer_fname" placeholder="First name" value="<?php echo $rsedit['customer_fname']; ?>">
</div>

<div class="controls">
<label class="control-label">Last Name</label><span class="errormsg" id="errcustomer_lname"></span>
<input class="billing-address-name form-control" type="text" name="customer_lname" id="customer_lname" placeholder="Last name" value="<?php echo $rsedit['customer_lname']; ?>">
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Customer Role</label><span  class="errormsg" id="errcustomer_role"></span>
<select  name="customer_role" id="customer_role" class="form-control">
<option value="">------------Select Role------------</option>
<option value="Customer" <?php if($rsedit['customer_role'] == 'Customer') echo 'selected'; ?>>Customer</option>
<option value="Service Man" <?php if($rsedit['customer_role'] == 'Service Man') echo 'selected'; ?>>Service Man</option>
</select>
	</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Email ID</label><span class="errormsg"  id="erremail_id"></span>
		<input name="email_id" id="email_id" class="form-control" type="text" placeholder="Email ID" value="<?php echo $rsedit['email_id']; ?>">
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Address</label><span class="errormsg"  id="erraddress"></span>
		<textarea name="address" id="address" class="form-control" placeholder="Enter Address"><?php echo $rsedit['address']; ?></textarea>
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">State</label><span  class="errormsg" id="errstate"></span>
<select  name="state" id="state" class="form-control">
<option value="">------------Select Division------------</option>
<option value="Barisal" <?php if($rsedit['state'] == 'Barisal') echo 'selected'; ?>>Barisal</option>
<option value="Chittagong" <?php if($rsedit['state'] == 'Chittagong') echo 'selected'; ?>>Chittagong</option>
<option value="Dhaka" <?php if($rsedit['state'] == 'Dhaka') echo 'selected'; ?>>Dhaka</option>
<option value="Khulna" <?php if($rsedit['state'] == 'Khulna') echo 'selected'; ?>>Khulna</option>
<option value="Mymensingh" <?php if($rsedit['state'] == 'Mymensingh') echo 'selected'; ?>>Mymensingh</option>
<option value="Rajshahi" <?php if($rsedit['state'] == 'Rajshahi') echo 'selected'; ?>>Rajshahi</option>
<option value="Rangpur" <?php if($rsedit['state'] == 'Rangpur') echo 'selected'; ?>>Rangpur</option>
<option value="Sylhet" <?php if($rsedit['state'] == 'Sylhet') echo 'selected'; ?>>Sylhet</option>
</select>
	</div>
</div>
<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">City</label><span  class="errormsg" id="errcity"></span>
		<input name="city" id="city" class="form-control" placeholder="City" value="<?php echo $rsedit['city']; ?>">
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Landmark</label><span class="errormsg"  id="errlandmark"></span>
		<input name="landmark" id="landmark" class="form-control" placeholder="Landmark" value="<?php echo $rsedit['landmark']; ?>">
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">PIN code</label><span class="errormsg"  id="errpincode"></span>
		<input name="pincode" id="pincode" class="form-control" placeholder="Pincode" value="<?php echo $rsedit['pincode']; ?>">
	</div>
</div>

<div class="w3_agileits_card_number_grid_left">
	<div class="controls">
		<label class="control-label">Mobile number</label><span class="errormsg"  id="errmobile_no"></span>
		<input name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile number" value="<?php echo $rsedit['mobile_no']; ?>">
	</div>
</div>

</div>
<button class="btn btn-info" type="submit" name="submit">Update Profile</button>
</div>
									</section>
								</form>
									
					</div>
			
				<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
                            </div>
                        </div>
						<div class="col-lg-3 col-md-3 col-sm-3"></div>
					</div>
                </div>
            </div>

<?php
include("footer.php");
?>
<script>
function validatecustomer()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('.errormsg').html('');
	var errchk = "False";
	
	if(document.getElementById("customer_fname").value.length > 15)
	{
		document.getElementById("errcustomer_fname").innerHTML="Customer First name not contain less than 15 characters...";
		errchk = "True";
	}
	if(!document.getElementById("customer_fname").value.match(alphaSpaceExp))
	{
		document.getElementById("errcustomer_fname").innerHTML = "Kindly enter valid Customer First name..";
		errchk = "True";
	}
	if(document.getElementById("customer_fname").value == "")
	{
		document.getElementById("errcustomer_fname").innerHTML = "Customer First name should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("customer_lname").value.length > 15)
	{
		document.getElementById("errcustomer_lname").innerHTML="Customer Last name not contain less than 15 characters...";
		errchk = "True";
	}
	if(!document.getElementById("customer_lname").value.match(alphaSpaceExp))
	{
		document.getElementById("errcustomer_lname").innerHTML = "Kindly enter valid Customer Last name..";
		errchk = "True";
	}
	if(document.getElementById("customer_lname").value == "")
	{
		document.getElementById("errcustomer_lname").innerHTML = "Customer Last name should not be empty...";
		errchk = "True";
	}
	if(!document.getElementById("email_id").value.match(emailExp))
	{
		document.getElementById("erremail_id").innerHTML="Kindly enter Valid Email ID...";
		errchk = "True";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Email ID should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML="Address should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("state").value == "")
	{
		document.getElementById("errstate").innerHTML="Kindly select the State...";
		errchk = "True";
	}
	if(document.getElementById("city").value == "")
	{
		document.getElementById("errcity").innerHTML="City should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("landmark").value == "")
	{
		document.getElementById("errlandmark").innerHTML="Landmark should not be empty...";
		errchk = "True";
	}
	if(!document.getElementById("pincode").value.match(numericExp))
	{
		document.getElementById("errpincode").innerHTML="Kindly enter valid PIN code..";
		errchk = "True";
	}
	if(document.getElementById("pincode").value == "")
	{
		document.getElementById("errpincode").innerHTML="PIN Code should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("mobile_no").value.length > 15)
	{
		document.getElementById("errmobile_no").innerHTML="Mobile number not contain less than 15 characters...";
		errchk = "True";
	}
	if(document.getElementById("mobile_no").value == "")
	{
		document.getElementById("errmobile_no").innerHTML="Mobile number should not be empty...";
		errchk = "True";
	}
	if(!document.getElementById("mobile_no").value.match(numericExp))
	{
		document.getElementById("errmobile_no").innerHTML="Kindly enter valid mobile number..";
		errchk = "True";
	}

    if(document.getElementById("customer_role").value == "")
    {
        document.getElementById("errcustomer_role").innerHTML="Please select a customer role.";
        errchk = "True";
    }

	if(errchk == "True")
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>
