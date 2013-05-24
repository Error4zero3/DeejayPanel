<?php

class session {
	
	
	
	function __construct() {
		
		if(!isset($_SESSION)) {
			
			session_start();
			
		}
		
	}
	
	function createSession($var, $input) {
		
		return $_SESSION[$var] = $input;
		
	}
	
	function getSession($var) {
		
		return $_SESSION[$var];
		
	}

}

?>