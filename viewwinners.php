<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM winners WHERE winner_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('winner record deleted successfully...');</script>";
	}
}
?>
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>View Winner</h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >		
	<thead>
		<tr>
		    <th>Customer</th>
			<th style="300px;">Product</th>
			<th>Winners image</th>
			<th>Winning bid</th>
			<th>End date</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sql = "select * from winners LEFT JOIN customer ON winners.customer_id =customer.customer_id LEFT JOIN product ON winners.product_id=product.product_id";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
			    <td>$rs[customer_fname] $rs[customer_lname]</td>
				<td>$rs[product_name]</td>
			<td><img src='imgwinner/$rs[winners_image]' width='200px;' ></td>
				<td>৳$rs[winning_bid]</td>
				<td>$rs[end_date]</td></tr>";
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