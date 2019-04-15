<?php
	$redirect = "confirmation";
	include_once("includes/functions.php");
	include_once("includes/session.php");
	if (isset($_SESSION['tempPayment'])) {
		$data = $_SESSION['tempPayment'];
	} else {
		header("location: sendMoney");
	}
	
	if (isset($_POST['submit'])) {
		$add = $transactions->create();
		
		if ($add) {
			unset($_SESSION['tempPayment']);
			header("location: redirect?id=".$add);
		} else {
			header("location: ?error=".urlencode("An error occured, please try again"));
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Payment Confirmation | PayMack</title>
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
     <!--SEND MONEY-->
       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
         <div class="white-bg">
             <h2 class="header deep-blue hidden-xs hidden-sm"><i class="glyphicons glyphicons-credit-card"></i> SEND MONEY</h2>
         <!--Enter Amount to Send-->
            <div class="row margin-top15 padding-left-right15">
               <div id="round-box">
                <div class="all-amount-panel hidden-xs hidden-sm">
                 <div class="padding-left15">
                   <div class="send-round-box">
                     <div class="amount-gray-box2"><strong>1</strong> </div>
                     <div class="text-gray"><strong>Enter Amount <br>to Send</strong></div>
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
                  <div class="col-xs-1 line-border hidden-xs hidden-sm"></div>
                  </div>
                 </div>  
                <div class="confirm-box">
                 <div class="row">
                   <div class="send-round-box">
                     <div class="amount-con-green"><strong>3</strong> </div>
                     <div class="text-green-box active"><strong>Confirm and <br>Pay</strong></div>
                     </div>
                  </div>
                 </div>  
               </div>
           </div>
        <!--Enter Amount to Send-->
           
          <!--Confirm and Pay--> 
           <div id="guide-panel" class="row padding-left-right15">
              <div class="form-horizontal">
             <div class="row confirm-text choose-box">
               <div class="col-xs-12 margin-left20">
               <?php if (isset($_REQUEST['error'])) { ?>
              <div style="color:#F00" align="center"><strong><?php echo $common->get_prep($_REQUEST['error']); ?></strong></div>
              <?php } ?>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center"> Amount to Send</div>
                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><?php echo $common->selectcurrency($data['send_currency'])." ".number_format($data['amount'], 2); ?></div>
                   </div>
                 <div class="form-group margin-top24">
                     <div class="col-xs-3 text-center"> To </div>
                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong>Nigeria</strong></div>
                   </div>
                 <div class="form-group margin-top24">
                     <div class="col-xs-3 text-center"> Our Fees</div>
                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $common->selectcurrency($data['send_currency'])." ".number_format($data['fee'], 2); ?></strong></div>
                   </div>
                 <div class="form-group margin-top24">
                     <div class="col-xs-3 text-center">Recipient Bears Fees</div>
                     <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">Yes</div>
                   </div>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center">Total to Pay</div>
                   <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $common->selectcurrency($data['send_currency'])." ".number_format($data['balance'], 2); ?></strong></div>
                 </div>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center">Recipient Recieves</div>
                   <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $common->selectcurrency("NG")." ".number_format($data['balance']*$data['xchange'], 2); ?></strong></div>
                 </div>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center">Recipient Bank</div>
                   <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $bank->getOneField($recipient_money->getOneField($data['recipient'], "ref", "bank")); ?></strong></div>
                 </div>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center">Account Number</div>
                   <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $recipient_money->getOneField($data['recipient'], "ref", "account_number"); ?></strong></div>
                 </div>
                 <div class="form-group margin-top24">
                   <div class="col-xs-3 text-center">Account Name</div>
                   <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><strong><?php echo $recipient_money->getOneField($data['recipient'], "ref", "account_name"); ?></strong></div>
                 </div>
                 <p class="font-size12 text-center">This transaction will appear on your card/bank statement as <br>a payment to PayMack Limited</p>
                     <div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 margin-top30 continue-btn">
                      <form id="form1" name="form1" action="" method="post">
                      <button name="button" class="btn-gray" type="button" id="button" onClick="window.location='sendMoney'">Back</button>
                      <button name="submit" class="btn-green2 margin-left18" type="submit" id="submit">Confirm and Pay</button>
                      </form>
                   </div>
                    
                 </div>
               </div>
             </div>
              
            </div>
          <!--/Confirm and Pay-->    
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
</body>
</html>