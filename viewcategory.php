<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM category WHERE category_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('category record deleted successfully...');</script>";
		echo "<script>window.localation='viewcategory.php';</script>";
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
                                <li class="breadcrumb-item active">View Category</li>
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
				<h3 class="shoping-checkboxt-title">View category</h3>
				<div class="row">

<div class="col-lg-12">
	<p class="single-form-row">

<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Icon</th>
			<th>Category Name</th>
			<th>Description</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM category";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>";
			if($rs['category_icon'] == "")
			{
				echo "<img src='img/No-Image-Available.png' style='width: 200px;height:175px;'>";
			}
			else if(file_exists("imgcategory/".$rs['category_icon']))
			{
				echo "<img src='imgcategory/$rs[category_icon]' style='width: 200px;height:175px;'>";
			}
			else
			{
				echo "<img src='img/No-Image-Available.png' style='width: 200px;height:175px;'>";
			}

			echo "</td>			
			<td>$rs[category_name]</td>
			<td>$rs[description]</td>
			<td>$rs[status]</td>
			<td>

				<a href='category.php?editid=$rs[0]' class='btn btn-info' >Edit</a>
			
			<a href='viewcategory.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()'>Delete</a>
			
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