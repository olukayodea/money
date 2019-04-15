$(document).ready(function(){
        new WOW().init();
    // animation wow js
    // start code here
    
	// Initiating daterangePicker
	
	
	if($('input.daterange').length > 0){
		$('input.daterange').daterangepicker({
				
				singleDatePicker: true,
				showDropdowns: true,
				//autoApply:true,
				//autoUpdateInput:false,
				drops:'down',
				locale: {
						initialText : 'Select period...',
						format: 'MMMM D, YYYY'
				}
		}); 
	}
	
	var sidebarHeight = $('#sidebar .white-bg').outerHeight();
	var mainBodyHeight = $('#main-body .white-bg').outerHeight();
	if(sidebarHeight>=mainBodyHeight){
		$('#main-body .white-bg').css({'min-height':sidebarHeight});
		$('#sidebar .white-bg').css({'min-height':sidebarHeight});
	}else{
		$('#sidebar .white-bg').css({'min-height':mainBodyHeight});
		$('#main-body .white-bg').css({'min-height':mainBodyHeight});
	}
	
	function formatState (state) {
		if (!state.id) { return state.text; }
		var $state = $(
			'<span><img src="images/flags/' + state.element.value.toLowerCase() + '.gif" class="img-flag" /> ' + state.text + '</span>'
		);
		return $state;
	};
	if($('.country-select').length > 0){ 
		$(".country-select").select2({
			templateResult: formatState,
			templateSelection: formatState
		});
	}
	function formatMobile (mobile) {
		if (!mobile.id) { return mobile.text; }
		var $mobile = $(
			'<span><img src="images/mobile/' + mobile.element.value.toLowerCase() + '.png" class="img-flag" /> ' + mobile.text + '</span>'
		);
		return $mobile;
	};
	if($('.mobile-select').length > 0){ 
		$(".mobile-select").select2({
			templateResult: formatMobile,
			templateSelection: formatMobile
		});
	}
	$('#btn-list,#btn-list2,#btn-list3').popover({ html: true, container: 'body'});
	
	$(".single-select").select2();
	
	$('.carousel').carousel({interval: false});
	
	if($('.dataTable').length > 0){
		$('#my-payments-tables,.view-recipients').DataTable({
			 responsive: true	
		});	
	}
	
	$('.toggle-menu').jPushMenu({
		pushBodyClass      : 'push-body',
		showLeftClass      : 'menu-left',
		showRightClass     : 'menu-right',
		showTopClass       : 'menu-top',
		showBottomClass    : 'menu-bottom',
		activeClass        : 'menu-active',
		menuOpenClass      : 'menu-sidebar-open',
		closeOnClickOutside: true,
		closeOnClickLink   : true	
	});
	
	if($('.menu-sidebar-open').length > 0){
		alert(0)
	}
	
	
});

function register() {
	//document.getElementById('fullNames').removeAttribute("style");
	document.getElementById('newPassword').removeAttribute("style");
	document.getElementById('createEmail').removeAttribute("style");
	document.getElementById('confirmPassword').removeAttribute("style");
	
	var redirect = document.getElementById('redirect2').value;
	document.getElementById('notificationDialogue2').style.display = 'none';
	document.getElementById('register_button').style.display = 'none';
	
	//var fullNames = document.getElementById('fullNames').value;
	var createEmail = document.getElementById('createEmail').value;
	var newPassword = document.getElementById('newPassword').value;
	var confirmPassword = document.getElementById('confirmPassword').value;
	var confirmEmail = validateEmail(createEmail);
	
	//var names = fullNames.split(" ");
	//var lengt = names.length;
	//var last_name = names[0];
	//var other_names = "";
	//for (var i = 1; i < lengt; i++) {
	//	other_names = other_names+" "+names[i];
	//}
	
	//if ((last_name === undefined) || (last_name == "")) {
	//	document.getElementById('register_button').style.display = 'inline';
		//document.getElementById('notificationDialogue2').style.display = 'block';
		//document.getElementById('fullNames').focus();
		//document.getElementById('notificationDialogue2').innerHTML='Please enter your last name and othernames';
		//document.getElementById('fullNames').setAttribute("style", "border: 1px solid #FF9F9F;");
	//} else if ((other_names === undefined) || (other_names == "")) {
		//document.getElementById('register_button').style.display = 'inline';
		//document.getElementById('notificationDialogue2').style.display = 'block';
		//document.getElementById('fullNames').focus();
		//document.getElementById('notificationDialogue2').innerHTML='Please enter your other names';
		//document.getElementById('fullNames').setAttribute("style", "border: 1px solid #FF9F9F;");
	//} else
	if (confirmEmail == false) {
		document.getElementById('register_button').style.display = 'inline';
		document.getElementById('notificationDialogue2').style.display = 'block';
		document.getElementById('createEmail').focus();
		document.getElementById('notificationDialogue2').innerHTML='Please enter a valid email address';
		document.getElementById('createEmail').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else 	if ((newPassword === undefined) || (newPassword == "")) {
		document.getElementById('register_button').style.display = 'inline';
		document.getElementById('notificationDialogue2').style.display = 'block';
		document.getElementById('newPassword').focus();
		document.getElementById('notificationDialogue2').innerHTML='Please enter a password';
		document.getElementById('newPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else 	if (validatePAssword === false) {
		document.getElementById('register_button').style.display = 'inline';
		document.getElementById('notificationDialogue2').style.display = 'block';
		document.getElementById('newPassword').focus();
		document.getElementById('notificationDialogue2').innerHTML='Please enter a valid password, Password must contain more than 8 characters';
		document.getElementById('newPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else 	if ((confirmEmail === undefined) || (confirmEmail == "")) {
		document.getElementById('register_button').style.display = 'inline';
		document.getElementById('notificationDialogue2').style.display = 'block';
		document.getElementById('confirmEmail').focus();
		document.getElementById('notificationDialogue2').innerHTML='Please enter your password again';
		document.getElementById('confirmEmail').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (newPassword != confirmPassword) {
		document.getElementById('register_button').style.display = 'inline';
		document.getElementById('notificationDialogue2').style.display = 'block';
		document.getElementById('newPassword').focus();
		document.getElementById('notificationDialogue2').innerHTML='Password mis-match';
		document.getElementById('newPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
		document.getElementById('confirmPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/register.php", { email: createEmail, password: newPassword })
		.done(function(data) {
			alert(data);
			if (data > 0) {
				window.location='profile?redirect='+redirect;
			} else {
				document.getElementById('register_button').style.display = 'inline';
				document.getElementById('notificationDialogue2').style.display = 'block';
				document.getElementById('notificationDialogue2').innerHTML='Registration failed, checks confirm duplicate email address on our records';
			}
		})
		.fail(function(data) {
			document.getElementById('register_button').style.display = 'inline';
			document.getElementById('notificationDialogue2').style.display = 'block';
			document.getElementById('notificationDialogue2').innerHTML='Registration failed, please contact the admiinstrator';
		});
	}
	
}

function login(redirectLink) {
	document.getElementById('email').removeAttribute("style");
	document.getElementById('password').removeAttribute("style");
	
	var redirect = document.getElementById('redirect').value;
	document.getElementById('notificationDialogue').style.display = 'none';
	document.getElementById('login_button').style.display = 'none';
	
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	var confirmEmail = validateEmail(email);
	
	if (confirmEmail == false) {
		document.getElementById('login_button').style.display = 'inline';
		document.getElementById('notificationDialogue').style.display = 'block';
		document.getElementById('email').focus();
		document.getElementById('notificationDialogue').innerHTML='Please enter a valid email address';
		document.getElementById('email').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (password == "") {
		document.getElementById('login_button').style.display = 'inline';
		document.getElementById('notificationDialogue').style.display = 'block';
		document.getElementById('password').focus();
		document.getElementById('notificationDialogue').innerHTML='Please enter your password';
		document.getElementById('password').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/login.php", { password: password, email: email })
		.done(function( data ) {
			if (data == 2) {
				window.location=redirect;
			} else if (data == 1) {
				window.location='profile?redirect='+redirect;
			} else if (data == 0) {
				document.getElementById('login_button').style.display = 'inline';
				document.getElementById('notificationDialogue').style.display = 'block';
				document.getElementById('notificationDialogue').innerHTML='Login failed, please confirm user name and password';
			} else if (data == 3) {
				document.getElementById('login_button').style.display = 'inline';
				document.getElementById('notificationDialogue').style.display = 'block';
				document.getElementById('notificationDialogue').innerHTML='Login failed, your account has been disabled by the administrator, please contact the administrator';
			} else {
				document.getElementById('login_button').style.display = 'inline';
				document.getElementById('notificationDialogue').style.display = 'block';
				document.getElementById('notificationDialogue').innerHTML='Login failed, please contact the admiinstrator';
			}
		})
		.fail(function(data) {
			document.getElementById('login_button').style.display = 'inline';
			document.getElementById('notificationDialogue').style.display = 'block';
			document.getElementById('notificationDialogue').innerHTML='Login failed, please contact the admiinstrator';
		});;
	}
}

function sendMoney() {
	var amount = document.getElementById('amount').value;
	var send_currency = document.getElementById('send_currency').value;
	var dest_country = document.getElementById('dest_country').value;
	var fee = document.getElementById('fee').value;
	var dest_country = document.getElementById('dest_country').value;
	var dectt_fee = document.getElementById('dectt_fee').value;
	var total_pay = document.getElementById('total_pay').value;
	var dectt_fee = document.getElementById('dectt_fee').value;
	var rec_amount = document.getElementById('rec_amount').value;
	var rec_medium = document.getElementById('rec_medium').value;
	
	if ((amount == "") || (isNaN(parseInt(amount)) == true)) {
		document.getElementById('amount').focus();
		document.getElementById('status').innerHTML='Please enter a valid amount';
		document.getElementById('amount').setAttribute("style", "border: 1px solid #FF9F9F;");
		return false;
	} else {
		if (calculateCharges()) {
			document.getElementById('redirect').value = "sendMoney";
			document.getElementById('redirect2').value = "sendMoney";
			document.getElementById('redirect3').value = "sendMoney";
			if (getCookie("login_status")) {
				window.location = 'sendMoney';
			} else {
				$("#myModal").modal();
			}
		} else {
			return false;
		}
	}
}

function calculateCharges() {
	document.getElementById('status').innerHTML='';
	document.getElementById('amount').removeAttribute("style");
	var amount = document.getElementById('amount').value;
	var send_currency = document.getElementById('send_currency').value;
	var dectt_fee = document.getElementById('dectt_fee').value;
	var checkBox = document.getElementById("dectt_fee");
	
	if (checkBox.checked == true){
		var dectt_fee = "true";
	} else {
		var dectt_fee = "false";
	}
	
	if ((amount == "") || (isNaN(parseInt(amount)) == true)) {
		document.getElementById('amount').focus();
		document.getElementById('status').innerHTML='Please enter a valid amount';
		document.getElementById('amount').setAttribute("style", "border: 1px solid #FF9F9F;");
		return false;
	} else {
		$.post( "includes/scripts/calculateCharge.php", { amount: amount, send_currency: send_currency, dectt_fee: dectt_fee })
		  .done(function( data ) {
			var result = data.split("_");
			document.getElementById('fee').value = result[0];
			document.getElementById('total_pay').value = result[1];
			document.getElementById('rec_amount').value = result[3];
			document.getElementById('conversionRate').innerHTML = "Exchange Rate: 1 "+send_currency+" = NGN "+ result[4];
		});
		return true;
	}
}

function selectService() {
	var servicce = document.getElementById('service').value
	if (servicce == "none") {
		document.getElementById('payBills').style.display = 'none';
		document.getElementById('sendAirtime').style.display = 'none';
		document.getElementById('sendMoney').style.display = 'none';
	} else if (servicce == "Airtime") {
		document.getElementById('payBills').style.display = 'none';
		document.getElementById('sendAirtime').style.display = 'block';
		document.getElementById('sendMoney').style.display = 'none';
	} else if (servicce == "Money") {
		document.getElementById('payBills').style.display = 'none';
		document.getElementById('sendAirtime').style.display = 'none';
		document.getElementById('sendMoney').style.display = 'block';
	} else if (servicce == "Bills") {
		document.getElementById('payBills').style.display = 'block';
		document.getElementById('sendAirtime').style.display = 'none';
		document.getElementById('sendMoney').style.display = 'none';
	}
}

function remeberPassword() {
	document.getElementById('notificationDialogue3').style.display = 'none';
	document.getElementById('notificationDialogue4').style.display = 'none';
	var forgotPassword = document.getElementById('forgotPassword').value;
	
	var confirmEmail = validateEmail(forgotPassword);
	
	if (confirmEmail == false) {
		document.getElementById('notificationDialogue3').style.display = 'block';
		document.getElementById('forgotPassword').focus();
		document.getElementById('notificationDialogue3').innerHTML='Please enter a valid email address';
		document.getElementById('forgotPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/password.php", { email: forgotPassword })
		.done(function( data ) {
			if (data == 1) {
				document.getElementById('notificationDialogue3').style.display = 'none';
				document.getElementById('notificationDialogue4').style.display = 'block';
				document.getElementById('notificationDialogue4').innerHTML='An email has been sent to '+forgotPassword+'. Please follow the instructions in the mail to reset your password';
				document.getElementById('forgotPassword').removeAttribute("style");
				document.getElementById('forgotPassword').value = "";
			} else {
				document.getElementById('notificationDialogue3').style.display = 'block';
				document.getElementById('notificationDialogue4').style.display = 'none';
				document.getElementById('forgotPassword').focus();
				document.getElementById('forgotPassword').setAttribute("style", "border: 1px solid #FF9F9F;");
				document.getElementById('notificationDialogue3').innerHTML='No trace of an account with email '+forgotPassword+' currently exists on our records, please confirm the email and try again';
			}
		})
		.fail(function(data) {
			document.getElementById('notificationDialogue').style.display = 'block';
			document.getElementById('notificationDialogue3').innerHTML='password reset failed, please contact the admiinstrator';
		});
		
	}
}

function validatePAssword(password) {
	var n = password.length;
	if (n >7) {
		return true;
	} else {
		return false;
	}
}

function validateEmail(email) {
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
		return false;
	} else {
		return true;
	}
}

function checkEmail(val) {
	var email = val;
	$.post("includes/scripts/checkAvailable.php", { val: email}, function(data) {
		alert(data);
		if (data > 1) {
			document.getElementById('register_button').style.display = 'none';
			document.getElementById('notificationDialogue2').style.display = 'block';
			document.getElementById('createEmail').focus();
			document.getElementById('notificationDialogue2').innerHTML='Traces of this account already exisit in our records, please confirm email address and login or change email address and try siging up again';
			document.getElementById('createEmail').setAttribute("style", "border: 1px solid #FF9F9F;");
		} else {
			document.getElementById('register_button').style.display = 'inline';
			document.getElementById('notificationDialogue2').style.display = 'none';
			document.getElementById('notificationDialogue2').innerHTML='';
			document.getElementById('createEmail').removeAttribute("style");
		}
	});
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

//select payment functions
function getPayist() {
	var recipient = document.getElementById('recipient').value;
	document.getElementById('submit_button').style.display = "none";
	
	document.getElementById('showBank').style.display = "inline";
	document.getElementById('bank').removeAttribute("disabled");
	document.getElementById('dummy').style.display = "none";
	document.getElementById('dummy').value = "";
	document.getElementById('bank2').value = "0";
	document.getElementById('get_details_Button').style.display = "inline";
	
	if (recipient > 0) {
		document.getElementById('recipientBasket').style.display = "block";
		document.getElementById('account_number').setAttribute("readonly", "readonly");
		document.getElementById('bank').removeAttribute("disabled");
		document.getElementById('phone2').setAttribute("readonly", "readonly");
		document.getElementById('phone').setAttribute("readonly", "readonly");
		document.getElementById('email').setAttribute("readonly", "readonly");
		document.getElementById('get_details_Button').style.display = "none";
		
		$.post( "includes/scripts/getData.php", { id: recipient })
		  .done(function( data ) {
			  if (data != "") {
				  var variables = data.split("#");
				  
				  document.getElementById('submit_button').style.display = "inline";
				  document.getElementById('account_number').value = variables[1];
				  document.getElementById('account_name').value = variables[2];
				  document.getElementById('phone2').value = variables[3];
				  document.getElementById('phone').value = variables[4];
				  document.getElementById('email').value = variables[5];
				  document.getElementById('showBank').style.display = "none";
				  document.getElementById('bank').setAttribute("disabled", "disabled");
				  document.getElementById('dummy').style.display = "inline";
				  document.getElementById('dummy').value = variables[6];
				  document.getElementById('bank2').value = variables[0];

			  } else {
				  document.getElementById('showBank').style.display = "inline";
				  document.getElementById('bank').removeAttribute("disabled");
				  document.getElementById('dummy').style.display = "none";
				  document.getElementById('dummy').value = "";
				  document.getElementById('bank2').value = "0";
				  alert("There was an error!!!\n\nThere was an error validating account details, please confirm supplied details and try again");
			  }
		});
		
		document.getElementById('recipientBasket').style.display = "block";
	} else if (recipient == -1) {
		document.getElementById('recipientBasket').style.display = "block";
		document.getElementById('account_number').removeAttribute("readonly");
		document.getElementById('phone2').removeAttribute("readonly");
		document.getElementById('phone').removeAttribute("readonly");
		document.getElementById('phone').removeAttribute("account_name");
		document.getElementById('email').removeAttribute("readonly");
		document.getElementById('account_number').value = "";
		document.getElementById('account_name').value = "";
		document.getElementById('phone2').value = "234";
		document.getElementById('phone').value = "";
		document.getElementById('email').value = "";
	} else if (recipient == 0) {
		document.getElementById('recipientBasket').style.display = "none";
	}
}

function verifyName() {
	document.getElementById('account_name').value = "";
	document.getElementById('account_number').removeAttribute("style");
	document.getElementById('bank').removeAttribute("style");
	var account_number = document.getElementById('account_number').value;
	var bank = document.getElementById('bank').value;
	if ((account_number == "") || (isNaN(parseInt(account_number)) == true) || (account_number.length != 10)) {
		alert("There was an error!!!\n\nPlease Confirm that account number is not left empty or it complies with the NUBAM acount number format");
		document.getElementById('account_number').focus();
		document.getElementById('account_number').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (bank == 0) {
		alert("There was an error!!!\n\nPlease Confirm that you have selected the right bank associated with this accunt");
		document.getElementById('bank').focus();
		document.getElementById('bank').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/validateName.php", { account_number: account_number, bank: bank })
		  .done(function( data ) {
			  if (data != "") {
				  document.getElementById('account_name').value = data;
				  document.getElementById('submit_button').style.display = "inline";
			  } else {
				  alert("There was an error!!!\n\nThere was an error validating account details, please confirm supplied details and try again");
			  }
		});
	}	
}

function postToSystem() {
	document.getElementById('account_number').removeAttribute("style");
	document.getElementById('bank').removeAttribute("style");
	document.getElementById('recipient').removeAttribute("style");
	document.getElementById('account_name').removeAttribute("style");
	document.getElementById('account_number').removeAttribute("style");
	document.getElementById('phone').removeAttribute("style");
	document.getElementById('phone2').removeAttribute("style");
	document.getElementById('email').removeAttribute("style");
	
	var user = document.getElementById('user').value;
	var recipient = document.getElementById('recipient').value;
	var account_number = document.getElementById('account_number').value;
	
	if (document.getElementById('bank2').value > 0) {
		var bank = document.getElementById('bank2').value;
	} else {
		var bank = document.getElementById('bank').value;
	}
	var account_name = document.getElementById('account_name').value;
	var phone = document.getElementById('phone').value;
	var phone2 = document.getElementById('phone2').value;
	var email = document.getElementById('email').value;
	var confirmEmail = validateEmail(email);
	
	if (recipient == 0) {
		alert("There was an error!!!\n\nPlease select a recipient");
		document.getElementById('recipient').focus();
		document.getElementById('recipient').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((account_number == "") || (isNaN(parseInt(account_number)) == true) || (account_number.length != 10)) {
		alert("There was an error!!!\n\nPlease Confirm that account number is not left empty or it complies with the NUBAM acount number format");
		document.getElementById('account_number').focus();
		document.getElementById('account_number').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (bank == 0) {
		alert("There was an error!!!\n\nPlease Confirm that you have selected the right bank associated with this accunt");
		document.getElementById('bank').focus();
		document.getElementById('bank').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (account_name == "") {
		alert("There was an error!!!\n\nPlease Confirm that the account name is valid");
		document.getElementById('account_name').focus();
		document.getElementById('account_name').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((phone2 == "") || (isNaN(parseInt(phone2)) == true) || (phone2.length > 3)) {
		alert("There was an error!!!\n\nPlease Confirm country code");
		document.getElementById('phone2').focus();
		document.getElementById('phone2').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((phone == "") || (isNaN(parseInt(phone)) == true) || (phone.length > 10)) {
		alert("There was an error!!!\n\nPlease Confirm phone number");
		document.getElementById('phone').focus();
		document.getElementById('phone').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((email != "") && (confirmEmail == false)) {
		alert("There was an error!!!\n\nPlease Confirm recipient email address");
		document.getElementById('email').focus();
		document.getElementById('email').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/addRecipient.php", { user: user, recipient: recipient, account_number: account_number, bank: bank, account_name: account_name, phone: phone, phone2: phone2, email: email })
		  .done(function( data ) {
			  if (data) {
				  window.location='confirmation';
			  } else {
				  alert("There was an error!!!\n\nThere was an error posting to the server, please confirm supplied details and try again");
			  }
		});
	}
}

function postToSystem2() {
	document.getElementById('account_number').removeAttribute("style");
	document.getElementById('bank').removeAttribute("style");
	document.getElementById('recipient').removeAttribute("style");
	document.getElementById('account_name').removeAttribute("style");
	document.getElementById('account_number').removeAttribute("style");
	document.getElementById('phone').removeAttribute("style");
	document.getElementById('phone2').removeAttribute("style");
	document.getElementById('email').removeAttribute("style");
	
	var user = document.getElementById('user').value;
	var recipient = document.getElementById('recipient').value;
	var account_number = document.getElementById('account_number').value;
	var checkEdit = document.getElementById('checkEdit').value;
	
	var bank = document.getElementById('bank').value;
	var account_name = document.getElementById('account_name').value;
	var phone = document.getElementById('phone').value;
	var phone2 = document.getElementById('phone2').value;
	var email = document.getElementById('email').value;
	var confirmEmail = validateEmail(email);
	
	if ((account_number == "") || (isNaN(parseInt(account_number)) == true) || (account_number.length != 10)) {
		alert("There was an error!!!\n\nPlease Confirm that account number is not left empty or it complies with the NUBAM acount number format");
		document.getElementById('account_number').focus();
		document.getElementById('account_number').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (bank == 0) {
		alert("There was an error!!!\n\nPlease Confirm that you have selected the right bank associated with this accunt");
		document.getElementById('bank').focus();
		document.getElementById('bank').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if (account_name == "") {
		alert("There was an error!!!\n\nPlease Confirm that the account name is valid");
		document.getElementById('account_name').focus();
		document.getElementById('account_name').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((phone2 == "") || (isNaN(parseInt(phone2)) == true) || (phone2.length > 3)) {
		alert("There was an error!!!\n\nPlease Confirm country code");
		document.getElementById('phone2').focus();
		document.getElementById('phone2').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((phone == "") || (isNaN(parseInt(phone)) == true) || (phone.length > 10)) {
		alert("There was an error!!!\n\nPlease Confirm phone number");
		document.getElementById('phone').focus();
		document.getElementById('phone').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else if ((email != "") && (confirmEmail == false)) {
		alert("There was an error!!!\n\nPlease Confirm recipient email address");
		document.getElementById('email').focus();
		document.getElementById('email').setAttribute("style", "border: 1px solid #FF9F9F;");
	} else {
		$.post( "includes/scripts/addRecipient.php", { user: user, recipient: recipient, account_number: account_number, bank: bank, account_name: account_name, phone: phone, phone2: phone2, email: email, checkEdit: checkEdit })
		  .done(function( data ) {
			  if (data) {
				  window.location='myRecipientList?done';
			  } else {
				  alert("There was an error!!!\n\nThere was an error posting to the server, please confirm supplied details and try again");
			  }
		});
	}
}

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