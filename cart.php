<?php
include("header.php");
?>            
            <!-- breadcrumb-area start -->
            <div class="breadcrumb-area bg-gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb-list">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb-area end -->
            
            <!-- content-wraper start -->
            <div class="content-wraper mt-95">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form action="#" class="cart-table">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="plantmore-product-remove">remove</th>
                                                <th class="plantmore-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="plantmore-product-price">Unit Price</th>
                                                <th class="plantmore-product-quantity">Quantity</th>
                                                <th class="plantmore-product-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="plantmore-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                                <td class="plantmore-product-thumbnail"><a href="#"><img src="img/cart/1.jpg" alt=""></a></td>
                                                <td class="plantmore-product-name"><a href="#">Air Jordan XI Retro</a></td>
                                                <td class="plantmore-product-price"><span class="amount">$70.00</span></td>
                                                <td class="plantmore-product-quantity">
                                                    <input value="1" type="number">
                                                </td>
                                                <td class="product-subtotal"><span class="amount">$70.00</span></td>
                                            </tr>
                                            <tr>
                                                <td class="plantmore-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                                <td class="plantmore-product-thumbnail"><a href="#"><img src="img/cart/2.jpg" alt=""></a></td>
                                                <td class="plantmore-product-name"><a href="#">Brand Zoom KDX EP</a></td>
                                                <td class="plantmore-product-price"><span class="amount">$60.50</span></td>
                                                <td class="plantmore-product-quantity">
                                                    <input value="1" type="number">
                                                </td>
                                                <td class="product-subtotal"><span class="amount">$60.50</span></td>
                                            </tr>
                                            <tr>
                                                <td class="plantmore-product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                                                <td class="plantmore-product-thumbnail"><a href="#"><img src="img/cart/3.jpg" alt=""></a></td>
                                                <td class="plantmore-product-name"><a href="#">Brand FREE RN 2018</a></td>
                                                <td class="plantmore-product-price"><span class="amount">$40.50</span></td>
                                                <td class="plantmore-product-quantity">
                                                    <input value="1" type="number">
                                                </td>
                                                <td class="product-subtotal"><span class="amount">$40.50</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                            </div>
                                            <div class="coupon2">
                                                <input class="button" name="update_cart" value="Update cart" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul>
                                                <li>Subtotal <span>$170.00</span></li>
                                                <li>Total <span>$170.00</span></li>
                                            </ul>
                                            <a href="#">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wraper end -->
            
            
            <!-- footer-area start -->
           <?php
		   include("footer.php");
		   ?>