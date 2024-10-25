<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM billing WHERE billing_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('billing record deleted successfully...');</script>";
		echo "<script>window.localation='viewbilling.php';</script>";
	}
}
?>
            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area bg-gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">View Billing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            
            <!-- content-wraper start -->
            <div class="content-wraper mt-10">
                <div class="container-fluid">
					<!-- checkout-area start -->
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-12">
<div class="row">
	<div class="col-lg-12 col-xl-12 col-sm-12">
		<form action="" method="post">
			<div class="checkbox-form checkout-review-order">
				<h3 class="shoping-checkboxt-title">View Billing</h3>
				<div class="row">

<div class="col-lg-12">
	<p class="single-form-row">

<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Customer</th>
			<th>Product</th>
			<th>purchase Date</th>
			<th>purchase amount</th>
			<th>payment type</th>
			<th>card type</th>
			<th>card number</th>
			<th>expiry date</th>
			<th>cvv number<th>
			<th>card holder</th>
			<th>delivery date</th>
			<th>Note</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM billing";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			
			
			<td>$rs[customer_id]</td>
			<td>$rs[product_id]</td>
			<td>$rs[purchase_date]</td>
			<td>$rs[purchase_amount]</td>
			<td>$rs[payment_type]</td>
			<td>$rs[card_type]</td>
			<td>$rs[card_number]</td>
			<td>$rs[expire_date]</td>
			<td>$rs[cvv_number]</td>
			<td>$rs[card_holder]</td>
			<td>$rs[delivery_date]</td>
			<td>$rs[note]</td>
			<td>$rs[status]</td>
			<td>
			
			<a href='billing.php?editid=$rs[0]' class='btn btn-info' >Edit</a>
			
				<a href='viewbilling.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()'>Delete</a>
		
			
			</td>
			
			</tr>";
	}
	?>
	</tbody>
</table>

	</p>
</div>

				</div>
			</div>
		</form>
	</div>
</div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-area end -->
                </div>
            </div>
            <!-- content-wraper end -->
            
            <!-- footer-area start -->
            <?php
			include("footer.php");
			?>
<script>
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else 
	{
		return false;
	}
}
</script>