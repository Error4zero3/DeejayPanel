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
	
	function getRankID($username) {
		
			$rankSQL = $this->Database->Query("select * from users where username='{$username}'");
			
			while($row = mysql_fetch_assoc($rankSQL)) {
				
				
				return $row['rank'];
				
			}  
	}
	
	function getHabbo($username) {
		
		$HabboSQL = $this->Database->Query("select * from users where username='{$username}'");
		
		while($row = mysql_fetch_assoc($HabboSQL)) {
		
		
			return $row['habbo'];
		
		}
		
	}
	
	function getRankName() {
		
		if($this->getRankID($this->Session->getSession("username")) == 1) {
			
			echo "<span style='font-weight: bold; color: #45629F;'>Radio DJ</span>";
	
		}
		
		if($this->getRankID($this->Session->getSession("username")) == 2) {
				
			echo "<span style='font-weight: bold; color: #8450A7;'>Head DJ</span>";
		
		}
		
		if($this->getRankID($this->Session->getSession("username")) == 3) {
				
			echo "<span style='font-weight: bold; color: #4B9D2D;'>Management</span>";
		
		}
		
		if($this->getRankID($this->Session->getSession("username")) == 4) {
				
			echo "<span style='font-weight: bold; color: red;'>Administrator</span>";
		
		}
		
	}
	
	function logout() {
		
		session_destroy();
		
	}
	
	function deleteNews($id) {
		
		$id = $this->Database->Clean($id);
		
		if($this->getRankID($this->Session->getSession("username")) == 4) {
			
			$this->Database->Query("delete from home_news where ID='{$id}'");
			return 1;
			
		} else {
			
			return 0;
		}
		
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
		
		
		$sql = mysql_query("select * from home_news order by ID DESC");
		//$result = mysql_fetch_array($sql);
			
		while($rows = @mysql_fetch_assoc($sql)) {
			
			if($this->getRankID($this->Session->getSession("username")) == 4) {
					
				$delete = "<a href='index.php?deleteNews={$rows['ID']}' class='button button-basic-red'>DELETE</a>";
					
			} else {
					
				$delete = "";
			}
		
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
								<span style="float:right"><i>Author: DJ {$rows['author']} - {$rows['date']}</i> {$delete}</span>
				
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