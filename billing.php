<?php
include("header.php");
$sqlproduct = "SELECT * FROM product WHERE product_id='$_GET[productid]'";
$qsqlproduct = mysqli_query($con,$sqlproduct);
$rsproduct= mysqli_fetch_array($qsqlproduct);
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
	    $sql = "UPDATE billing SET customer_id='$_POST[customer_id]',product_id='$_POST[product_id]',purchase_date='$_POST[purchase_date]',purchase_amount='$_POST[purchase_amount]',payment_type='$_POST[payment_type]',card_number'$_POST[card_number]',expire_date='$_POST[expire_date]',cvv_number='$_POST[cvv_number]',card_holder='$_POST[card_holder]',delivery_date='$_POST[delivery_date]',note='$_POST[note]',status='$_POST[status]' where billing_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Billing record updated successfully..');</script>";
		}
	}
	else
	{

		$sql = "INSERT INTO  billing (purchase_date,purchase_amount,payment_type,card_type,card_number,expire_date,cvv_number,card_holder,delivery_date,note,status,customer_id,product_id) VALUES('$dt','100','Sell','$_POST[payment_type]','$_POST[card_number]','$_POST[expire_date]-01','$_POST[cvv_number]','$_POST[card_holder]','$_POST[delivery_date]','$_POST[note]','Active','$_SESSION[customer_id]','$_GET[productid]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Billing record inserted successfully..');</script>";
			$insid = mysqli_insert_id($con);
			
			$sql = "UPDATE product SET status='Active' WHERE product_id='$_GET[productid]'";
			mysqli_query($con,$sql);
			
			echo "<script>window.location='billingreceipt.php?billingid=$insid';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM billing WHERE billing_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit= mysqli_fetch_array($qsqledit);
}

?>          <div class="content-wraper mt-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                        <div class="col-lg-9 col-md-6 col-sm-6">
                            <div class="customer-login-register">
							
<!-- banner -->
	<div class="banner">
		<?php
		include("sidebar.php");
		?>
		<div class="w3l_banner_nav_right">
<!-- about -->

		<div class="privacy about">
			<h3>Billing <span>Form</span></h3>

			<?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="checkout-left">
                            <div class="col-md-8">
                                <form action="" method="post" onsubmit="return validateform()" class="creditly-card-form">
                                    <section class="creditly-wrapper">
                                        <div class="information-wrapper">
                                            <!-- Product Information -->
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Product name</th>
                                                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Charges</th>
                                                    <td>Rs. 100</td>
                                                </tr>
                                            </table>

                                            <!-- Payment Type Selection -->
                                            <div class="form-group">
                                                <label>Payment Type</label>
                                                <span id="idpayment_type" class="text-danger"></span>
                                                <select name="payment_type" id="payment_type" class="form-control" onchange="updateLabels()">
                                                    <option value="">Select</option>
                                                    <option value="Credit card">Credit card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="Nagad">Nagad</option>
                                                    <option value="Bkash">Bkash</option>
                                                </select>
                                            </div>

                                            <!-- Card Holder / Account Name -->
                                            <div class="form-group">
                                                <label id="label_card_holder">Card holder</label>
                                                <span id="idcard_holder" class="text-danger"></span>
                                                <input name="card_holder" id="card_holder" class="form-control" placeholder="">
                                            </div>

                                            <!-- Card Number / MFS Number -->
                                            <div class="form-group">
                                                <label id="label_card_number">Card number</label>
                                                <span id="idcard_number" class="text-danger"></span>
                                                <input name="card_number" id="card_number" class="form-control" placeholder="">
                                            </div>

                                            <!-- Expiry Date / Current Date -->
                                            <div class="form-group">
                                                <label id="label_expire_date">Expiry date</label>
                                                <span id="idexpire_date" class="text-danger"></span>
                                                <input name="expire_date" id="expire_date" type="month" class="form-control" min="<?php echo date("Y-m"); ?>">
                                            </div>

                                            <!-- CVV / PIN -->
                                            <div class="form-group">
                                                <label id="label_cvv_number">CVV number</label>
                                                <span id="idcvv_number" class="text-danger"></span>
                                                <input name="cvv_number" id="cvv_number" class="form-control" placeholder="">
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-info" type="submit" name="submit">
                                                    Make Payment
                                                </button>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateLabels() {
    const paymentType = document.getElementById('payment_type').value;
    const isMFS = paymentType === 'Bkash' || paymentType === 'Nagad';
    
    // Update labels based on payment type
    document.getElementById('label_card_holder').textContent = isMFS ? 'MFS Account Name' : 'Card holder';
    document.getElementById('label_card_number').textContent = isMFS ? `${paymentType} Number` : 'Card number';
    document.getElementById('label_expire_date').textContent = isMFS ? 'Current Date' : 'Expiry date';
    document.getElementById('label_cvv_number').textContent = isMFS ? 'PIN Number' : 'CVV number';
    
    // Update placeholders
    document.getElementById('card_holder').placeholder = isMFS ? 'Enter MFS account name' : 'Enter card holder name';
    document.getElementById('card_number').placeholder = isMFS ? `Enter ${paymentType} number` : 'Enter card number';
    document.getElementById('cvv_number').placeholder = isMFS ? 'Enter PIN number' : 'Enter CVV';
    
    // Handle expiry date field
    const expireDateInput = document.getElementById('expire_date');
    if (isMFS) {
        const currentDate = new Date().toISOString().slice(0, 7); // YYYY-MM format
        expireDateInput.value = currentDate;
        expireDateInput.readOnly = true;
    } else {
        expireDateInput.readOnly = false;
        expireDateInput.value = ''; // Clear the value when switching back to card payment
    }
}

function validateform() {
    const errors = [];
    const alphaExp = /^[a-zA-Z\s]+$/;
    const numericExp = /^\d+$/;
    const paymentType = document.getElementById('payment_type').value;
    const isMFS = paymentType === 'Bkash' || paymentType === 'Nagad';
    
    // Clear previous error messages
    document.querySelectorAll('span[id^="id"]').forEach(span => span.textContent = '');
    
    // Payment Type validation
    if (!paymentType) {
        document.getElementById('idpayment_type').textContent = 'Please select a payment type';
        errors.push('payment_type');
    }
    
    // Card Holder / Account Name validation
    const cardHolder = document.getElementById('card_holder');
    if (!cardHolder.value) {
        document.getElementById('idcard_holder').textContent = isMFS ? 
            'MFS account name is required' : 'Card holder name is required';
        errors.push('card_holder');
    } else if (!alphaExp.test(cardHolder.value)) {
        document.getElementById('idcard_holder').textContent = isMFS ?
            'Account name should contain only letters' : 'Card holder name should contain only letters';
        errors.push('card_holder');
    }
    
    // Card Number / MFS Number validation
    const cardNumber = document.getElementById('card_number');
    if (!cardNumber.value) {
        document.getElementById('idcard_number').textContent = isMFS ?
            `${paymentType} number is required` : 'Card number is required';
        errors.push('card_number');
    } else if (!numericExp.test(cardNumber.value)) {
        document.getElementById('idcard_number').textContent = 'Should contain only numbers';
        errors.push('card_number');
    } else if (isMFS && cardNumber.value.length !== 11) {
        document.getElementById('idcard_number').textContent = `${paymentType} number must be 11 digits`;
        errors.push('card_number');
    } else if (!isMFS && cardNumber.value.length !== 16) {
        document.getElementById('idcard_number').textContent = 'Card number must be 16 digits';
        errors.push('card_number');
    }
    
    // CVV / PIN validation
    const cvvNumber = document.getElementById('cvv_number');
    if (!cvvNumber.value) {
        document.getElementById('idcvv_number').textContent = isMFS ?
            'PIN number is required' : 'CVV number is required';
        errors.push('cvv_number');
    } else if (!numericExp.test(cvvNumber.value)) {
        document.getElementById('idcvv_number').textContent = 'Should contain only numbers';
        errors.push('cvv_number');
    } else if (isMFS && cvvNumber.value.length !== 4) {
        document.getElementById('idcvv_number').textContent = 'PIN must be 4 digits';
        errors.push('cvv_number');
    } else if (!isMFS && cvvNumber.value.length !== 3) {
        document.getElementById('idcvv_number').textContent = 'CVV must be 3 digits';
        errors.push('cvv_number');
    }
    
    return errors.length === 0;
}

// Call updateLabels on page load in case of form refill
document.addEventListener('DOMContentLoaded', updateLabels);
</script>