<?php
	session_start();
	date_default_timezone_set("Africa/Lagos");
	$pageUR1 = $_SERVER["SERVER_NAME"];
	$curdomain = str_replace("www.", "", $pageUR1);

	if (($curdomain == "linnkstec.com/") || ($curdomain == "linnkstec.com") ) {
		ini_set("session.cookie_domain", ".PayMack.com/");
		define("URL", "https://linnkstec.com/clients/money/", true);
		define("servername", "localhost", true);
		define("dbusername", "paymack_main", true);
		define("dbpassword", "YwOWm@R@z$ng", true);
		define("dbname", "paymack_main", true);
	} else { 
		define("URL", "http://127.0.0.1/money/", true);
		define("servername", "localhost", true);
		define("dbusername", "root", true);
		define("dbpassword", "mysql", true);
		define("dbname", "paymach", true);
	}
	
	define("limit", 20, true);
	
	include_once("classes/config.php");
	$db = new sql;
	$connectDb = $db->connect();
	
	define("URLAdmin", URL."manage/", true);
	define("replyMail", "do-not-reply@linnkstec.com", true);
	define("NGN", "&#8358;", true);
	define("GBP", "&#163;", true);
	define("USD", "&#36;", true);
	define("CAD", "CA &#36;", true);
	
	include_once("classes/common.php");
	$common = new common;
	
	//log and reports
	include_once("classes/system_log.php");
	$system_log = new system_log;
	/*include_once("classes/visitors.php");
	$visitorData = new visitorData;
	$visitorData->addStat($_SERVER['REMOTE_ADDR'], $_SERVER["SERVER_NAME"]);*/
	
	//emailing
	include_once("classes/alerts.php");
	$alerts = new alerts;
	
	include_once("classes/admin.php");
	include_once("classes/users.php");
	include_once("classes/settings.php");
	include_once("classes/recipient_money.php");
	include_once("classes/bank.php");
	include_once("classes/transactions.php");
	include_once("classes/pages.php");
	include_once("classes/adminPages.php");
	include_once("classes/contact.php");
	$admin = new admin;
	$users = new users;
	$settings = new settings;
	$recipient_money = new recipient_money;
	$bank = new bank;
	$transactions = new transactions;
	$pages = new pages;
	$adminPages = new adminPages;
	$contact = new contact;
	
?>