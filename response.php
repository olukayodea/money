<?php 
	include_once("includes/functions.php");
	$id = $common->get_prep($_REQUEST['id']);
	
	$data = $transactions->getOne($id);
	
	//assume that payment has been recieved
	$payment = true;
	if ($payment == true) {
		$transactions->updateOne("status", "COMPLETED", $id);
		$transactions->orderNotification($id);
		header("location: summary?id=".$id);		
	} else {
		$sessionData = $common->unwrap($data['data']);
		$_SESSION['tempPayment'] = $sessionData;
		$transactions->updateOne("status", "FAILED", $id);
		header("location: confirmation");		
	}
?>