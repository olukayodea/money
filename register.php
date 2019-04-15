<?php
	include_once("includes/functions.php");
	if ((isset($_REQUEST['redirect'])) && ($_REQUEST['redirect'] != "")) {
		$redirect = $_REQUEST['redirect'];
	} else {
		$redirect = "index";
	}
	
	$urlParam = $common->getParam($_SERVER['REQUEST_URI']);
	
	if (isset($_GET['logout'])) {
		$users->logout();
		header("location: ./");
	}
		
	if (isset($_REQUEST['msg'])) {
		$er = $_REQUEST['msg'];
	} else {
		$er = false;
	}
	
	$tagLink = $redirect."?".$urlParam;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Register</title>

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
  <div class="gray-bg">
    <div class="container">
      <div class="row margin-top10"> 
      <div align='center'>
      <img src="images/logo.png" width="106" height="112">
      </div>
        <!--REGISTRATION-->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
          <div class="white-bg">
            <h2 class="header registration-box hidden-xs hidden-sm"><i class="glyphicons glyphicons-user"></i> LOGIN</h2>
            <p class="text-center font-size14">Welcome, Please enter your username and password to continue.</p>
            <?php if ($er) { ?>
            <p class="text-center font-size14" style="color:#F00;" align="center"><?php echo $er; ?></p>
            <?php } ?>
            <p class="text-center font-size14" id="notificationDialogue2" style="color:#F00; display:none" align="center"></p>
            <div class="form-horizontal">
              <div class="row margin-top30 choose-box">
                <div class="col-xs-12 margin-left20">
                  <div class="form-group">
                    <div class="col-xs-3 text-center">
                    <input name="redirect" id="redirect2" type="hidden" value="<?php echo $tagLink; ?>">
                      <label for="fullNames" class="control-label">Full Names</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" name="fullNames" id="fullNames" placeholder="Full Names" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Names'" class="form-control">
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label for="createEmail" class="control-label">Email</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" name="createEmail" id="createEmail" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" class="form-control" onChange="checkEmail(this.value)">
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label for="newPassword" class="control-label">New Password</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <input type="password" name="newPassword" id="newPassword" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="form-control">
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label for="confirmPassword" class="control-label">Confirm New Password</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'"  class="form-control">
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="row margin-top30" align="center">By signing up, you are agreeing to CapeRemit’s <br>
          <a class="margin-right5" href="terms-conditions.php" target="_blank"><u>Terms and Conditions</u></a> and <a class="margin-left5" href="privacy-policy.php" target="_blank"><u>Privacy Policy</u></a></div>
                  <div class="row margin-top30">
                     <p class="continue-btn">
                      <a class="btn-sky" href="Javascript:void(0)" id="register_button" onClick="register()">LOGIN</a>
                     </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/REGISTRATION--> 
        
        <!--Icon-Panel-->
        <div class="col-xs-4 col-sm-12 col-md-12 col-lg-12 hidden-xs hidden-sm" id="sidebar">
          <div class="white-bg padding-top15">
            <div class="padding-left-right15 clearfix">
              <div id="box-panel"> 
              	<a href="sendMoney" class="money-box"> <span class="glyphicons glyphicons-credit-card font-size45"></span><span class="margin-top15 all-icon-box">Send Money</span> </a> 
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