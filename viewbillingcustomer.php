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
			<h3>View Transaction Report</h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >			
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Paid date</th>
			<th>Deposit amount</th>
			<th>Payment type</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sql = "select * from billing LEFT JOIN customer ON billing.customer_id =customer.customer_id LEFT JOIN product ON billing.product_id=product.product_id WHERE billing.customer_id='" . $_SESSION['customer_id'] . "' ORDER BY billing.billing_id DESC ";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
				<td>$rs[0]</td>
				<td>$rs[purchase_date]</td>
				<td>$rs[purchase_amount]</td>
				<td>$rs[payment_type]</td>
				<td><a href='paymentreceipt.php?paymentid=$rs[billing_id]'>Print</a></td>
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