<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Manage Recipients</title>
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
         <!--MY PROFILE-->
           <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
             <div class="white-bg">
                <h2 class="header recipients-con hidden-xs hidden-sm"><i class="glyphicons glyphicons-group"></i> <?php if (isset($_REQUEST['edit'])) { ?>EDIT<?php } else { ?>ADD NEW<?php } ?> RECIPIENT</h2>
                 <div class="form-horizontal">
                 <div class="row margin-top20 choose-box">
                   <div class="col-xs-12 margin-left20">
                     <h5 class="margin-bottom20">Bank Account Details</h5>
                       <div class="form-group">
                         <div class="col-xs-3 text-center">
                         <label for="account_number" class="control-label paddingTop0">Enter Recipient’s  Account Number</label>
                         </div>
                         <input type="hidden" name="user" id="user" value="<?php echo $ref; ?>">
                         <input name="recipient" type="hidden" id="recipient" value="-1">
                         <input type="hidden" name="checkEdit" id="checkEdit" value="<?php echo $checkEdit; ?>">
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                          <input type="text" placeholder="NUBAN Account Number" class="form-control" id="account_number" name="account_number" maxlength="10" value="<?php echo $data['account_number']; ?>">
                        </div>
                        <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                      </div>
                     <div class="form-group margin-top24">
                          <div class="col-xs-3 text-center">
                          <label for="bank" class="control-label paddingTop0">Select Recipient’s <br>Bank </label>
                        </div>
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                            <div id="showBank"><select class="single-select" style="width:100%" id="bank" name="bank">
                                <option value="0">Select</option>
                                <?php for ($i = 0; $i < count($bank_list); $i++) { ?>
                                <option<?php if ($data['bank'] == $bank_list[$i]['ref']) { ?> selected<?php } ?> value="<?php echo $bank_list[$i]['ref']; ?>"><?php echo $bank_list[$i]['bank_name']; ?></option>
                                <?php } ?>
                            </select></div>
                       </div>
                        <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                     </div>
                       <div class="form-group margin-top24">
                          <div class="continue-btn">
                            <a href="Javascript:void(0)" onClick="verifyName()" id="get_details_Button" class="btn-red" style="text-decoration:none">Get Recipient's Name</a>
                          </div>
                        </div>
                       <div class="form-group margin-top24">
                        <div class="col-xs-3 text-center">
                         <label for="account_name" class="control-label">Account Name</label>
                         </div>
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                          <input type="text" name="account_name" id="account_name" class="form-control" value="<?php echo $data['account_name']; ?>" placeholder="Account Name" readonly>
                        </div>
                        <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                     </div> 
                        <div class="form-group margin-top24">
                        <div class="col-xs-3 text-center">
                         <label for="phone" class="control-label paddingTop0">Recipient’s  Mobile Number</label>
                         </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                          <input id="phone2" name="phone2" type="number" value="<?php echo $telphone[0]; ?>" maxlength="3" class="form-control" placeholder="code">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <input id="phone" name="phone" type="number" class="form-control" maxlength="10" placeholder="Recipient’s  Mobile Number" value="<?php echo $telphone[1]; ?>">
                        </div>
                        <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                      </div>
                       <div class="form-group margin-top24">
                        <div class="col-xs-3 text-center">
                         <label for="email" class="control-label paddingTop0">Recipient’s  Email Address</label>
                         </div>
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                          <input type="text" name="email" id="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Recipient’s  Email Address">
                        </div>
                      </div>
                         <div class="col-xs-10 col-sm-12 col-md-12 col-lg-12 margin-top30 continue-btn">
                          <a href="myRecipientList" class="btn-gray">Back</a>
                          
                          <a href="Javascript:void(0)" id="submit_button" style="display:inline" onClick="postToSystem2()" class="btn-sky margin-left18">Save</a>
                       </div>
                        
                       </div>
                    </div>
                 </div>
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