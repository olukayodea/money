<?php 
	include_once("includes/functions.php");
	$id = $common->get_prep($_REQUEST['id']);
	//post to payment gateway...
	//recieve from gateway
?>
<html>
<head>
<title>Please Wait...</title>
</head>
<body onLoad="document.submit2gtpay_form.submit()">

<div align="center"><img src="images/loading.gif" width="32" height="32"></div>
<!--<form name="submit2gtpay_form" method="post" action="https://www.globalpay.com.ng/Paymentgatewaycapture.aspx" target="_self">
  <input type="hidden" name="merchantid" value="<?php echo $merchantid; ?>" />
<input type="hidden" name="names" value="<?php echo $names; ?>" />
<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
<input type="hidden" name="currency" value="<?php echo $currency; ?>" />
<input type="hidden" name="email_address" value="<?php echo $email_address; ?>" />
<input type="hidden" name="phone_number" value="<?php echo $phone_number; ?>" />
<input type="hidden" name="merch_txnref" value="<?php echo $merch_txnref; ?>" />
</form>-->

<script type="text/javascript">
window.location='response?id=<?php echo $id; ?>';
</script>
</body>
</html>