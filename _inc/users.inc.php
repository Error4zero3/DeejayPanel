<?php

class users {
	
	private $Database, $Session, $Salt;
	
	function __construct($Database, $Session, $Salt) {
		
		$this->Database = $Database;
		$this->Session = $Session;
		$this->Salt = $Salt;
	
	} // END __construct
	
	function register($username, $password, $email, $habbo, $skype, $rank) {
		
		$username = $this->Database->Clean($username);
		$password = $this->Database->Clean($password);
		$email = $this->Database->Clean($email);
		$habbo = $this->Database->Clean($habbo);
		$skype = $this->Database->Clean($skype);
		$rank = $this->Database->Clean($rank);
		
		$password = $this->Hash($password);
		
		
		if($this->userExists($username, $password) != 1) {
			
			$this->Database->Query("insert into users set username='{$username}', password='{$password}', email='{$email}', habbo='{$habbo}', skype='{$skype}', rank='{$rank}'");
			
			return 1;
			
		} else {
			
			return 0;
			
		}
		
	} // END register
	
	function logout() {
		
		session_destroy();
		
	}
	
	function createNews($title, $content, $author) {
		
		$title = $this->Database->Clean($title);
		$content = $this->Database->Clean($content);
		$author = $this->Database->Clean($author);
		
		$date = date("d-m-Y");
		
		if($this->Database->Query("insert into home_news set title='{$title}', content='{$content}', author='{$author}', date='{$date}'")) {
			
		} else {
			
			return 0;
			
		}
		
	} // createNews
	
	function showNews() {
		
		$sql = mysql_query("select * from home_news");
		//$result = mysql_fetch_array($sql);
			
		while($rows = @mysql_fetch_assoc($sql)) {
		
			echo <<< EOT
		
		
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-head">
								<i class="icon-reorder"></i>
								<span>{$rows['title']}</span>
							</div>
							<div class="box-body">
		
								{$rows['content']}
		
								<br /><br />
								<span style="float:right"><i>Author: DJ {$rows['author']} - {$rows['date']}</i></span>
				
							</div>
						</div>
					</div>
				</div>
			
EOT;
		
			}
		
	}
	
	function login($username, $password) {
		
		$username = $this->Database->Clean($username);
		$password = $this->Database->Clean($password);
		
		$password = $this->Hash($password);
		
		if($this->userExists($username, $password) != 0) {
				
			return 1;
				
		} else {
				
			return 0;
				
		}
		
	}
	
	function Hash($password) {
		
		return md5($password . $this->Salt);
		
	}
	
	function userExists($username, $password) {
		
		$username = $this->Database->Clean($username);
		$password = $this->Database->Clean($password);
		$sql = "select * from users where username='{$username}' and password='{$password}'";
		
		$do = mysql_query($sql);
		
		$count = mysql_num_rows($do);
		
		if($count > 0) {
			
			return 1;
			
		} else {
			
			return 0;
		}
		
	}
	
	function checkLogin() {
		
		
		if(!isset($_SESSION['username'])) {

			header('Location: /DJ/DejayPanel/index');
			exit;
			return 0;
			
			
		} else {
			
			return 1;
			
		}
		
	}
}

?>