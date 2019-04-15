<?php
	$redirect = "myRecipientList";
	include_once("includes/functions.php");
	include_once("includes/session.php");
	
	if (isset($_SESSION['tempPayment']['recipient'])) {
		unset($_SESSION['tempPayment']['recipient']);
	}
	
	
	if (isset($_REQUEST['remove'])) {
		if (isset($_REQUEST['id'])) {
			$id = $common->get_prep($_REQUEST['id']);
		} else {
			header("location: myRecipientList");
		}
		$del = $recipient_money->delete($id);
		
		if ($del) {
			header("location: ?done");
		} else {
			header("location: ?error=".urlencode("Cannot complete this action"));
		}
	}
	
	$list = $recipient_money->sortAll("user", $ref);
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>My Recipients</title>
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
         <!--MY PROFILE-->
           <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
             <div class="white-bg">
                <h2 class="header recipients-con hidden-xs hidden-sm"><i class="glyphicons glyphicons-group"></i> MY RECIPIENTS</h2>
                 <div class="margin-left15 margin-bottom30"><a href="addRecipient" class="btn-green3 text-center"><strong>ADD NEW RECIPIENT</strong></button></a></div>
                 
               <?php if (isset($_REQUEST['done'])) { ?>
              <div style="color:#060" align="center"><strong>Action Completed: <?php echo $common->get_prep($_REQUEST['done']); ?></strong></div>
               <?php } ?>
               <?php if (isset($_REQUEST['error'])) { ?>
              <div style="color:#F00" align="center"><strong><?php echo $common->get_prep($_REQUEST['error']); ?></strong></div>
              <?php } ?>
                 <table class="table view-recipients dataTable">
                    <thead>
                      <tr>
                        <th valign="middle" width="208" nowrap="" class="text-center" align="left" >ACCOUNT NAME</th>
                        <th valign="middle" width="200" nowrap="" class="text-center" align="left" >BANK</th>
                        <th valign="middle" width="10" nowrap="" class="text-center" align="left" >ACCOUNT NUMBER</th>
                        <th valign="middle" width="10" nowrap="" class="text-center" align="center" >CREATED</th>
                      	<th class="white">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php for ($i = 0; $i < count($list); $i++) { ?>
                      <tr>
                        <td><?php echo $list[$i]['account_name']; ?></td>
                        <td><?php echo $bank->getOneField($list[$i]['bank']); ?></td>
                        <td><?php echo $list[$i]['account_number']; ?></td>
                        <td><?php echo $common->get_time_stamp($list[$i]['create_time']); ?></td>
                        <td class="view-bg"><a href="viewRecipiets?id=<?php echo $list[$i]['ref']; ?>" class="btn-link btn-xs btn" type="button">View</a> | <a href="?remove&id=<?php echo $list[$i]['ref']; ?>" onClick="return confirm('do you really want to remove this recipient?\n\nRemoving this user will remove this account from your recipient list but previous transactions to this recipients will continue to be available')">Delete</a></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
             </div>
           </div>
         <!--/MY PROFILE-->
         
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
              	<a href="sendMoney" class="money-box"> <span class="glyphicons glyphicons-credit-card font-size45"></span><span class="margin-top15 all-icon-box">Send Money</span> </a> 
                <a href="send-mobile-airtime.php" class="send-mobile-box"> <span><img src="images/mobile-phone-icon.png" height="44"></span><span class="margin-top15 all-icon-box">Send  Mobile Airtime</span> </a> 
                <a href="pay-bills.php"class="pay-bills-box"> <span><img src="images/bill.png" width="37" height="auto"></span><span class="margin-top15 all-icon-box">Pay Bills</span> </a> 
                <a href="myPayments" class="payments-box"> <span class="glyphicons glyphicons-circle-arrow-right small-payments-text"></span><span class="margin-top15 all-icon-box">My Payments</span> </a> 
                <a href="profile" class="profile-box"> <span class="glyphicons glyphicons-user font-size45"></span><span class="margin-top15 all-icon-box">My Profile</span> </a> 
                <a href="myRecipientList"class="recipients-box active"> <span class="glyphicons glyphicons-group small-payments-text"></span><span class="margin-top15 all-icon-box">My Recipients</span> </a> 
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