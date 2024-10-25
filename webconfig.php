<?php
include("header.php");
if(isset($_POST['submit']))
{
	if($_FILES['web_logo']['name'] != "")
	{
		$web_logo = time() . $_FILES['web_logo']['name'];
		move_uploaded_file($_FILES['web_logo']['tmp_name'],"img/".$web_logo);
	}
	if($_FILES['favicon_logo']['name'] != "")
	{
		$favicon_logo = time() . $_FILES['favicon_logo']['name'];
		move_uploaded_file($_FILES['favicon_logo']['tmp_name'],"img/".$favicon_logo);
	}
	$sql = "UPDATE webconfig SET web_title='$_POST[web_title]',web_tagline='$_POST[web_tagline]'";
	if($_FILES['web_logo']['name'] != "")
	{
	$sql = $sql . ",web_logo='img/$web_logo'";
	}
	if($_FILES['favicon_logo']['name'] != "")
	{
	$sql = $sql . ",favicon_logo='img/$favicon_logo'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>window.location='webconfig.php';</script>";
	}
}
$sqlselectwebconfig = "SELECT * FROM webconfig";
$qsqlselectwebconfig = mysqli_query($con,$sqlselectwebconfig);
$rsselect = mysqli_fetch_array($qsqlselectwebconfig);
?>           <div class="content-wraper mt-50">
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
			<center><h3>Web Configuration</h3></center><hr>

			<div class="checkout-left">	

				<div class="col-md-12 ">
				<form action="" method="post" onsubmit="return validateform()" class="creditly-card-form agileinfo_form" enctype="multipart/form-data">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
	<div class="first-row form-group">

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label">Website Title</label>
				<span id='idweb_title' style="color:red;"></span>
				<input name="web_title" id="web_title" class="form-control" type="text" placeholder="Enter Website Title" value="<?php echo $rsselect['web_title']; ?>" >
			</div>
			<br>
		</div>	

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label">Website Tag Line</label>
				<span id='idweb_tagline' style="color:red;"></span>
				<input name="web_tagline" id="web_tagline" class="form-control" type="text" placeholder="Enter Website Tag Line"  value="<?php echo $rsselect['web_tagline']; ?>" >
			</div>
			<br>
		</div>	

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label">Logo (Standard width: 200px and standard height 40)</label>
				<span id='idcpass' style="color:red;"></span>
				<input name="web_logo" id="web_logo" class="form-control" type="file" placeholder="Logo" >
				<img src="<?php echo $rsselect['web_logo']; ?>" style="max-width: 200px;max-height: 60px;">
			</div>
			<br>
		</div>	
		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label">Favicon Logo</label>
				<span id='idcpass' style="color:red;"></span>
				<input name="favicon_logo" id="favicon_logo" class="form-control" type="file" placeholder="Favicon Logo" >
				<img src="<?php echo $rsselect['favicon_logo']; ?>" style="width: 50px;height: 50px;">
			</div>
		</div>					
	</div>
	<hr>
<centeR><button class="btn btn-info" type="submit" name="submit">Update Settings</button></center>
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
					</div>
                </div>
            </div>
<?php
include("footer.php");
?>
<script>
function validateform()
{
	/* #######start 1######### */
	
	
	var alphanumericExp = /^[a-zA-Z0-9]+$/;//Variable to validate only alphanumerics
	
			      
	$("span").html("");
	var i=0;
	/* ########end 1######## */
	
	if(!document.getElementById("opass").value.match(alphanumericExp))
	{
		document.getElementById("idopass").innerHTML ="Old password should contain only alphabets and numbers....";	
		i=1;		
	}
	if(document.getElementById("opass").value == "")
	{
		document.getElementById("idopass").innerHTML ="Old password should not be empty....";	
		i=1;		
	}
	if(!document.getElementById("npass").value.match(alphanumericExp))
	{
		document.getElementById("idnpass").innerHTML ="New password should contain only alphabets and numbers....";		
		i=1;		
	}
	if(document.getElementById("npass").value == "")
	{
		document.getElementById("idnpass").innerHTML ="New password should not be empty....";	
		i=1;		
	}	
	if(document.getElementById("cpass").value != document.getElementById("npass").value )
	{
		document.getElementById("idcpass").innerHTML ="Confirm password Must match with new password..";	
		i=1;		
	}
	if(document.getElementById("cpass").value == "")
	{
		document.getElementById("idcpass").innerHTML ="Confirm Password should not be empty....";	
		i=1;		
	}
	
	
	/* #######start 2######### */
	if(i==0)
	{
		return true;
	}
	else
	{
	return false;
	}
	/* #######end 2######### */
}
</script>