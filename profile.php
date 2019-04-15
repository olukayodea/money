<?php
	$redirect = "profile";
	include_once("includes/functions.php");
	include_once("includes/session.php");
	 
	if ((isset($_REQUEST['redirect'])) && ($_REQUEST['redirect'] != "")) {
		$postBack = $_REQUEST['redirect'];
	} else {
		$postBack = $redirect;
	}
	
	if (isset($_POST['button'])) {
		$update = $users->update($_POST);
		
		if ($update) {
			if ($accountStatus == "NEW") {
				$users->modifyOne("status", "ACTIVE", $ref);
				$_SESSION['users']['email'] = $common->mysql_prep($_POST['email']);
				$_SESSION['users']['last_name'] = $common->mysql_prep($_POST['last_name']);
				$_SESSION['users']['other_names'] = $common->mysql_prep($_POST['other_names']);
				$_SESSION['users']['phone'] = $common->mysql_prep($_POST['phone']);
				$_SESSION['users']['status'] = "ACTIVE";
			}
			header("location: ".$postBack);
		} else {
			header("location: ".$redirect."?error&".urlencode($postBack));
		}
	}
	
	$data = $users->listOne($ref, "ref");
	$telphone = explode("-", $data['phone']);
?>
<!doctype html>
<html>
<head>
    <!--  == meta tag ==  -->
    <meta charset="UTF-8">
    <meta name="Designer" content="Mahmud Hasan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>PayMach</title>
    <link rel="shortcut icon" href="images/Preload.gif">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="css/select2/select2.css" rel="stylesheet"/>
    <link href="css/jPushMenu.css" rel="stylesheet"/>
    <link href="css/datatables/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
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
            <form name="form1" id="form1" method="post" action="">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="main-body">
          <div class="white-bg">
			<?php if ($accountStatus == "NEW") { ?>
            <h2 class="header registration-box hidden-xs hidden-sm"><i class="glyphicons glyphicons-user"></i> REGISTRATION</h2>
            <p class="text-center font-size14">Welcome <strong><?php echo $last_name." ".$other_names; ?></strong> We need additional information from you to complete your registration. Please ensure your personal details match your Identification documents</p>
			<?php } else { ?>
            <h2 class="header voilet hidden-xs hidden-sm"><i class="glyphicons glyphicons-user"></i> MY PROFILE</h2>
			<?php } ?>
            <div class="form-horizontal">
              <div class="row margin-top30 choose-box">
                <div class="col-xs-12 margin-left20">
                  <div class="form-group">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">First Name</label>
                      <input type="hidden" name="redirect" id="redirect" value="<?php echo $postBack; ?>">
                      <input type="hidden" name="ref" id="ref" value="<?php echo $ref; ?>">
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield1">
                      <input type="text" id="other_names" name="other_names" value="<?php echo $data['other_names']; ?>" class="form-control" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Surname</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield2">
                      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $data['last_name']; ?>" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Email Address</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield3">
                      <input type="email" id="email" name="email" value="<?php echo trim($data['email']); ?>" readonly class="form-control" required>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label paddingTop0">Mobile Telephone <br>Number</label>
                    </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2"><span id="sprytextfield4">
                        <input id="phone2" name="phone2" type="text" value="<?php echo $telphone[0]; ?>" maxlength="3" class="form-control" placeholder="code"<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span id="sprytextfield10">
                    <input id="phone" name="phone" type="text" class="form-control" maxlength="10" placeholder="Recipient’s  Mobile Number" value="<?php echo $telphone[1]; ?>"<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Date of Birth </label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield9">
                      <input type="text" id="d_o_b" name="d_o_b" value="<?php echo $data['d_o_b']; ?>" class="form-control daterange" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Address Line 1</label>
                      <br>
                      <small class="font-size12">(or company name)</small> </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield5">
                      <input type="text" class="form-control" id="address_1" name="address_1" value="<?php echo $data['address_1']; ?>" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                      <span class="textfieldRequiredMsg">A value is required.</span></span>
                      <p class="font-size12">House name/number and street, P.O. box, company name, c/o </p>
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Address Line 2</label>
                      <br>
                      <small class="font-size12">(optional)</small> </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo $data['address_2']; ?>"<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                      <p class="font-size12">Apartment, suite, unit, building, floor, etc. </p>
                    </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Town / City</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield6">
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $data['city']; ?>" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">County</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield7">
                      <input type="text" class="form-control" id="state" name="state" value="<?php echo $data['state']; ?>" required<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Post Code</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6"><span id="sprytextfield8">
                      <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $data['post_code']; ?>"<?php if ($accountStatus != "NEW") { ?> readonly<?php } ?>>
                    <span class="textfieldRequiredMsg">A value is required.</span></span></div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <div class="form-group margin-top24">
                    <div class="col-xs-3 text-center">
                      <label class="control-label">Country</label>
                    </div>
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                      <select class="country-select" id="country" name="country" style="width:100%" required<?php if ($accountStatus != "NEW") { ?> disabled<?php } ?>>
                        <option value="CA">Canada</option>
                        <option value="GB">United Kingdom</option>
                        <option value="US">United States</option>
                      </select>
                    </div>
                    <div class="pull-left margin-top10"> <span class="text-red">*</span> </div>
                  </div>
                  <p class="text-center font-size14 margin-top30">Please <a href="contact-us" style="text-decoration:underline">contact our customer service team</a> if you wish to change any of the details on your profile or if you wish to delete your account. </p>
                  <!--<div class="form-group">
                    <div class="col-xs-4 col-xs-offset-4 text-center margin-top20"> <a href="sendMoney" class="btn-sky text-center btn-block">SAVE</a> </div>
                  </div>-->
                  <?php if ($accountStatus == "NEW") { ?>
                  <div class="row margin-top30">
                     <p class="continue-btn">
                      <input class="btn-sky" type="submit" name="button" id="button" value="Submit">
                     </p>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
            </form>
        <!--/REGISTRATION--> 
        
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
                <a href="profile" class="profile-box active"> <span class="glyphicons glyphicons-user font-size45"></span><span class="margin-top15 all-icon-box">My Profile</span> </a> 
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

<script type="text/javascript">
function setSelectedIndex(s, valsearch) {
		// Loop through all the items in drop down list
		for (i = 0; i< s.options.length; i++) { 
			if (s.options[i].value == valsearch) {
			// Item is found. Set its property and exit
			s.options[i].selected = true;
			break;
			}
		}
		return;
	}
	
	function setMultiSelectedIndex(s, data) {
		var main = data.split(",");
		// Loop through all the items in drop down list
		for (var j = 0; j < main.length; j++) {
			var opt = main[j];
			for (i = 0; i< s.options.length; i++) { 
				if (s.options[i].value == opt) {
				// Item is found. Set its property and exit
				s.options[i].selected = true;
				break;
				}
			}
		}
		return;
	}
	
	$(document).ready(function() {
		setSelectedIndex(document.getElementById("country"),"<?php echo $data['country']; ?>");
	});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "integer");
</script>
</body>
</html>