<?php
	class common {
		function curlPost($url, $fields) {
			//extract data from the post
			extract($_POST);
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string,'&');
			
			//open connection
			$ch = curl_init();
			
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST,count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			
			//execute post
			$result = curl_exec($ch);
			
			//close connection
			curl_close($ch);
			return $result;
		}
		
		function curl_file_get_contents($url) {
			if(strstr($url, "https") == 0) {
				return self::curl_file_get_contents_https($url);
			}
			else {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($ch);
				curl_close($ch);
				return $data;
			}
		}
		
		function curl_file_get_contents_https($url) {
			$res = curl_init();
			curl_setopt($res, CURLOPT_URL, $url);
			curl_setopt($res,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($res, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($res, CURLOPT_SSL_VERIFYPEER, false);
			$out = curl_exec($res);
			curl_close($res);
			return $out;
		}
				
		function get_prep($value) {
			$value = urldecode(htmlentities(strip_tags($value)));
			
			return $value;
		}
		
		function get_prep2(&$item) {
			$item = htmlentities($item);
		}
		
		function out_prep($array) {
			if (count($array) > 0) {
				array_walk_recursive($array, array($this, 'get_prep2'));
			}
			return $array;
		}
		
		function mysql_prep($value) {
			$magic_quotes_active = get_magic_quotes_gpc();
			$new_enough_php = function_exists( "mysql_real_escape_string" ); 
			if($new_enough_php) { 
				if($magic_quotes_active) { $value = stripslashes($value); }
				$value = mysql_real_escape_string($value);
			}else{ 
				if(!$magic_quotes_active) {$value = addslashes($value); }
			}
			return $value;
		}
		
		function createRandomPassword($len = 7) { 
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
			$count = strlen($chars);
			while ($i <= $len) { 
				$num = rand() % $count; 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
			return $pass; 
		}
		
		function send_mail($from,$to,$subject,$body) {
			$headers = '';
			$headers .= "From: $from\r\n";
			$headers .= "Reply-to: ".replyMail."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "Date: " . date('r', time()) . "\r\n";
		
			if (@mail($to,$subject,$body,$headers)) {
				return true;
			} else {
				return false;
			}
		}
		
		function truncate($text, $chars = 100) {
			$text = $text." ";
			$text = substr($text,0,$chars);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text."...";
			return $text;
		}
		
		function get_time_stamp($post_time) {
			if (($post_time == "") || ($post_time <1)) {
				return false;
			} else {
				$difference = time() - $post_time;
				$periods = array("sec", "min", "hour", "day", "week",
				"month", "years", "decade");
				$lengths = array("60","60","24","7","4.35","12","10");
				
				if ($difference >= 0) { // this was in the past
					$ending = "ago";
				} else { // this was in the future
					$difference = -$difference;
					$ending = "time";
				}
				
				for($j = 0; $difference >= $lengths[$j]; $j++)
				$difference /= $lengths[$j];
				$difference = round($difference);
				
				if($difference != 1) $periods[$j].= "s";
				$text = "$difference $periods[$j] $ending";
				return $text;
			}
		}
		
		function getExtension($str) {
			$i = strrpos($str,".");
			if (!$i) { return ""; } 
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		}
		
		function getParam($url) {
			$urlData = explode("?", $url);
			$param = explode("&", $urlData[1]);
			$tag = "";
			for ($i = 2; $i < count($param); $i++) {
				if ($param[$i] != "") {
					$tag .= "&".$param[$i];
				}
			}
			return $tag;
		}
		
		function get_tiny_url($url)  {  
			$ch = curl_init();  
			$timeout = 5;  
			curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
			$data = curl_exec($ch);  
			curl_close($ch);  
			return $data;  
		}
		
		
		function seo($id, $type="item") {
			if ($type == "category") {
				$categories = new categories;
				$row = $categories->getOne($id);
				$id = $row['ref'];
				$name = trim(strtoupper($row['title']));
				
				$urlLink = explode(" ", $name);
				$link = implode("-", $urlLink);
				
				$result = URL."categories/".$id."/".$link."/";
			} else {
				$inventory = new inventory;
				$row = $inventory->getOne($id);
				
				$id = $row['code'];
				$name = trim(strtoupper($row['title']));
				
				$urlLink = explode(" ", $name);
				$link = implode("-", $urlLink);
				
				$result = URL."items/".$id."/".$link."/";
			}
//			$result = URL."item?id=".$id;
			
			return $result;
		}
		
		function hashPass($string) {
			$count = strlen($string);
			$start = $count/2;
			$list = "";
			for ($i = 0; $i < $start; $i++) {
				$list .= "*";
			}
			$hasPass = substr_replace($string, $list, $start);
			
			return $hasPass;
		}
		
		function initials($string) {
			$string = trim($string);
			$words = explode(" ", $string);
			$words = array_filter($words);
			$letters = "";
			foreach ($words as $value) {
				$letters .= strtoupper(substr($value, 0, 1)).". ";
			}
			$letters = trim(trim($letters), ".");
			
			return $letters;
		}
		
		function africaProblem() {
			if ($_SESSION['location_data']['loc_city'] != "") {
				return trim($_SESSION['location_data']['loc_city']);
			} else {
				return trim($_SESSION['location_data']['loc_country']);
			}
		}
		
		function selectcurrency($data) {
			if ($data == "GB") {
				return GBP;
			} else if ($data == "NG") {
				return NGN;
			} else if ($data == "US") {
				return USD;
			} else if ($data == "CA") {
				return CAD;
			}else {
				return $data;
			}
		}
		
		function unwrap($data) {
			$result = base64_decode($data);
			$result = json_decode($result, true);
			
			return $result;
		}
		
		function numberPrintFormat($value) {
			if ($value > 999 && $value <= 999999) {
				$result = floor($value / 1000) . ' K';
			} elseif ($value > 999999 && $value < 999999999) {
				$result = floor($value / 1000000) . ' M';
			} elseif ($value > 999999999) {
				$result = floor($value / 1000000000) . ' B';
			} else {
				$result = $value;
			}
			
			return $result;
		}
	}
?>