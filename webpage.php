<?php
include("header.php");
$pagelink ="about-us.php";
if(isset($_POST['submit']))
{
	if($_FILES['webpage_image']['name'] != "")
	{
		$webpage_image = time() . $_FILES['webpage_image']['name'];
		move_uploaded_file($_FILES['webpage_image']['tmp_name'],"img/".$webpage_image);
	}
	$sql = "UPDATE webpage SET webpage_title='$_POST[webpage_title]',webpage_description='$_POST[webpage_description]'";
	if($_FILES['webpage_image']['name'] != "")
	{
	$sql = $sql . ",webpage_image='img/$webpage_image'";
	}
	$sql = $sql . " WHERE webpage_link='$pagelink'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>window.location='webpage.php';</script>";
	}
}
$sqlselectwebpage = "SELECT * FROM webpage WHERE webpage_link='$pagelink'";
$qsqlselectwebpage = mysqli_query($con,$sqlselectwebpage);
$rsselectwebpage = mysqli_fetch_array($qsqlselectwebpage);
$pagename="About Us";
?>           <div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2"></div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="customer-login-register">
<!-- banner -->
	<div class="banner">
		
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<center><h3><?php echo $pagename; ?> Web Page</h3></center><hr>

			<div class="checkout-left">	

				<div class="col-md-12 ">
				<form action="" method="post" onsubmit="return validateform()" class="creditly-card-form agileinfo_form" enctype="multipart/form-data">
									<section class="creditly-wrapper wthree, w3_agileits_wrapper">
										<div class="information-wrapper">
	<div class="first-row form-group">

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label"><?php echo $pagename; ?> Page Title</label>
				<span id='idweb_title' style="color:red;"></span>
				<input name="webpage_title" id="webpage_title" class="form-control" type="text" placeholder="Enter Website Title" value="<?php echo $rsselectwebpage['webpage_title']; ?>" >
			</div>
			<br>
		</div>	

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label"><?php echo $pagename; ?> Website Tag Line</label>
				<span id='idweb_tagline' style="color:red;"></span>
				<textarea placeholder="Website Tag Line"  name="webpage_description" id="webpage_description" class="form-control" ><?php echo $rsselectwebpage['webpage_description']; ?></textarea>
			</div>
			<br>
		</div>	

		<div class="w3_agileits_card_number_grid_left">
			<div class="controls">
				<label class="control-label">Image (This will appear left side of about us page)</label>
				<span id='idcpass' style="color:red;"></span>
				<input name="webpage_image" id="webpage_image" class="form-control" type="file" placeholder="Image" >
				<img src="<?php echo $rsselectwebpage['webpage_image']; ?>" style="max-width: 300px;max-height: 300px;">
			</div>
			<br>
		</div>	
		
	</div>
	<hr>
<centeR><button class="btn btn-info" type="submit" name="submit">Update Webpage</button></center>
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
						<div class="col-lg-2 col-md-2 col-sm-2"></div>
					</div>
                </div>
            </div>
<?php
include("footer.php");
?>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script> 
<script>
		CKEDITOR.replace( 'webpage_description' );
</script>