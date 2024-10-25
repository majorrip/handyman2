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
<!-- banner -->
	<div class="banner">
<!-- about -->
		<div class="privacy about">
			<h3>View Product</h3>

			<div class="checkout-left">	

				<div class="col-md-12 ">
<table id="datatable"  class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;" >			
	<thead>
		<tr>
		    <th>Product Image</th>	
			<th style="width:175px;">Product name</th>
			<th>Current bid</th>
			<th>Scheduled on</th>			
			<th>Product cost</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$sql = "select * from product LEFT JOIN category ON product.category_id =category.category_id  WHERE product.customer_id='0' ORDER BY product_id DESC";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlbidding = "SELECT * from bidding WHERE bidding_id='$rs[bidding_id]'";
			$qsqlbidding = mysqli_query($con,$sqlbidding);
			if( mysqli_num_rows($qsqlbidding) >= 1)
			{
				$currentcost = $rs[6];
			}
			else
			{
				$currentcost = 0;
			}
			echo "<tr>
				<td><img src='imgproduct/$rs[product_image]' width='200px;' style='height:120px;' ></td>";
				if(isset($_SESSION['employeeid']))
				{
			echo "<td>$rs[customer_fname] $rs[customer_lname]</td>";
				}
			echo "
				<td>$rs[product_name]<br>
				(<b>Category:</b> $rs[category_name])<br>
				<b>Company:</b> $rs[company_name]
				</td>
				<td>";
				if($currentcost == 0)
				{
					echo "No bidding done yet..";
				}
				else
				{
					echo $currencysymbol.$currentcost;
				}
				echo "</td><td>". date("d/m/Y h:i A",strtotime($rs['start_date_time'])) . " -".  date("d/m/Y h:i A",strtotime($rs['end_date_time'])) . "</td>
				<td>$currencysymbol$rs[product_cost]</td>
				<td>$rs[14]</td>
				<td><a href='product.php?editid=$rs[product_id]'  class='btn btn-warning'>Edit</a> <br> ";
				
				//if(!isset($_SESSION['customer_id']))
				{
					if($_SESSION["employee_type"] == "Admin")
					{
					echo  "<a href='viewreverseproduct.php?delid=$rs[product_id]' onclick='return deleteconfirm()'  class='btn btn-danger'>Delete</a> <br>";
					}
				}
				echo "<a href='single.php?productid=$rs[product_id]' target='_blank' class='btn btn-info' >View</a> </td>
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