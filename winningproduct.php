<?php
include("header.php");
$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id LEFT JOIN customer ON customer.customer_id=product.customer_id WHERE product.product_id='$_GET[productid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct= mysqli_fetch_array($qsqlproduct);

$sqlwinner = "SELECT  * FROM winners LEFT JOIN customer ON customer.customer_id=winners.customer_id WHERE product_id='$_GET[productid]'";
$qsqlwinner = mysqli_query($con,$sqlwinner);
$rswinner = mysqli_fetch_array($qsqlwinner);

$productimg = unserialize($rsproduct['product_image']);
if(empty($productimg[0])){
	$imgname = "images/noimage.gif";
} else if(file_exists("imgproduct/".$productimg[0])) {
	$imgname = "imgproduct/".$productimg[0];
} else {
	$imgname = "images/noimage.gif";
}
?>
<!-- banner -->
	<div class="banner">
		<?php
		
		include("sidebar.php");
		
		?>
		<div class="w3l_banner_nav_right">

			<div class="agileinfo_single">
								
				<h2>Winning bid details</h2>
			<hr>
			
				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo $imgname; ?>" alt=" " class="img-responsive" />
					
					<hr>
					<b>Bidders list:<b>
					<div style='overflow:auto; height:400px;font-family: "Times New Roman", Times, serif;font-size:15px;' >
					<?php
					
	$sqledit = "SELECT * FROM bidding LEFT JOIN customer ON bidding.customer_id = customer.customer_id WHERE product_id='$_GET[productid]' ORDER BY bidding_id DESC";
	$qsqledit = mysqli_query($con,$sqledit);
	while($rsedit= mysqli_fetch_array($qsqledit))
	{
		echo "$rsedit[customer_fname] $rsedit[customer_lname] bidded $currencysymbol$rsedit[bidding_amount] on $rsedit[bidding_date_time]<hr>";
	}
?>
					</div>
				</div>
				<div class="col-md-8 agileinfo_single_right">
					
					
					
				<h2><?php echo $rsproduct['product_name']; ?></h2>

						<div class="w3agile_description">								
						<h4>Product details :</h4>
						<p><b>Uploaded by :</b> <?php echo $rsproduct['customer_fname']; ?> <?php echo $rsproduct['customer_lname']; ?></p>
						<p><b>Product Code :</b> <?php echo $rsproduct['product_id']; ?></p>
						<p><b>Product warranty :</b> <?php echo $rsproduct['product_warranty']; ?></p>
						<p><b>Company :</b> <?php echo $rsproduct['company_name']; ?></p>
						<p><b>Actual product cost</b> <?php echo $currencysymbol; ?><?php echo $rsproduct['product_cost']; ?></p>
						</div>	
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<p><b>Name :</b> <?php echo $rsproduct['customer_fname']; ?> <?php echo $rsproduct['customer_lname']; ?></p>
							<p><b>Winning Bid Amount :</b> <?php echo $currencysymbol; ?><?php echo $rsproduct['ending_bid']; ?></p>
						</div>
						
				<div class="snipcart-thumb agileinfo_single_right_snipcart">
				
				<?php 
				//echo print_r($rsproduct);
				//echo date("M d, Y H:i:s",strtotime($rsproduct[8])); 
				?>
				</div>

<form action="" method="post"  onsubmit="return confirmbidding()">
<input type='hidden' name='ending_bid' id='ending_bid' value='<?php echo $rsproduct['ending_bid']; ?>'>

<div class="w3agile_description">
	<h4>Description :</h4>
	<p><?php echo $rsproduct['product_description']; ?></p>
</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
</form>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- brands -->
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">

<!-- //brands -->
<?php
include("footer.php");
?>
<script>
function confirmbidding()
{
		if(parseFloat(document.getElementById("ending_bid").value)  > parseFloat(document.getElementById("purchase_amount").value))
		{
			alert('Bidding amount must be greater than ' + document.getElementById("ending_bid").value);
			return false;
		}
		else
		{
			if(confirm("confrim to bid..!!") == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
}
</script>