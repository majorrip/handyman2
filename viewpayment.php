<?php
include("header.php");
?>
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Payment Report</h3>

			<div class="checkout-left">	

				<div class="col-md-12">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >									
	<thead>
		<tr>
		    <th>Customer</th>
			<th>Payment date</th>
			<th>Product</th>
			<th>Bidding</th>
			<th>Payment type</th>
			<th>paid amount</th>
		</tr>
		</thead>
		<tbody>
		<?php
$sql = "select * from payment 
        LEFT JOIN customer ON payment.customer_id =customer.customer_id 
        LEFT JOIN product ON payment.product_id=product.product_id 
        LEFT JOIN bidding ON payment.bidding_id=bidding.bidding_id";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
    echo "<tr>
        <td>$rs[customer_fname] $rs[customer_lname]</td>
        <td>" . date("d-M-Y", strtotime($rs['paid_date'])) . "</td>
        <td>$rs[product_name]</td>
        <td>৳$rs[bidding_amount]</td> <!-- Changed to Taka sign -->
        <td>$rs[payment_type]</td>
        <td>৳$rs[paid_amount]</td> <!-- Changed to Taka sign -->
    </tr>";
}
?>
	</tbody>
</table>
				</div>
			
				<div class="clearfix"> </div>
				
			</div>

		</div>
<!-- //about -->
		</div>
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