<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM product WHERE product_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('product record deleted successfully...');</script>";
	}
}
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
<!-- about -->
		<div class="privacy about">
			<h3>Current Bidding</h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >			
	<thead>
		<tr>
		    <th>Product Image</th>
			<th>Winners List</th>
			<th>Product name</th>
		    <th>Seller</th>
			<th>Starting bid</th>
			<th>Current bid</th>
			<th>Scheduled on</th>
		</tr>
		</thead>
		<tbody>
		<?php
$sql = "SELECT * FROM product 
        LEFT JOIN customer ON product.customer_id = customer.customer_id 
        LEFT JOIN category ON product.category_id = category.category_id 
        WHERE product_id != '' ";

if (isset($_SESSION['customer_id'])) {
    $sql .= " AND product.customer_id='" . $_SESSION['customer_id'] . "'";
}

$sql .= " AND product.status='Active' AND end_date_time > '$dt $tim'";
$sql .= " ORDER BY product.product_id DESC";

$qsql = mysqli_query($con, $sql);

while ($rs = mysqli_fetch_array($qsql)) {
    $sqlbidding = "SELECT MAX(bidding_amount), customer_id FROM bidding WHERE bidding.product_id='$rs[0]'";
    $qsqlbidding = mysqli_query($con, $sqlbidding);
    $rsbidding = mysqli_fetch_array($qsqlbidding);

    $sqlcustomer = "SELECT * FROM customer WHERE customer_id='$rsbidding[1]'";
    $qsqlcustomer = mysqli_query($con, $sqlcustomer);
    $rscustomer = mysqli_fetch_array($qsqlcustomer);

    echo "<tr>
        <td><img src='imgproduct/$rs[product_image]' width='200px;'></td>
        <td>$rscustomer[customer_fname] $rscustomer[customer_lname]<br>
        <b>(won for ৳$rsbidding[0])</b></td>
        <td>$rs[product_name]<br><font color='red'>[Product category-$rs[category_name]]</font></td>
        <td>$rs[customer_fname] $rs[customer_lname]</td>
        <td>৳$rs[starting_bid]</td>
        <td>৳$rs[ending_bid]</td>
        <td>". date('d/m/Y h:i A', strtotime($rs['start_date_time'])) . " -<br>" . date('d/m/Y h:i A', strtotime($rs['end_date_time'])) . "</td>
    </tr>";
?>
<!-- Timer code starts here -->
<p id="countdowntime<?php echo $rs[0]; ?>"></p>
<script type="application/javascript">
    countdowntimer('<?php echo $rs[0]; ?>', '<?php echo date("M d, Y H:i:s", strtotime($rs['end_date_time'])); ?>');
</script>
<!-- Timer code ends here -->
<?php
}
?>

	</tbody>
</table>
				</div>
			
				<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about -->
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<script>
function deleteconfirm()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return  true;
	}
	else
	{
		return false;
	}
}
</script>

<?php
include("datatable.php");
include("footer.php");
?>