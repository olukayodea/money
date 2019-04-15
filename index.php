<!DOCTYPE html>
<html lang="en">
<head>

    <!--  == meta tag ==  -->
    <meta charset="UTF-8">
    <meta name="Designer" content="Mahmud Hasan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>PayMach</title>
    <link rel="shortcut icon" href="images/Preload.gif">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
    <section id="main_header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                  <h1 class="wow shake"><img src="images/logo.png" width="218" height="243"></h1>
                  <h2 class="wow shake">Smart and Secured<br>
                    <br>
                    The easiest way to accept, process and disburse digital<br>
                  payments for businesses in the world. Sign up now to simplify your<br>business.</h2>
                    
                    <div id="from-panel">
                        <div class="form-horizontal banner-right-con">
                            <div id="status" style="color:#F00"></div>
                          <div class="form-group">
                            <label for="service" class="col-xs-3 control-label text-center paddingTop0">Select Servicee</label>
                            <div class="col-xs-6">
                              <select name="service" id="service" class="form-control" style="width:100%" onChange="selectService()">
                                <option value="none">Select a Service</option>
                                <option value="Airtime">Send Airtime</option>
                                <option value="Money">Send Money</option>
                                <option value="Bills">Pay Bills</option>
                              </select>
                            </div>
                          </div>
                          <div id="payBills" style="display:none"></div>
                          <div id="sendAirtime" style="display:none"></div>
                          <div id="sendMoney" style="display:none">
                              <div class="form-group">
                                <label class="col-xs-3 control-label text-center paddingTop0">I want to <br>
                                  send</label>
                                <div class="col-xs-6">
                                  <input type="text" name="amount" id="amount" class="form-control" onChange="calculateCharges()">
                                </div>
                                <div class="col-xs-3 dark padding-left0">
                                  <select name="send_currency" id="send_currency" class="country-select" style="width:100%" onChange="calculateCharges()">
                                   <option value="CA">CAD</option>
                                   <option value="CN">CNY</option>
                                    <option value="US">USD</option>
                                    <option value="GB" selected>GBP</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-3 control-label text-center">To</label>
                                <div class="col-xs-6">
                                  <select name="dest_country" id="dest_country" class="country-select" style="width:100%">
                                   <option value="CA">Canada</option>
                                   <option value="CN">China</option>
                                    <option selected value="NG">Nigeria</option>
                                    <option value="US">United States</option>
                                    <option value="GB" selected>United Kingdom</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group margin-bottom0">
                                <label class="col-xs-3 control-label text-center">Our Fees</label>
                                <div class="col-xs-6">
                                  <input readonly type="text" name="fee" id="fee" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-3"></div>
                                <div class="col-xs-9">
                                    <input type="checkbox" name="dectt_fee" value="true" id="dectt_fee" onChange="calculateCharges()" onclick="calculateCharges()">
                                    <label for="dectt_fee"><small>Deduct fees from send amount</small></label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-3 control-label text-center paddingTop0">Total to <br>
                                  Pay</label>
                                <div class="col-xs-6">
                                  <input readonly type="text" name="total_pay" id="total_pay" class="form-control">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-3 control-label text-center paddingTop0">Recipient Receives</label>
                                <div class="col-xs-6">
                                  <input type="text" name="rec_amount" id="rec_amount" value="" class="form-control" readonly>
                                </div>
                                <div class="col-xs-3 dark padding-left0">
                                  <select name="s2" class="country-select" style="width:100%">
                                    <option selected value="NG">NGN</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-3 control-label text-center paddingTop0">Receives <br>
                                  by</label>
                                <div class="col-xs-6">
                                  <select class="single-select" name="rec_medium" id="rec_medium" style="width:100%">
                                    <option value="access">Bank Transfer</option>
                                  </select>
                                  <span class="margin-top4 font-size11 margin-left10" id="conversionRate"></span></div>
                                  
                              </div>
                              <div class="form-group">
                                <!--<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3 text-center"> <a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-green btn-block send-btn">Send Now</a> </div>-->
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3 text-center"> <a href="#" onClick="sendMoney()" style="display:block" class="btn btn-green btn-block send-btn">Send Now</a> </div>
                              </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Background Part HTML ends  -->
    <section id="payment">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 wow zoomInDown">
                    <h3>Payment processing<br> solutions that save you<br> time and money</h3>
                    <p>PayMack is simple, smart business solution that helps you get paid,<br> make payments, and manage your money.</p>
                    <a href="#">Get started</a>
                </div>
            </div>
        </div>
    </section>

    <!--  Payment Part HTML ends  -->
    <section id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 wow zoomIn">
                    <h4>Simple pricing for you, convenient payment options for your customers</h4>
                </div>
                <div class="col-md-12 pricing_icon col-xs-12">
                    <div class="col-md-4 col-xs-12 text-center price_hvr wow slideInLeft">
                        <img src="images/Icon-1.png" class="img-responsive" alt="">
                        <h2>One place, multiple resources</h2>
                        <p>Our unique business model caters businesses<br> of all sizes as a service provider, though<br>innovation, and though partnerships.</p>
                    </div>
                    <div class="col-md-4 col-xs-12 text-center price_hvr wow zoomIn">
                        <img src="images/Icon-2.png" class="img-responsive" alt="">
                        <h2>Intergrated payment<br>processing</h2>
                        <p>Keep the funds flowing easily with convenient<br>payment processing options and integrations<br>with Sage accounting products.</p>
                    </div>
                    <div class="col-md-4 col-xs-12 text-center price_hvr wow slideInRight">
                        <img src="images/Icon-3.png" class="img-responsive" alt="">
                        <h2>Scalable solutions for<br>developers and ISVs</h2>
                        <p>APIs that pair technology so you can deliver the<br>experience your customers want while staying<br>on the edge of innovation.</p>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 text-center">
                    <a href="#">Learn more</a>
                </div>
            </div>
        </div>
    </section>
    <!--  Pricing Part HTML ends  -->
    <section id="work">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-6 wow zoomIn">
                    <h2>Together,we work.Get<br>paid faster with ecopy<br>and create custom<br>solutions automatic<br>payment reconciliation.</h2>
                </div>
                <div class="col-md-6 col-xs-6 wow zoomIn">
                    <h3>We help you drive lasting customer<br>relationships and enable you to run<br>ypur business smarter, so you can><br>run it better.</h3>
                    <a href="#">Learn more</a>
                </div>
            </div>
        </div>
    </section>
    <!--  Work Part HTML ends  -->
    <section id="methods">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-6 wow slideInLeft">
                    <h2>Payment methods</h2>
                    <p>As a merchant, it is essential that you accept the<br>methods of payment that your target customers<br>prefer to use.<br><br> PayMack enables your system to accept a wide range<br>of payment methods, including credit card, bank<br>transfer PayMack is Nigerian based payment<br>gateway which serves many countries across the<br>world.</p>
                </div>
                <div class="col-md-6 col-xs-6 text-center wow rotateInDownLeft">
                    <img src="images/images.png" class="img-responsive" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--  Methods Part HTML ends  -->
    <section id="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                    <h3>Features That Drive Business Forword</h3>
                </div>
                <div class="col-md-3 col-xs-6 wow zoomIn">
                    <div class="div_back1">
                        <img src="images/Icon-8.png" class="img-responsive" alt="">
                        <h4>Large Global<br>Reach</h4>
                        <ul>
                            <li>Multi Payments</li>
                            <li>Multi Languages</li>
                            <li>Multi Currency Options</li>
                            <li>Convering Global Markets</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6 wow zoomIn">
                    <div class="div_back2">
                        <img src="images/Icon-9.png" class="img-responsive" alt="">
                        <h4>Customizable<br>Checkout</h4>
                        <ul>
                            <li>Mobile-friendly experience</li>
                            <li>Branded to match your<br>website</li>
                            <li>Localized checkout</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6 wow zoomIn" Data-wow-duration="2">
                    <div class="div_back3">
                        <img src="images/Icon-10.png" class="img-responsive" alt="">
                        <h4>Advanced<br>Security</h4>
                        <ul>
                            <li>Minimized risk</li>
                            <li>Multi fraud rules per<br>transaction</li>
                            <li>Higher PCI compliance</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6 wow zoomIn">
                    <div class="div_back">
                        <img src="images/Icon-11.png" class="img-responsive" alt="">
                        <h4>Simple<br>Integration</h4>
                        <ul>
                            <li>Extensive documentation</li>
                            <li>User Friendly</li>
                            <li>Easy to Use</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Feature Part HTML ends  -->
    <section id="experince">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center wow fadeIn">
                    <h3>Create your payment experince with PayMack</h3>
                    <h4>Trusted by many Business only payments. We're here to help you innovate and grow.</h4>
                </div>
                <div class="col-md-3 col-xs-6 text-center txt_hvr_bdr txt_hvr wow flipInX">
                    <img src="images/Icon-4.png" class="img-responsive" alt="Icon">
                    <h1>Experience</h1>
                    <p>Nigeria based Payment Gateway</p>
                </div>
                <div class="col-md-3 col-xs-6 text-center txt_hvr_bdr txt_hvr wow flipInX">
                    <img src="images/Icon-5.png" class="img-responsive" alt="Icon">
                    <h1>Smart & simple</h1>
                    <p>A scalable, all in one solution<br> thal makes life easy</p>
                </div>
                <div class="col-md-3 col-xs-6 text-center txt_hvr_bdr1 txt_hvr wow flipInX">
                    <img src="images/Icon-6.png" class="img-responsive" alt="Icon">
                    <h1>Trusted & secure</h1>
                    <p>Extra layers of security and<br>PCI compliance, so you can<br>get on with business</p>
                </div>
                <div class="col-md-3 col-xs-6 text-center txt_hvr_bdr1 txt_hvr wow flipInX">
                    <img src="images/Icon-7.png" class="img-responsive" alt="Icon">
                    <h1>Local support</h1>
                    <p>Dedicated local team that's<br>on hand to help</p>
                </div>
            </div>
        </div>
    </section>
    <!--  Experince Part HTML ends  -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-6 footer_item wow slideInLeft">
                    <ul>
                        <li class="ftr_head"><a href="#">Services</a></li>
                        <li><a href="#">Check Elimination</a></li>
                        <li><a href="#">PayMack</a></li>
                        <li><a href="#">eCommerce</a></li>
                        <li><a href="#">Financial Institutions</a></li>
                        <li><a href="#">Private Clients</a></li>
                        <li><a href="#">The Hedging Process</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-6 footer_item wow slideInLeft">
                    <ul>
                        <li class="ftr_head"><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Industry Solutions</a></li>
                        <li><a href="#">Leadership Team</a></li>
                        <li><a href="#">Awards</a></li><br>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-6 footer_item wow slideInRight">
                    <ul>
                        <li class="ftr_head"><a href="#">News Center</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Newsletters</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">News</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-6 footer_icon wow slideInRight">
                    <ul>
                        <li class="ftr_head"><a href="#">Follow Us</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i>Twitter</a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i>Linkedin</a></li>
                        <li><a href="#"><i class="fab fa-vimeo"></i>Vimeo</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </footer>
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

<!--Model login-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content model-box">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="padding-top15 font-size20"> <span class="text-sky">Log in to your PayMack Account</span></div>
      </div>
      <div class="modal-body form-horizontal">
        <div class="padding-left-right15" id="notificationDialogue" style="color:#F00; display:none" align="center"></div>
        <div class="padding-left-right15">
        	<input name="redirect" id="redirect" type="hidden" value="<?php echo $redirect; ?>">
          <input type="email" name="email" id="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" class="form-control">
        </div>
        <div class="padding-left-right15 margin-top15">
          <input type="password" name="password" id="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="form-control">
        </div>
         <div class="row margin-top30">
           <p class="continue-btn">
             <a class="btn-green1" href="Javascript:void(0)" onClick="login()" id="login_button">LOG IN</a>
           </p>
         </div>
        <div class="forgotten-password"><a href="#" data-dismiss="modal" data-target="#myModal5" data-toggle="modal">Forgotten your password?</a> </div>
        <p class="text-center font-size14 margin-top20">Don’t have an Account? <a href="#" class="text-red" data-dismiss="modal" data-target="#myModal2" data-toggle="modal"><strong>Sign up</strong></a></p>
      </div>
    </div>
  </div>
</div>
<!--Model login-->

<!--Model singup-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  model-box">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="padding-top15 font-size20"> <span class="text-sky">Create an Account with PayMack</span></div>
      </div>
		<input name="redirect" id="redirect2" type="hidden" value="<?php echo $redirect; ?>">
      <div class="modal-body form-horizontal">
        <div class="padding-left-right15" id="notificationDialogue2" style="color:#F00; display:none" align="center"></div>
        <!-- <div class="padding-left-right15">
          <input type="text" name="fullNames" id="fullNames" placeholder="Full Names" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full Names'" class="form-control">
        </div> -->
        <div class="padding-left-right15 margin-top15">
          <input type="text" name="createEmail" id="createEmail" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" class="form-control" onChange="checkEmail(this.value)">
        </div>
        <div class="padding-left-right15 margin-top15">
          <input type="password" name="newPassword" id="newPassword" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" class="form-control">
        </div>
        <div class="padding-left-right15 margin-top15">
          <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'"  class="form-control">
        </div>
        <p class="text-center font-size11 margin-top15">By signing up, you are agreeing to PayMack’s <br>
          <a class="margin-right5" href="terms-conditions.php" target="_blank"><u>Terms and Conditions</u></a> and <a class="margin-left5" href="privacy-policy.php" target="_blank"><u>Privacy Policy</u></a></p>
        <!--<div class="text-center"> <a href="registration.html" class="btn btn-red btn-signup" type="button">SIGN UP</a> </div>-->
        <div class="row margin-top30">
           <p class="continue-btn">
             <a class="btn-red1" href="Javascript:void(0)" onClick="register()" id="register_button">SIGN UP</a>
           </p>
         </div>
        
        <p class="text-center font-size14 margin-top4">Already have an account? <a href="#" class="text-green" data-toggle="modal" data-target="#myModal" data-dismiss="modal"><strong>Log in</strong></a></p>
      </div>
    </div>
  </div>
</div>
<!--Model singup--> 

<!--Model Forgotten your password-->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content model-box">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="padding-top15 font-size20"> <span class="text-sky">Reset Your PayMack Password</span></div>
         <p class="forgotten-text">Enter the email address you registered with and we will send <br>you an email with a link to reset your password </p>
      </div>
		<input name="redirect" id="redirect3" type="hidden" value="<?php echo $redirect; ?>">
        
        <div class="padding-left-right15" id="notificationDialogue3" style="color:#F00; display:none" align="center"></div>
        <div class="padding-left-right15" id="notificationDialogue4" style="color:#060; display:none" align="center"></div>
      <div class="modal-body form-horizontal modal-box">
        <div class="padding-left-right15">
          <input name="forgotPassword" id="forgotPassword" type="text" placeholder="Enter your email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email address'" class="form-control">
        </div>
        <div class="send-email"> <a href="Javascript:void(0)" onClick="remeberPassword()" class="btn btn-green btn-login2" type="button">SEND EMAIL</a> </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

