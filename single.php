<?php
include("header.php");
if(isset($_POST['submit']))
{
		if($accbalamt > 0)
		{
		$dttime = date("Y-m-d H:i:s");
		$sql = "INSERT INTO  bidding (customer_id,product_id,bidding_amount,bidding_date_time,note,status) VALUES('$_SESSION[customer_id]','$_GET[productid]','$_POST[purchase_amount]','$dttime','$_POST[note]','Active')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Bidding done successfully..');</script>";
		}
		
		$biddingid = mysqli_insert_id($con);
			
		$sql = "UPDATE product SET ending_bid='$_POST[purchase_amount]' where product_id='$_GET[productid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		$biddingpercentageamt = ($_POST['purchase_amount']*1)/100;
		$sql = "INSERT INTO  payment(customer_id,payment_type,product_id,bidding_id,paid_amount,paid_date,status) VALUES('$_SESSION[customer_id]','Bid','$_GET[productid]','$biddingid','$biddingpercentageamt','$dt','Active')";
		$qsql = mysqli_query($con,$sql);
		
		echo "<script>window.location='single.php?productid=$_GET[productid]';</script>";
	}
	else
	{
		echo "<script>alert(`Your account does't have sufficient balance.. Kindly deposit amount.. `);</script>";
		echo "<script>window.location='deposit.php';</script>";
	}
}
$sqlproduct = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id LEFT JOIN customer ON customer.customer_id=product.customer_id WHERE product.product_id='$_GET[productid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct= mysqli_fetch_array($qsqlproduct);

$arr_product_image = unserialize($rsproduct['product_image']);
?>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area bg-gray">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb-list">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Products</li>
					<li class="breadcrumb-item active"><?php echo $rsproduct['product_name']; ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- breadcrumb-area end -->
			
			
<!-- ########################################## -->
<!-- ########################################## -->
<style>
.header-navigation {
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;
  font-size: .80rem;
}

.header-navigation a {
  font-size: .80rem;
}

.header-navigation .breadcrumb {
  margin-bottom: 0;
  background-color: transparent;
  padding: 0.20rem 1rem;
}

.header-navigation .btn-group {
 margin-left: auto;
}

.header-navigation .btn-share {
  position: relative;
}

.header-navigation .btn-share::after {
  content: "";
  width: 1px;
  height: 50%;
  background-color: #ccc;
  position: absolute;
  top: 50%;
  left: 100%;
  transform: translateY(-50%);
}

.store-body {
  display: flex;
  flex-direction: row;
  padding: 0;
}

.store-body .product-info {
  width: 60%;
  border-right: 1px solid rgba(0,0,0,.125); 
}

.store-body .product-payment-details {
  width: 40%;
  padding: 15px 15px 0 15px;
}

.product-info .product-gallery {
  display: flex;
  flex-direction: row;
  border-bottom: 1px solid rgba(0,0,0,.125);
}

.product-gallery-featured {
  display: flex;
  width: 100%;
  flex-direction: row;
  justify-content: center;
  align-items: flex-start;
  padding: 15px 0;
  cursor: zoom-in;
}

.product-gallery-thumbnails .thumbnails-list li {
  margin-bottom: 5px;
  cursor: pointer;
  position: relative;
  width: 70px;
  height: 70px;
}

.thumbnails-list li img {
  display: block;
  width: 100%;
}

.product-gallery-thumbnails .thumbnails-list li:hover::before {
  content: "";
  width: 3px;
  height: 100%;
  background: #007bff;
  position: absolute;
  top: 0;
  left: 0;
}

.product-info .product-seller-recommended {
  padding: 20px 20px 0 20px;
}
</style>
<br>
<main>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-10">
          <div class="card-header">
            <nav class="header-navigation">

              <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Products</li>
				<li class="breadcrumb-item active"><?php echo $rsproduct['product_name']; ?></li>
              </ol>
            </nav>
          </div>
          <div class="card-body store-body">
            <div class="product-info">
              <div class="product-gallery">
                <div class="product-gallery-thumbnails">
                  <ol class="thumbnails-list list-unstyled">
				  <?php
				  if (file_exists("imgproduct/".$arr_product_image[0]) && !empty($arr_product_image[0])) 
				  {
					?>
					<?php
				  		for($iimg = 0; count($arr_product_image) > $iimg; $iimg++)
				  		{
				  ?>
                    <li><img src="imgproduct/<?php echo $arr_product_image[$iimg]; ?>" alt=""></li>
				 <?php
				  		}
					}
				  ?>
                  </ol>
                </div>
                <div class="product-gallery-featured">
                  <img src="
				  <?php
						if (file_exists("imgproduct/".$arr_product_image[0]) && !empty($arr_product_image[0])) 
						{
							echo $imgname = "imgproduct/".$arr_product_image[0];
						} 
						else 
						{
							echo $imgname = "images/noimage.gif";
						}
				  ?>" alt="">
                </div>
              </div>
              <div class="product-seller-recommended">

				<!-- /.recommended-items-->
                <div class="product-description mb-5">

					
                    <div class="product-info-review">
                        <div class="row">
                            <div class="col">
                                <div class="product-info-detailed" style="margin-top: 2px;background: #e5e8ee none repeat scroll 0 0;">
                                    <div class="discription-tab-menu">
                                        <ul role="tablist" class="nav">
                                            <li class="active"><a href="#description" data-toggle="tab" class="active show">Description</a></li>
<?php
	$sqledit = "SELECT * FROM bidding LEFT JOIN customer ON bidding.customer_id = customer.customer_id WHERE product_id='$_GET[productid]' ORDER BY bidding_id DESC";
	$qsqledit = mysqli_query($con,$sqledit);
?>	
                                            <li><a href="#review" data-toggle="tab">Bidders list (<?php echo mysqli_num_rows($qsqledit); ?>)</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="discription-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="description">
                                            <div class="description-content">
<div class="row">

	<div class="col-md-8">
		<table class="table table-striped table-bordered">
			<tbody>
				<tr>
					<th>Uploaded by :</th><td><?php echo $rsproduct['customer_fname']; ?> <?php echo $rsproduct['customer_lname']; ?></td>
				</tr>
				<tr>
					<th>Product Code :</th><td><?php echo $rsproduct['product_id']; ?></td>
				</tr>
				<tr>
					<th>Product warranty :</th><td><?php echo $rsproduct['product_warranty']; ?></td>
				</tr>
				<tr>
					<th>Company :</th><td><?php echo $rsproduct['company_name']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
		
	<div class="col-md-4">	
	<?php
	if($_SESSION['customer_id'] != $rsproduct['customer_id'])
	{
		if(isset($_SESSION['customer_id']))
		{
			include("chat.php");
		}
		else
		{
			echo "<b style='color:red'><a href='login.php' class='btn btn-info'>Login to chat..</a></b><hr>";
		}
	}
	?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	<p><?php echo $rsproduct['product_description']; ?></p>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
<p><b>Product Delivery details :</b> <?php echo $rsproduct['product_delivery']; ?></p>
	</div>
</div>
<hr>

                                            </div>
                                        </div>
                                        <div id="review" class="tab-pane fade">

<div class="description-content">
	<p>
	<?php
		if(mysqli_num_rows($qsqledit) == 0)
		{
			echo "<center><b style='color: red;'>No biddings done yet..</b></center>";
		}			
		$sqleditbidding = "SELECT * FROM bidding LEFT JOIN customer ON bidding.customer_id = customer.customer_id WHERE product_id='$_GET[productid]' ORDER BY bidding_id DESC";
		$qsqleditbidding = mysqli_query($con,$sqleditbidding);
		while($rsedit= mysqli_fetch_array($qsqleditbidding))
		{
		echo "$rsedit[customer_fname] $rsedit[customer_lname] bidded $currencysymbol". $rsedit['bidding_amount'] ." on $rsedit[bidding_date_time]<hr>";
		}
	?>
	</p>
</div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
              </div>
            </div>
            <div class="product-payment-details">
									
                                        <div>
                                            <h2><?php echo $rsproduct['product_name']; ?> </h2>
                                            <div class="rating-box">
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"><b><?php echo $rsproduct['category_name']; ?></b></i></li>
                                                </ul>
                                            </div>
                                            <p>
<h4>Time Remaining<p id="demo<?php $rsproduct['product_id']; ?>" style="color: red;"></p></h4>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo date("M d, Y H:i:s",strtotime($rsproduct[8])); ?>").getTime();

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
    document.getElementById("demo").innerHTML = days + "days " + hours + "hrs "
    + minutes + "min " + seconds + "sec ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo<?php $rsproduct['product_id']; ?>").innerHTML = "EXPIRED";
		
		document.getElementById("divbidstatus").innerHTML = '<div class="snipcart-details agileinfo_single_right_details"><input type="button" name="submit" value="Closed" class="button" disabled /></div>';
		
    }
}, 1000);
</script>
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

											</p>

                                            <div class="price-box">
<p><b>Actual product cost</b> : <?php echo $currencysymbol; ?><?php echo $rsproduct['product_cost']; ?></p> <h4>Current Bid Amount : <br><?php echo $currencysymbol; ?><?php echo $rsproduct['ending_bid']; ?></h4>

<input type='hidden' name='max_bid_amt' id='max_bid_amt' value='<?php echo $rsproduct['ending_bid']+25; ?>'>

                                              <?php /* <span class="new-price">$225.00</span>
                                               <span class="old-price">$250.00</span>
											   */ ?>
<form action="" method="post"  onsubmit="return confirmbidding()">
<input type='hidden' name='ending_bid' id='ending_bid' value='<?php echo $rsproduct['ending_bid']; ?>'>
<?php
if(isset($_SESSION['customer_id']))
{
	 $currenttime = strtotime(date("Y-m-d H:i:s"));
	 $endtime = strtotime($rsproduct['end_date_time']);
	 //echo $rsproduct[end_date_time];
	if($endtime >$currenttime)
	{
		if($_SESSION['customer_id'] == $rsproduct['customer_id'])
		{
?>
<div id="divbidstatus">
	<div class="w3_agileits_card_number_grid_left">
		<div class="controls">
			<label class="control-label">You can't bid for own products..</label>
		</div>
	</div>
</div>
<?php
		}
		else
		{
?>
<div id="divbidstatus">
	<div class="w3_agileits_card_number_grid_left">
		<div class="controls">
			<label class="control-label"><b>Enter Bid Amount</b></label>
			<input name="purchase_amount" id="purchase_amount" class="form-control" type="text" placeholder="Enter amount" style="width:200px;" autocomplete="off"  >		
		</div>
	</div> <br>
	<div class="snipcart-details agileinfo_single_right_details">
			<fieldset>
				<input type="submit" name="submit" value="Bid Now" class="form-control" style="width: 250px;"   />
			</fieldset>
	</div>
</div>
<?php
		}
	}
	else
	{
?>
<fieldset>

	<div class="snipcart-details agileinfo_single_right_details">
		<a href='single.php?productid=<?php echo $rsproduct['product_id']; ?>'><input type="button" name="submit" value="Closed" class="form-control" style="width: 250px;" disabled /></a>
	</div>
</fieldset> 
<?php
	}
}
else
{
?>
<div class="snipcart-details agileinfo_single_right_details">
		<fieldset>
			<input type="button" onclick='window.location=`customerlogin.php`' name="submit" value="Login to Bid"  class='btn btn-info' style="width: 250px;" />
		</fieldset>
</div>
<?php
}
?>
</form>
                                            </div>
                                        </div>
                                    
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
// select all thumbnails
const galleryThumbnail = document.querySelectorAll(".thumbnails-list li");
// select featured
const galleryFeatured = document.querySelector(".product-gallery-featured img");

// loop all items
galleryThumbnail.forEach((item) => {
  item.addEventListener("click", function () {
    let image = item.children[0].src;
    galleryFeatured.src = image;
  });
});

// show popover
$(".main-questions").popover('show');

</script>
<!-- ########################################## -->
<!-- ########################################## -->
		
            
            <!-- product-area start -->
            <div class="product-area ptb-95">	<hr>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="section-title-3">
                                <h2>Similar products under <?php echo $rsproduct['category_name']; ?>:</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="product-active-3 owl-carousel">

	<?php
$i=0;	
	?><?php
			$sqlproduct = "select product.*,category.category_name from product LEFT JOIN category on product.category_id=category.category_id WHERE product.status='Active' AND product.product_id!='" . $_GET['productid'] . "' order by product.product_id DESC limit 0,4";
			$qsqlproduct = mysqli_query($con,$sqlproduct);
			while($rsproduct = mysqli_fetch_array($qsqlproduct))
			{
				$i++;
				$productimg = unserialize($rsproduct['product_image']);
				if(empty($productimg[0])){
					$imgname = "images/noimage.gif";
				} else if(file_exists("imgproduct/".$productimg[0])) {
					$imgname = "imgproduct/".$productimg[0];
				} else {
					$imgname = "images/noimage.gif";
				}
?>
<div class="col">
	<!-- single-product-wrap start -->
	<div class="single-product-wrap">
		<div class="product-image box"  style="height:350px;width:100%;">
			<a href="single.php?productid=<?php echo $rsproduct[0]; ?>">
<div id="img-1" class="zoomWrapper single-zoom" style="background-color: #f8f8f8;">
	<a href="single.php?productid=<?php echo $rsproduct[0]; ?>">
	<center><img id="zoom1" src="<?php echo $imgname; ?>" data-zoom-image="<?php echo $imgname; ?>" alt="big-1" style="width: 100%;height: 100%;"></center>
	</a>
</div>
				<?php /*<img class="secondary-image" src="<?php echo $imgname; ?>" alt=""> */ ?>
			</a>
			<div class="label-product"><?php echo $rsproduct['category_name']; ?></div>
		</div>
		<div class="product_desc">

			<div class="add-actions">
				<ul class="add-actions-link">
					<li class="add-cart"><a href="single.php?productid=<?php echo $rsproduct[0]; ?>"><i class="ion-android-cart"></i> Click here to BID</a></li>
				<?php
				/*
					<li><a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" href="#"><i class="ion-android-open"></i></a></li>
					<li><a class="links-details" href="single-product.php"><i class="ion-clipboard"></i></a></li>
					*/
					?>
				</ul>
			</div>
		</div>
	</div>
	<!-- single-product-wrap end -->
</div>
			<?php
			}
			?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-area end -->
            
            
            <!-- footer-area start -->
           <?php
		   include("footer.php");
		   ?>
<script>
function confirmbidding()
{
	if(document.getElementById("purchase_amount").value == "")
	{
		alert('Bidding amount not entered..');
		return false;
	}
	if(parseFloat(document.getElementById("ending_bid").value)  > parseFloat(document.getElementById("purchase_amount").value))
	{
		alert('Bidding amount must be greater than ' + document.getElementById("ending_bid").value);
		return false;
	}
	else if(parseFloat(document.getElementById("purchase_amount").value)  > parseFloat(document.getElementById("max_bid_amt").value))
	{
		alert('Bidding amount should be lesser than ' + document.getElementById("max_bid_amt").value);
		return false;
	}
	else
	{
		if(confirm("confrim to bid!!") == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
</script>