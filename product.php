<?php
include("header.php");
if(!isset($_SESSION['customer_id']) && !isset($_SESSION['employee_id']) )
{
	echo "<SCRIPT>window.location='login.php';</SCRIPT>";
}
if(isset($_POST['submit']))
{
	$productdescription = mysqli_real_escape_string($con,$_POST['product_description']); 
	for($i=0;$i<count($_FILES['product_image']['name']);$i++)
	{
		$imgname[$i] = rand() . $_FILES['product_image']['name'][$i];
		move_uploaded_file($_FILES['product_image']['tmp_name'][$i],"imgproduct/".$imgname[$i]);
	}
	$arrimg = serialize($imgname);
	if(isset($_GET['editid']))
	{
		$sql = "UPDATE product SET product_name='$_POST[product_name]',product_description='$productdescription',starting_bid='$_POST[starting_bid]',ending_bid='$_POST[ending_bid]',product_cost='$_POST[product_cost]',";
		if($_FILES['product_image']['name'] != "")
		{
		$sql = $sql . "product_image='$arrimg',";
		}
		$sql = $sql . "product_warranty='$_POST[product_warranty]',product_delivery='$_POST[product_delivery]',company_name='$_POST[company_name]',status='$_POST[status]' where product_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Product record updated successfully..');</script>";
		}
	} 
	else
	{ 
		$sql = "INSERT INTO  product (customer_id,category_id,product_name,product_description,starting_bid,ending_bid,start_date_time,end_date_time,product_cost,product_image,product_warranty,product_delivery,company_name,status) VALUES('$_SESSION[customer_id]','$_POST[category_id]','$_POST[product_name]','$productdescription','$_POST[starting_bid]','$_POST[starting_bid]','$_POST[start_date] $_POST[start_time]','$_POST[end_date] $_POST[end_time]','$_POST[product_cost]','$arrimg','$_POST[product_warranty]','$_POST[product_delivery]','$_POST[company_name]','Pending')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Product record inserted successfully..');</script>";
			$insid = mysqli_insert_id($con);
			echo "<script>window.location='billing.php?productid=$insid';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM product WHERE product_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit= mysqli_fetch_array($qsqledit);
	$arrimg = unserialize($rsedit['product_image']);
}
?>

            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area bg-gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            
            <!-- content-wraper start -->
            <div class="content-wraper">
                <div class="container-fluid  p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <div class="contact-form-inner">
                                <h2>Service Entry</h2>
<form action="" method="post" onsubmit="return validateform()" class="creditly-card-form agileinfo_form" enctype="multipart/form-data">
	<input type='hidden' name='category_id'	value='<?php echo $_GET['categoryid']; ?>'>
	<div class="row">
		<div class="col-md-6 col-lg-6">
<?php
$sqlcategory = "select * from category WHERE status='Active' AND category_id='$_GET[categoryid]'";
$qsqlcategory = mysqli_query($con,$sqlcategory);
while($rscategory = mysqli_fetch_array($qsqlcategory))
{
?>
<div class="controls">
	<label class="control-label">Category</label>
	<span id='idcategory_name' style="color:red;"></span>
	<input class="billing-address-name form-control" type="text" name="category_name" id="category_name" value="<?php echo $rscategory['category_name']; ?>" readonly style="background-color:grey; color:white;" >
</div>
<?php
}
?>
		</div>
		
		<div class="col-md-6 col-lg-6">
			<label class="control-label">Service Name</label>
			<span id='idproduct_name' style="color:red;"></span>
			<input class="form-control" type="text" name="product_name" id="product_name" placeholder="Product name" value="<?php echo $rsedit['product_name']; ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<label class="control-label">Service description</label>
			<span id='idproduct_description' style="color:red;"></span>
			<textarea name="product_description" id="product_description" type="text" placeholder="Product description" class="form-control" style="height: 250px;"><?php echo $rsedit['product_description']; ?></textarea>
		</div>
	</div>
	
	<div class="row ">&nbsp;<br>
		<div class="col-md-12 col-lg-12 table table-bordered">
		<div class="row ">
			<div class="col-md-3 col-lg-3">
				<div class="table table-bordered">
				<label class="control-label"> &nbsp; <b>Upload image</b> </label>
				<span id='idproduct_name' style="color:red;"></span>
				<span id='idproduct_image' style="color:red;"></span>
				<input name="product_image[]" id="product_image" class="form-control" type="file" placeholder="product images" accept="image/*"      onchange="document.getElementById('img0').src = window.URL.createObjectURL(this.files[0])">
				<?php
				if(isset($_GET['editid']))
				{
					foreach($arrimg as $imgnm)
					{
				?>
				<center><img src='imgproduct/<?php echo $imgnm; ?>' style="width:100%;"></center>
				<?php
					}
				}
				else
				{
				?>
				<center><img src='images/upload.png' style="width:125px;height: 100px;" id="img0"></center>
				<?php
				}
				?>
				</div>
			</div>
			
			
		<hr id="divafterimg">
		</div>
			<center><button id="imgmore" name="imgmore" class="btn btn-primary" onclick="addmoreimage()">Add More image</button></center>
		<br>&nbsp;
		</div>
	</div>
<script>
function addmoreimage()
{
	//divafterimg
	var x = 'a' + Math.floor((Math.random() * 1000000000) + 1);
	$('<div class="col-md-3 col-lg-3" id="' + x + '" ><div class="table table-bordered"><label class="control-label" style="width: 100%;"> &nbsp; <b>Upload image</b> <span style="float: right;cursor: pointer;" class="btn-danger" onclick="removediv(`' + x + '`)">&nbsp;X&nbsp;</span></label><input name="product_image[]" id="product_image" class="form-control" type="file" placeholder="product images" accept="image/*" required multiple    onchange="document.getElementById(`b' + x + '`).src = window.URL.createObjectURL(this.files[0])"><center><img src="images/upload.png" id="b' + x + '" style="width:125px;height: 100px;"></center></div></div>').insertBefore("#divafterimg");
}
function removediv(x)
{
	$('#'+x).remove();
}
</script>
	<div class="row">
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Starting bid</label>
			<span id='idstarting_bid' style="color:red;"></span>
			<input name="starting_bid" class="form-control" id="starting_bid" type="text" placeholder="Starting bid"  value="<?php echo $rsedit['starting_bid']; ?>">
		</div>
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Max Cost</label>
			<span id='idproduct_cost' style="color:red;"></span>
			<input class="form-control" name="product_cost" id="product_cost" type="text" placeholder="Max cost of the service" value="<?php echo $rsedit['product_cost']; ?>">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Start date</label>
			<?php
			if(isset($_GET['editid']))
			{
			?>
				<input name="start_date_time" class="form-control"  type="date" placeholder="start date and time" min="<?php echo date("Y-m-d"); ?>" value="<?php
				if(isset($_GET['editid']))
				{
					echo date("Y-m-d",strtotime($rsedit['start_date_time'])); 
				}
				else
				{
					echo date("Y-m-d");
				}
				?>"  <?php
					if(isset($_GET['editid']))
					{
						echo " readonly  style='background-color:#fcf8e3;' ";
					}
					?> >
			<?php
			}
			else
			{
			?>
				<input name="start_date" class="form-control"  type="date" placeholder="start date and time"  min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" onchange="changedate(this.value)"  onkeyup="changedate(this.value)" >
			<?php
			}
			?>
		</div>
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Start time</label>
<?php
if(isset($_GET['editid']))
{
?>
	<input class="form-control" name="start_time" type="time" placeholder="Start time"  value="<?php echo date("H:i",strtotime($rsedit['start_date_time'])); ?>" readonly style="background-color:#fcf8e3;" >
	
<?php
}
else
{
?>
	<input class="form-control" name="start_time"  type="time" placeholder="Start time"  value="<?php
		echo date("H:i");
	?>" >
	
<?php
}
?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">End date</label>
			<div id="idchangetodate"><?php include("ajaxenddate.php"); ?></div>
		</div>
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">End time</label>
			<div id="idend_time">
				<input class="form-control"  style="background-color:#fcf8e3;" name="end_time"  type="time" placeholder="End time"  value="<?php 
				if(isset($_GET['editid']))
				{
				echo date("H:i:s",strtotime($rsedit['end_date_time']));
				}
				else
				{
					echo date("H:i");
				}
				?>"  >
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Service delivery</label>
			<span id='idproduct_delivery' style="color:red;"></span>
			<select name="product_delivery" id="product_delivery" class="form-control" >
				<option value=''>Select Time Frame</option>
				<?php
				$arr = array("Instant Delivery","3-4 Days","4-5 days","5-7 days","7-10 days","10-14 days");
				foreach($arr as $val)
				{
					if($val == $rsedit['product_delivery'])
					{
					echo "<option selected value='$val'>$val</option>";
					}
					else
					{
					echo "<option value='$val'>$val</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="col-md-6 col-lg-6">		
			<label class="control-label">Customer Address</label> <!-- in sql it is stored under Company Name-->
			<span id='idcompany_name' style="color:red;"></span>
			<input name="company_name" id="company_name" class="form-control" type="text" placeholder="Customer Address" value="<?php echo $rsedit['company_name']; ?>">
		</div>
	</div>
<?php
if(isset($_SESSION['employeeid']))
{
?>	
	<div class="row">
		<div class="col-md-12 col-lg-12">		
			<label class="control-label">Status:</label>
			<span id='idstatus' style="color:red;"></span>
			<br><select name="status" id="status" class="form-control" >
				<option value=''>Select</option>
				<?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
					if($val == $rsedit['status'])
					{
					echo "<option selected value='$val'>$val</option>";
					}
					else
					{
					echo "<option value='$val'>$val</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
<?php
}
else
{
?>
	<span id='idstatus' style="color:red;"></span>
<input type='hidden' name='status' id='status' value='<?php 
	if(isset($_GET['editid']))
	{
		echo $rsedit['status']; 
	}
	else
	{
		echo "Pending";
	}
?>'>
<?php
}	
?>
	<div class="contact-submit-btn"><hr>
		<center><button  type="submit" name="submit"  class="btn btn-info" >Click Here to Submit</button></center>
	</div>
</form>
                            </div>
                        </div>
						
                    </div>
					
					

                </div>
            </div>
            <!-- content-wraper end -->
            

<!-- footer-area start -->
<?php
include("footer.php");
?>
			<script>
function validateform()
{
	/* #######start 1######### */
	var alphaExp = /^[a-zA-Z]+$/;	//Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/;//Variable to validate only alphabets with space	
	var alphaspacenumbericExp = /^[a-zA-Z0-9\s]+$/;//Variable to validate only alphabets with space
	var alphanumericExp = /^[a-zA-Z0-9]+$/;//Variable to validate only alphanumerics
	var numericExpression = /^[0-9]+$/;	//Variable to validate only numbers
	var emailpattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; //For email id		      
	$("span").html("");
	var i=0;
	/* ########end 1######## */
	
	if(!document.getElementById("product_name").value.match(alphaspacenumbericExp))
	{
		document.getElementById("idproduct_name").innerHTML ="Product name should contain only alphabets and spaces....";	
		i=1;		
	}
	if(document.getElementById("product_name").value.length < 5)
	{
		document.getElementById("idproduct_name").innerHTML ="Product name should contain more than 10 characters....";	
		i=1;		
	}
	if(document.getElementById("product_name").value.length > 100)
	{
		document.getElementById("idproduct_name").innerHTML ="Product name should contain less than 20 characters....";	
		i=1;		
	}
	if(document.getElementById("product_name").value == "")
	{
		document.getElementById("idproduct_name").innerHTML ="Product name should not be empty....";	
		i=1;		
	}
	var image =document.getElementById("product_image").value;
    var checkimg = image.toLowerCase();
    if(!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.gif|\.GIF|\.jpeg|\.JPEG)$/))
	{
		document.getElementById("idproduct_image").innerHTML ="Please enter Image File Extensions .jpg,.png,.jpeg,.gif..";
		i=1;	
	}
	if(document.getElementById("product_image").value == "")
	{
		document.getElementById("idproduct_image").innerHTML ="Kindly upload the image..";	
		i=1;
	}
	if(document.getElementById("product_description").value == "")
	{
		document.getElementById("idproduct_description").innerHTML ="Description should not be empty....";	
		i=1;		
	}	
	if(document.getElementById("starting_bid").value < 1)
	{
		document.getElementById("idstarting_bid").innerHTML ="Starting bid must be more than a Rs.1....";	
		i=1;		
	}
	if(document.getElementById("starting_bid").value == "")
	{
		document.getElementById("idstarting_bid").innerHTML ="Starting bid should not be empty....";	
		i=1;		
	}
	if(document.getElementById("product_cost").value < 100)
	{
		document.getElementById("idproduct_cost").innerHTML ="Product cost should be more than RS.100....";	
		i=1;		
	}
	
	if(document.getElementById("product_cost").value == "")
	{
		document.getElementById("idproduct_cost").innerHTML ="Product cost should not be empty....";	
		i=1;		
	}
	/*
	if(document.getElementById("product_warranty").value=="")
	{
		document.getElementById("idproduct_warranty").innerHTML ="Product Warranty should not be empty..";	
		i=1;		
	}
	*/
	if(document.getElementById("product_delivery").value=="")
	{
		document.getElementById("idproduct_delivery").innerHTML ="Product delivery should not be empty....";	
		i=1;		
	}
	
	if(document.getElementById("company_name").value.length < 3)
	{
		document.getElementById("idcompany_name").innerHTML ="Company name should contain more than 3 characters....";	
		i=1;		
	}
	if(document.getElementById("company_name").value.length > 20)
	{
		document.getElementById("idcompany_name").innerHTML ="Company name should contain less than 20 characters...";	
		i=1;		
	}
	if(document.getElementById("company_name").value=="")
	{
		document.getElementById("idcompany_name").innerHTML ="Company name should not be empty....";	
		i=1;		
	}
	if(document.getElementById("status").value =="")
	{
		document.getElementById("idstatus").innerHTML ="Status should not be empty..";	
		i=1;		
	}
	/* #######start 2######### */
	if(i==0)
	{
		return true;
	}
	else
	{
	return false;
	}
	/* #######end 2######### */
}
function changedate(dt)
{
	var start_date = dt;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("idchangetodate").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxenddate.php?start_date="+start_date,true);
	xmlhttp.send();
}
</script>
