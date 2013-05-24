<?php

class db {
	
	private $Server, $DB;
	
	function __construct($host, $user, $pass, $database) {
	
		$this->Server = mysql_connect($host, $user, $pass);
		$this->DB = mysql_select_db($database);
		
		if(!$this->Server) {
			
			echo "<div style=\"font-family: tahoma; font-size: 11px; width: 400px; margin: auto; background-color:#F5A9A9; padding: 10px; border-radius: 3px; border: 1px solid #FA5858;\">";
			echo "<big><center><strong>MySQL Error:</strong></big><br />";
			echo "Cannot connect to MySQL Server @ {$host}";
			echo "</center></div>";
			
			die();
				
			
		} 
		
		if(!$this->DB) {
			
			echo "<div style=\"font-family: tahoma; font-size: 11px; width: 400px; margin: auto; background-color:#F5A9A9; padding: 10px; border-radius: 3px; border: 1px solid #FA5858;\">";
			echo "<big><center><strong>MySQL Error:</strong></big><br />";
			echo "Cannot connect to Database : {$database} @ {$host}";
			echo "</center></div>";
				
			die();
			
		}
		
	} // END __construct
	
	function Query($string) {
		
		$q = mysql_query($string);
		
		if(!$q) {
			
			echo "<div style=\"font-family: tahoma; font-size: 11px; width: 400px; margin: auto; background-color:#F5A9A9; padding: 10px; border-radius: 3px; border: 1px solid #FA5858;\">";
			echo "<big><center><strong>MySQL Error:</strong></big><br />";
			echo mysql_error();
			echo "</center></div>";
			
			die();
				
		}
		
		return $q;
		
	} // END Query
	
	function Clean($string) {
		
		return mysql_real_escape_string($string);
		
	}
	
	
}

?>