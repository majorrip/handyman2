<?php
include("header.php");

if(isset($_GET['delid'])) {
    $sql = "DELETE FROM product WHERE product_id='$_GET[delid]'";
    $qsql = mysqli_query($con, $sql);
    echo mysqli_error($con);
    if(mysqli_affected_rows($con) == 1) {
        echo "<script>alert('Product record deleted successfully...');</script>";
    }
}
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- banner -->
<div class="banner">
    <!-- about -->
    <div class="privacy about">
        <h3>View Product</h3>
        <div class="checkout-left">
            <div class="col-md-12">
                <table id="datatable" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Service Image</th>
                            <?php
                            if(isset($_SESSION['employeeid'])) {
                            ?>                    
                                <th>Customer</th>
                            <?php
                            }
                            ?>                
                            <th>Category</th>
                            <th style="width:175px;">Service name</th>
                            <th>Starting bid</th>
                            <th>Current bid</th>
                            <th>Scheduled on</th>            
                            <th>Service cost</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM product 
                                LEFT JOIN customer ON product.customer_id = customer.customer_id 
                                LEFT JOIN category ON product.category_id = category.category_id";
                        if(isset($_SESSION['customer_id'])) {
                            $sql .= " WHERE customer.customer_id='" . $_SESSION['customer_id'] . "'";
                        }
                        $sql .= " ORDER BY product_id DESC";
                        
                        $qsql = mysqli_query($con, $sql);
                        $currencysymbol = isset($currencysymbol) ? $currencysymbol : '৳'; // Default to Taka if not set
                        
                        while($rs = mysqli_fetch_array($qsql)) {
                            $arr_pro_img = unserialize($rs['product_image']);
                            $sqlbidding = "SELECT * FROM bidding WHERE product_id='" . $rs['product_id'] . "'";
                            $qsqlbidding = mysqli_query($con, $sqlbidding);
                            $currentcost = (mysqli_num_rows($qsqlbidding) >= 1) ? $rs['ending_bid'] : 0;
                            
                            echo "<tr><td>";
                        ?>
                            <div class="w3-content w3-section" style="max-width:500px">
                                <?php
                                if (is_array($arr_pro_img) && count($arr_pro_img) > 0) {
                                    for ($iimg = 0; $iimg < count($arr_pro_img); $iimg++) {
                                ?>
                                    <img class="mySlides<?php echo $rs['product_id']; ?> w3-animate-fading" src="imgproduct/<?php echo $arr_pro_img[$iimg]; ?>" style="width:100%">
                                <?php
                                    }
                                } else {
                                    // Default image if no images are available
                                    echo "<img class='w3-animate-fading' src='imgproduct/default_image.jpg' style='width:100%'>";
                                }
                                ?>
                            </div>
                            <script>
                            function carousel(className) {
                                var i;
                                var x = document.getElementsByClassName(className);
                                var index = 0;

                                function showSlides() {
                                    for (i = 0; i < x.length; i++) {
                                        x[i].style.display = "none";  
                                    }
                                    index++;
                                    if (index > x.length) { index = 1 }    
                                    x[index - 1].style.display = "block";  
                                    setTimeout(showSlides, 9000); 
                                }
                                showSlides();
                            }

                            window.onload = function() {
                                var allCarousels = document.querySelectorAll("[class^='mySlides']");
                                allCarousels.forEach(function(carousel) {
                                    var className = carousel.classList[0];
                                    carousel(className);
                                });
                            }
                            </script>
                        <?php
                            echo "</td>";
                            if(isset($_SESSION['employeeid'])) {
                                echo "<td>$rs[customer_fname] $rs[customer_lname]</td>";
                            }
                            echo "<td>$rs[category_name]</td>
                                <td>$rs[product_name]<br>
                                (<b>Category:</b> $rs[category_name])<br>
                                <b>Company:</b> $rs[company_name]
                                </td>
                                <td>$currencysymbol$rs[starting_bid]</td>
                                <td>";
                            if($currentcost == 0) {
                                echo "No bidding done yet..";
                            } else {
                                echo $currencysymbol . $rs['ending_bid'];
                            }
                            echo "</td><td>". date("d/m/Y h:i A", strtotime($rs['start_date_time'])) . " -".  date("d/m/Y h:i A", strtotime($rs['end_date_time'])) . "</td>
                                <td>$currencysymbol$rs[product_cost]</td>
                                <td>$rs[14]</td>
                                <td><a href='product.php?editid=" . $rs['product_id'] . "' class='btn btn-warning'>Edit</a><br>";
                            if(!isset($_SESSION['customer_id'])) {
                                if($_SESSION['employee_type'] == "Admin") {
                                    echo "<a href='viewproduct.php?delid=$rs[product_id]' onclick='return deleteconfirm()' class='btn btn-danger'>Delete</a><br>";
                                }
                            }
                            echo "<a href='single.php?productid=$rs[product_id]' target='_blank' class='btn btn-info'>View</a><hr>
                                <a href='billingreceipt.php?billproductid=$rs[product_id]' target='_blank' class='btn btn-success'>Receipt</a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <br>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //about -->
    <div class="clearfix"></div>
</div>
<!-- //banner -->
<script>
function deleteconfirm() {
    return confirm("Are you sure you want to delete this record?");
}
</script>

<?php
include("datatable.php");
include("footer.php");
?>
