<?php
	class settings extends common {
		function add($array) {
			$USD = $this->mysql_prep($array['USD']);
			$CAD = $this->mysql_prep($array['CAD']);
			$GBP = $this->mysql_prep($array['GBP']);
			$EURO = $this->mysql_prep($array['EURO']);
			$CH1 = $this->mysql_prep($array['CH1']);
			$CH2 = $this->mysql_prep($array['CH2']);
			$CH3 = $this->mysql_prep($array['CH3']);
			$CH4 = $this->mysql_prep($array['CH4']);
			
			
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$USD."' WHERE `title` = 'US'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$CAD."' WHERE `title` = 'CA'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$GBP."' WHERE `title` = 'GB'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$EURO."' WHERE `title` = 'EURO'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$CH1."' WHERE `title` = 'CH1'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$CH2."' WHERE `title` = 'CH2'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$CH3."' WHERE `title` = 'CH3'") or die (mysql_error());
			$sql = mysql_query("UPDATE `settings` SET `value` = '".$CH4."' WHERE `title` = 'CH4'") or die (mysql_error());
			
			//add to log
			$logArray['object'] = get_class($this);
			$logArray['object_id'] = $id;
			$logArray['owner'] = "admin";
			$logArray['owner_id'] = $_SESSION['admin']['id'];
			$logArray['desc'] = "Updated exchange rate settings";
			$logArray['create_date'] = time();
			$system_log = new system_log;
			$system_log->create($logArray);
			return true;
		}
		
		function listAll() {
			$sql = mysql_query("SELECT * FROM `settings` ORDER BY `title` DESC") or die (mysql_error());
			
			if ($sql) {
				$result = array();
				$count = 0;
				
				while ($row = mysql_fetch_array($sql)) {
					$result[$count]['ref'] = $row['ref'];
					$result[$count]['title'] = $row['title'];
					$result[$count]['value'] = $row['value'];
					$count++;
				}
				return $this->out_prep($result);
			}
		}
		
		function getOne($id) {
			$id = $this->mysql_prep($id);
			$sql = mysql_query("SELECT `value` FROM `settings` WHERE `title` = '".$id."'") or die (mysql_error());
			
			if ($sql) {
				$result = array();
				
				if (mysql_num_rows($sql) == 1) {
					$row = mysql_fetch_array($sql);
					$result = $row[0];
					
					return $result;
				} else {
					return false;
				}
			}
		}
	}
?>