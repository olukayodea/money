<?php
	$redirect = "sendMoney";
	include_once("includes/functions.php");
	include_once("includes/session.php");
	if (isset($_SESSION['tempPayment'])) {
		$data = $_SESSION['tempPayment'];
	} else {
		$data['amount'] = 100;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Send Money</title>
    <link rel="shortcut icon" href="images/Preload.gif">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="css/select2/select2.css" rel="stylesheet"/>
    <link href="css/jPushMenu.css" rel="stylesheet"/>
    <link href="css/datatables/dataTables.bootstrap.min.css" rel="stylesheet"/>
</head>

<body>
<nav class="">
<?php if (isset($_SESSION['users']['ref'])) { ?>
	<a href="<?php echo URL; ?>about-us">About Us</a>
	<a href="<?php echo URL; ?>profile">My Account</a>
	<a href="<?php echo URL; ?>sendMoney">Send Money</a>
    <a href="<?php echo URL; ?>send-mobile-airtime">Send Mobile Airtime</a>
	<a href="<?php echo URL; ?>pay-bills">Pay Bills</a>
	<a href="<?php echo URL; ?>myPayments">My Payments</a>
    <a href="<?php echo URL; ?>profile">My Profile</a>
	<a href="<?php echo URL; ?>myRecipientList">My Recipients</a>
	<a href="<?php echo URL; ?>invite-friends">Invite Friends</a>
    <a href="<?php echo URL; ?>changePassword">Change Password</a>
	<a href="<?php echo URL; ?>?login?logout">Log Out</a>
<?php } else {
	if ($login == true) { ?>
	<a href="<?php echo URL; ?>login?redirect=<?php echo $login; ?>">Log In</a>
	<a href="<?php echo URL; ?>register?redirect=<?php echo $login; ?>">Sign Up</a>
    <?php } else { ?>
	<a href="#" data-toggle="modal" data-target="#myModal">Log In</a>
	<a href="#" data-toggle="modal" data-target="#myModal2">Sign Up</a>
    <?php } ?>
	<a href="about-us">About Us</a>
<?php } ?>
</nav>
    
    <!--Body Part-->
    <div class="container">
     <div class="row margin-top10">
      <div align='center'>
      <img src="images/logo.png" width="106" height="112">
      </div>
     <!--SEND MONEY-->
       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
         <div class="white-bg">
           <h2 class="header deep-blue hidden-xs hidden-sm"><i class="glyphicons glyphicons-credit-card"></i> SEND MONEY</h2>
         <!--Enter Amount to Send-->
           <div class="row padding-left-right15">
             <div id="round-box">
              <div class="all-amount-panel">
               <div class="padding-left15">
                 <div class="send-round-box">
                   <div class="amount-box"><strong>1</strong> </div>
                   <div class="text-gray active"><strong>Enter Amount <br>to Send</strong></div>
                  </div>
                <div class="col-xs-1 line-border hidden-xs hidden-sm"></div>
                </div>
               </div>
              <div class="all-amount-panel hidden-xs hidden-sm">
               <div class="row">
                 <div class="send-round-box">
                   <div class="amount-gray-box"><strong>2</strong> </div>
                   <div class="text-gray"><strong>Add Recipient’s <br>Details</strong></div>
                </div>
                <div class="col-xs-1 line-border"></div>
                </div>
               </div>  
              <div class="confirm-box hidden-xs hidden-sm">
               <div class="row">
                 <div class="send-round-box">
                   <div class="amount-con"><strong>3</strong> </div>
                   <div class="text-gray"><strong>Confirm and <br>Pay</strong></div>
                   </div>
                </div>
               </div>  
             </div>
           </div>
           <div class="form-horizontal">
             <div class="row margin-top70 choose-box">
               <div class="col-xs-12 margin-left20">
               <div align="center" id="status" style=" display:none;color:#F00; font-weight:bold"></div>
                  <div id="mony-box">
                     <div class="form-group">
                    <div class="col-xs-3 text-center">
                     <label class="control-label">I want to send</label>
                     </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" name="amount" id="amount" class="form-control" onChange="calculateCharges()" value="<?php echo $data['amount']; ?>">
                    </div>
                    <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 blow padding-left0 dark">
                      <select name="send_currency" id="send_currency" class="country-select" style="width:100%" onChange="calculateCharges()">
                        <option<?php if ($data['send_currency'] == "CA") { ?> selected<?php } ?> value="CA">CAD</option>
                        <option<?php if ($data['send_currency'] == "CH") { ?> selected<?php } ?> value="CH">CNY</option>
                        <option<?php if ($data['send_currency'] == "US") { ?> selected<?php } ?> value="US">USD</option>
                        <option<?php if ($data['send_currency'] == "GB") { ?> selected<?php } ?> value="GB">GBP</option>
                      </select>
                    </div>
                  </div>
                     <div class="form-group text-center margin-top24">
                        <label class="col-xs-3 control-label">To</label>
                        <div class="col-xs-6 text-left">
                          <select name="dest_country" id="dest_country" class="country-select" style="width:100%">
                            <option<?php if ($data['dest_country'] == "CA") { ?> selected<?php } ?> value="CA">Canada</option>
                            <option<?php if ($data['dest_country'] == "CH") { ?> selected<?php } ?> value="CH">China</option>
                            <option<?php if ($data['dest_country'] == "NG") { ?> selected<?php } ?> value="NG">Nigeria</option>
                            <option<?php if ($data['dest_country'] == "US") { ?> selected<?php } ?> value="US">United States</option>
                            <option<?php if ($data['dest_country'] == "GB") { ?> selected<?php } ?> value="GB" selected>United Kingdom</option>
                          </select>
                        </div>
                      </div>
                   <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                     <label class="control-label">Our Fees</label>
                     </div>
                    <div class="col-xs-6">
                      <input readonly type="text" name="fee" id="fee" class="form-control" value="">
                    </div>
                    
                  </div>	
                     <div class="form-group margin-top24">
                    <div class="col-xs-3"></div>
                    <div class="col-xs-9">
                        <input name="dectt_fee" value="true" type="checkbox" id="dectt_fee" onChange="calculateCharges()" <?php if ($data['dectt_fee'] == "true") { ?> checked<?php } ?>>
                        <label for="dectt_fee"><small>Deduct fees from send amount</small></label> 
                    </div>
                  </div>
                   <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                     <label class="control-label">Total to Send</label>
                     </div>
                    <div class="col-xs-6">
                      <input readonly type="text" name="total_pay" id="total_pay" class="form-control">
                    </div>
                    
                  </div>	
                     <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                     <label class="control-label">Recipient Gets <br>Exactly</label>
                     </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" name="rec_amount" id="rec_amount" value="" class="form-control" readonly>
                    </div>
                    <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 padding-left0 dark">
                      <select class="country-select" style="width:100%">
                         <option value="NG">NGN</option>
                      </select>
                    </div>
                  </div>
                     <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Recipient Receives <br>Money By</label>
                    </div>
                    <div class="col-xs-6 ">
                      <select class="single-select" name="rec_medium" id="rec_medium" style="width:100%">
                        <option value="access">Bank Transfer</option>
                      </select>
                     <p class="shart-text"><strong id="conversionRate"></strong> </p>
                   </div>
                 </div>
                  <div class="row margin-top30">
                     <p class="continue-btn">
                      <a class="btn-green4" href="manageRecipient">CONTINUE</a>
                     </p>
                    </div>
                   </div>
                  </div>
                 </div>
                </div>
        <!--Enter Amount to Send-->
              </div>
             </div>
      <!--/SEND MONEY-->
     
      <!--Icon-Panel-->
      <div class="col-xs-4 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm" id="sidebar">
        <div class="white-bg padding-top15">
          <div class="padding-left-right15 clearfix">
              <div class="sky-box">
              <div class="margin-top10 text-center font-size20"><strong>Hello</strong></div>
              <span class="glyphicons glyphicons-user font-size70"></span>
              <div class="margin-top10 text-center font-size20"><strong><?php echo $last_name." ".$other_names; ?></strong></div>
            </div>
               <div id="box-panel"> 
              	<a href="sendMoney" class="money-box active"> <span class="glyphicons glyphicons-credit-card font-size45"></span><span class="margin-top15 all-icon-box">Send Money</span> </a> 
                <a href="send-mobile-airtime.php" class="send-mobile-box"> <span><img src="images/mobile-phone-icon.png" height="44"></span><span class="margin-top15 all-icon-box">Send  Mobile Airtime</span> </a> 
                <a href="pay-bills.php"class="pay-bills-box"> <span><img src="images/bill.png" width="37" height="auto"></span><span class="margin-top15 all-icon-box">Pay Bills</span> </a> 
                <a href="myPayments" class="payments-box"> <span class="glyphicons glyphicons-circle-arrow-right small-payments-text"></span><span class="margin-top15 all-icon-box">My Payments</span> </a> 
                <a href="profile" class="profile-box"> <span class="glyphicons glyphicons-user font-size45"></span><span class="margin-top15 all-icon-box">My Profile</span> </a> 
                <a href="myRecipientList"class="recipients-box"> <span class="glyphicons glyphicons-group small-payments-text"></span><span class="margin-top15 all-icon-box">My Recipients</span> </a> 
                <a href="invite-friends.php" class="invite-box"> <span class="glyphicons glyphicons-user-add small-payments-text"></span><span class="margin-top15 all-icon-box">Invite Friends</span> </a> 
                <a href="changePassword" class="password-box"> <span class="glyphicons glyphicons-lock"></span><span class="margin-top15 all-icon-box">Change Password</span> </a> 
             </div>
          </div>
        </div>
      </div>
      <!--/Icon-Panel-->
     </div>
     
     
    </div>
    <!--/Body Part-->  
    <!--  Footer Part HTML ends  -->
    <script src="js/jquery-3.1.0.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
	<script src="js/select2/select2.full.min.js"></script> 
    <script src="js/daterangepicker/moment.min.js"></script> 
    <script src="js/daterangepicker/daterangepicker.js"></script> 
    <script src="js/datatables/jquery.dataTables.min.js"></script> 
    <script src="js/datatables/dataTables.bootstrap.min.js"></script> 
    <script src="js/jPushMenu.js"></script>
<script language="javascript">
	$( document ).ready(function() {
		calculateCharges();
	});
</script>
</body>
</html>