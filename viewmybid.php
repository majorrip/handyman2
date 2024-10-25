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
<!------ Include the above in your HEAD tag ---------->
<div class="container">

<br>
<h2 class="border" style="padding: 10px;">My bidding list</h2><hr>
		<?php
		$sqlpayment = "select * from payment WHERE customer_id='" . $_SESSION['customer_id'] . "' and status='Active'";	
		$qsqlpayment = mysqli_query($con,$sqlpayment);
		while($rspayment = mysqli_fetch_array($qsqlpayment))
		{
			$sqlproduct = "select * from product WHERE status='Active' AND product_id='$rspayment[product_id]' ";
			if($_GET['auctiontype'] == "LatestAuctions")
			{
				$sqlproduct = $sqlproduct  . " order by product_id DESC limit 0,3";
			}
			else
			{
				$sqlproduct = $sqlproduct  . " order by product_id DESC limit 0,3";
			}
			$qsqlproduct = mysqli_query($con,$sqlproduct);
			if(mysqli_num_rows($qsqlproduct) >= 1)
			{
		?>

<div class="row">

<?php
			while($rsproduct = mysqli_fetch_array($qsqlproduct))
			{
				$productimg = unserialize($rsproduct['product_image']);
				if(empty($productimg[0])){
					$imgname = "images/noimage.gif";
				} else if(file_exists("imgproduct/".$productimg[0])) {
					$imgname = "imgproduct/".$productimg[0];
				} else {
					$imgname = "images/noimage.gif";
				}
?>

<div class="col-md-12">
	<figure class="card card-product">
		<div class="img-wrap">
			<center>
				<a href="single.php?productid=<?php echo $rsproduct[0]; ?>"><img src="<?php echo $imgname; ?>" alt=" " class="img-responsive"style="height: 250px;" /></a>
			</center>
		</div>
		<figcaption class="info-wrap">
<h4 class="title"><a href="single.php?productid=<?php echo $rsproduct[0]; ?>"><?php echo $rsproduct['product_name']; ?></a></h4>
<!-- Timer code starts here -->
<p id="countdowntime<?php echo $rsproduct[0]; ?>"></p>
<script type="application/javascript">countdowntimer('<?php echo $rsproduct[0]; ?>', '<?php echo date("M d, Y H:i:s",strtotime($rsproduct['end_date_time'])); ?>');</script>
<!-- Timer code ends here -->
				<div class="rating-wrap">
<div class="label-rating"><span>Started on <?php echo date("d-M-Y h:i A",strtotime($rsproduct['start_date_time']));?></span><br></div>
				</div> <!-- rating-wrap.// -->
		</figcaption>
		<div class="bottom-wrap">	
				<div class="price-wrap h5">
					
				</div> <!-- price-wrap.// -->				<div class="price-wrap h5">

					<span class="price-new">
<?php
	$sqledit = "SELECT * FROM bidding LEFT JOIN customer ON bidding.customer_id = customer.customer_id WHERE product_id='$rspayment[product_id]' AND bidding.customer_id='" . $_SESSION['customer_id'] . "' ORDER BY bidding_id DESC";
	$qsqledit = mysqli_query($con,$sqledit);
	while($rsedit= mysqli_fetch_array($qsqledit))
	{
		echo date("d-M-Y",strtotime($rsedit['bidding_date_time'])) .": <br>$rsedit[customer_fname] $rsedit[customer_lname] bidded $currencysymbol$rsedit[bidding_amount]<hr>";
	}
?>	
					</span> 
					
					
				</div> <!-- price-wrap.// -->
		</div> <!-- bottom-wrap.// -->
	</figure>
</div> <!-- col // -->

<?php
			}
?>
</div> <!-- row.// -->
<hr>
		<?php
			}
		}
		?>	

</div> 
<!--container.//-->
<?php
include("footer.php");
?>