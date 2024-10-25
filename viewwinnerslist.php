<?php
include("header.php");
?>
<script>
function countdowntimer(id, time)
{
		// Set the date we're counting down to
		var countDownDate = new Date(time).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="demo"
		document.getElementById("countdowntime"+id).innerHTML = "<b  style='color: red;'>Time Remaining</b> <br><b>" + days + "Days " + hours + "hrs " + minutes + "min " + seconds + "sec</b>";
		
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdowntime"+id).innerHTML = "<center><b  style='color: red;'>EXPIRED</b></center>";
		}
	}, 1000);
	
}
</script>  
<!-- banner -->
	<div class="banner">

		<div class="w3l_banner_nav_right" style="float: right;width: 100%;">
			<div class="w3ls_w3l_banner_nav_right_grid">
			<br>
				<center><H2> &nbsp; &nbsp; Winners list</H2></center>				
		<?php
		$dttim = date("Y-m-d h:i:s");
	 $sqlproduct = "SELECT * FROM winners LEFT JOIN product ON winners.product_id = product.product_id LEFT JOIN customer ON winners.customer_id=customer.customer_id where winners.status='Active'  ORDER BY winners.winner_id DESC ";
	$qsqlproduct = mysqli_query($con,$sqlproduct);
		while($rsproduct = mysqli_fetch_array($qsqlproduct))
		{
				if (file_exists("imgproduct/".$rsproduct["product_image"])) 
				{
					 $imgname = "imgproduct/".$rsproduct["product_image"];
				} 
				else 
				{
					$imgname = "images/noimage.gif";
				}
				
				if (file_exists("imgwinner/".$rsproduct[winners_image])) 
				{
					 $imgwinner = "imgwinner/".$rsproduct[winners_image];
				} 
				else 
				{
					$imgwinner = "images/noimage.gif";
				}
		?>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					 <div class="col-md-12 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid1"> 
 
					 <div class="col-md-4 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb"	>

											<p><center><b>Product Name:</b> <?php echo $rsproduct['product_name']; ?>
											<br>
											<b>Product Code :</b> <?php echo $rsproduct['product_id']; ?></center></p>
											
											<a href="single.php?productid=<?php echo $rsproduct[0]; ?>"><img src="<?php echo $imgname; ?>" alt=" " class="img-responsive"style="height: 250px;" /></a>

										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					
					
					 <div class="col-md-4 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb"	>

											<p><b>Customer</b> : <?php echo $rsproduct['customer_fname']; ?> <?php echo $rsproduct['customer_lname']; ?>
											<br>
											<b>Location :</b> <?php echo $rsproduct['city']; ?></p>
											
											<img src="<?php echo $imgwinner; ?>" alt=" " class="img-responsive"style="height: 250px;" />
											
											

										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					
					 <div class="col-md-4 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb"	>
										

<p><b>Product Name:</b> <?php echo $rsproduct['product_name']; ?>
<br>
<b>Product Code :</b> <?php echo $rsproduct['product_id']; ?>
</p>
<p><b>Customer : </b><?php echo $rsproduct['customer_fname']; ?> <?php echo $rsproduct['customer_lname']; ?>
<br>
<b>Location :</b> <?php echo $rsproduct['city']; ?></p>
<hr>
<b>Winning Date  :</b> <?php echo date("d - M - Y",strtotime($rsproduct[end_date])); ?></p>
<b>Winning Bid  :</b> <?php echo $rsproduct['winning_bid']; ?></p>
<br><br><br>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>

					<div class="clearfix"> </div>
				</div>
				
										</div>
									</div>
								</div>
					</div>
</div>				
		<?php
		}
		?>	
			</div>
		</div>
		
		
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<?php
include("footer.php");
?>