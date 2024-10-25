<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM message WHERE message_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('message record deleted successfully...');</script>";
		echo "<script>window.localation='viewmessage.php';</script>";
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
                                <li class="breadcrumb-item active">View Message</li>
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
				<h3 class="shoping-checkboxt-title">View Message</h3>
				<div class="row">

<div class="col-lg-12">
	<p class="single-form-row">

<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Sender</th>
			<th>Receiver</th>
			<th>Message Date </th>
			<th style="width: 110px;">Product</th>
			<th>Message</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM message";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlsender = "SELECT * FROM customer WHERE customer_id='$rs[sender_id]'";
		$qsqlsender = mysqli_query($con,$sqlsender);
		$rssender = mysqli_fetch_array($qsqlsender);
		$sqlreceiver  = "SELECT * FROM customer WHERE customer_id='$rs[receiver_id]'";
		$qsqlreceiver  = mysqli_query($con,$sqlreceiver);
		$rsreceiver = mysqli_fetch_array($qsqlreceiver);
		$sqlproduct  = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
		$qsqlproduct  = mysqli_query($con,$sqlproduct);
		$rsproduct = mysqli_fetch_array($qsqlproduct);
		echo "<tr>
			<td>$rssender[customer_fname] $rssender[customer_lname]</td>
			<td>$rsreceiver[customer_fname] $rsreceiver[customer_lname]</td>
			<td>". date("d-M-Y",strtotime($rs['message_date_time'])) ."<br>". date("h:i A",strtotime($rs['message_date_time'])) ."</td>
			<td>$rsproduct[product_name]</td>
			<td>$rs[message]</td>
			
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