<?php

include_once('_inc/global.php');

// Login //

if(isset($_POST['login_username']) && isset($_POST['login_password'])) {
	
	if($Users->login($_POST['login_username'], $_POST['login_password']) != 0) {
		
		$Session->createSession("username", $_POST['login_username']);
		header('Location: dashboard');
		exit;
		
	} else {
		
		echo <<<EOT
		
		
		<div class="alert alert-error" style="margin-top: 240px; width: 350px; text-align: center; margin-left: auto; margin-right: auto;">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Warning!</strong> Invalid Username / Password
		</div>	
		
EOT;
		
	}
	
}

// END Login //

// Delete News //

if(isset($_GET['deleteNews'])) {
	
	if($Users->deleteNews($_GET['deleteNews']) != 0) {
		
		header('Location: dashboard');
		exit;
		
	} else {
		
	}
	
}

// END Delete News //




// Pages //
$path = '_pages/';
 
$default_page = 'index';
$default_login_page = 'dashboard';
 
$default_404_page = '404';
 
if(empty($_GET['page'])) { 
	
 	if(!isset($_SESSION['username'])) {
 		
    	$page = $default_page; 
    
 	} else {
 		
 		$page = $default_login_page;
 	
 	}
    
    
 
} else {

 
    $page = (preg_match('/[^a-zA-Z0-9\ _-]/', $_GET['page']) || !file_exists($path . $_GET['page'] . '.php') ? $default_404_page : $_GET['page']);
 
}
 
 
require_once('_pages/'.$page.'.php');
