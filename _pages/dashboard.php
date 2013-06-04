<?php

include_once('_inc/global.php');

$Users->checkLogin();

?>
<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<title>Deejay - Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- small charts plugin -->
	<link rel="stylesheet" href="css/jquery.easy-pie-chart.css">
	<!-- calendar plugin -->
	<link rel="stylesheet" href="css/fullcalendar.css">
	<!-- Calendar printable -->
	<link rel="stylesheet" href="css/fullcalendar.print.css" media="print">
	<!-- chosen plugin -->
	<link rel="stylesheet" href="css/chosen.css">
	<!-- CSS for Growl like notifications -->
	<link rel="stylesheet" href="css/jquery.gritter.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- smoother animations -->
	<script src="js/jquery.easing.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- small charts plugin -->
	<script src="js/jquery.easy-pie-chart.min.js"></script>
	<!-- Charts plugin -->
	<script src="js/jquery.flot.min.js"></script>
	<!-- Pie charts plugin -->
	<script src="js/jquery.flot.pie.min.js"></script>
	<!-- Bar charts plugin -->
	<script src="js/jquery.flot.bar.order.min.js"></script>
	<!-- Charts resizable plugin -->
	<script src="js/jquery.flot.resize.min.js"></script>
	<!-- calendar plugin -->
	<script src="js/fullcalendar.min.js"></script>
	<!-- chosen plugin -->
	<script src="js/chosen.jquery.min.js"></script>
	<!-- Scrollable navigation -->
	<script src="js/jquery.nicescroll.min.js"></script>
	<!-- Growl Like notifications -->
	<script src="js/jquery.gritter.min.js"></script>

	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" />

</head>

<body data-layout="fixed">

	<div id="top"> 
		<div class="container-fluid">
			<div class="pull-right">
				<a href="logout" class="button">
					<i class="icon-signout"></i>
					Logout
				</a>
			</div>
		</div>
	</div>

	<div id="main">
		<div id="navigation" style="margin-top: 10px;">
			<ul class="mainNav" data-open-subnavs="multi">
				
				<?php 
				
				if($Users->getRankID($Session->getSession("username")) >= 1) {
					
					echo <<< EOT
					
					
						<li>
					<a href="dashboard"><i class="icon-home icon-white"></i><span>Dashboard</span></a>
					<ul class="subnav">
								<li>
									<a href="dashboard">Dashboard Home</a>
								</li>
								<li>
									<a href="#">Change Password</a>
								</li>
								<li>
									<a href="#">Change Habbo</a>
								</li>
								<li>
									<a href="#">Change Skype</a>
								</li>
								<li>
									<a href="userwarnings">Your Warnings</a>
								</li>
					</ul>
				</li>
				<li>
					<a><i class="icon-edit icon-white"></i><span>Radio DJ</span></a>
					<ul class="subnav">
						<li>
							<a href="requests">Requests &amp; shoutouts</a>
						</li>
						<li>
							<a href="booktimetable">Book a slot</a>
						</li>
						<li>
							<a href="djmessage">Edit DJ message</a>
						</li>
						<li>
							<a href="radiostats">Radio Stats</a>
						</li>
						<li>
							<a href="radiodetails">Radio Details</a>
						</li>
					</ul>
				</li>
					
EOT;
					
					
				}
				
				
				if($Users->getRankID($Session->getSession("username")) >= 2) {
					
					echo <<<EOT
					
					<li>
					<a><i class="icon-magic icon-white"></i><span>Head DJ</span></a>
					<ul class="subnav">
						<li>
							<a href="djlist">DJ List</a>
						</li>
					</ul>
				</li>
					
EOT;
					
					
				}
				
				if($Users->getRankID($Session->getSession("username")) >= 3) {
					
					echo <<<EOT
					
					
					<li>
					<a><i class="icon-th-large icon-white"></i><span>Management</span></a>
					<ul class="subnav">
						<li>
							<a href="adddj">Add new DJ</a>
						</li>
						<li>
							<a href="editdj">Edit a DJ</a>
						</li>
						<li>
							<a href="editradiodetails">Change radio details</a>
						</li>
						<li>
							<a href="trialradiodetails">Trial radio details</a>
						</li>
					</ul>
				</li>
					
					
					
EOT;
					
					
				}
				
				
				if($Users->getRankID($Session->getSession("username")) >= 4) {
					
					echo <<<EOT
					
					
					<li>
					<a><i class="icon-warning-sign icon-white"></i><span>Administration</span></a>
					<ul class="subnav">
						<li>
							<a href="addhomenews">Add home news</a>
						</li>
						<li>
							<a href="userpromotions">Management Promotions</a>
						</li>
					</ul>
				</li>
EOT;
					
					
				}
				
				
				?>
				
				
				
			</ul>
			
		</div>
		<div id="content">
			<div class="page-header">
				<div class="pull-left">
					<h4><i class="icon-home"></i> Dashboard</h4>
				</div>
			</div>
			<div class="content-highlighted">
				<ul class="quick" data-collapse="collapse">
				
				
					<li>

							<a><img src="img/icons/world.png" alt="" /><span style="padding: 5px; background-color: white; color: black; border-radius: 5px;">Slots Booked </br> 0</span></a>
						
						
						</li>
						
												<li>
						
						
							<a><img src="img/icons/archives.png" alt="" /><span style="padding: 5px; background-color: white; color: black; border-radius: 5px;">Requests </br> 0</span></a>
						
						
						</li>
			
						<li>
							<a><img src="img/icons/statistics.png" alt="" /><span style="padding: 5px; background-color: white; color: black; border-radius: 5px;">Current Listeners </br> <?php echo $Core->showListeners(); ?></span></a>
						</li>
				
				<li>
				
				<div style="padding: 10px; background-color: white; color: black; border-radius: 5px;">
				<img src="scripts/headGen/head.php?habbo=<?php echo $Users->getHabbo($Session->getSession("username"));?>&hotel=UK" /> <br />
				<b><?php echo $Users->getHabbo($Session->getSession("username"));?></b> <br />
				<?php $Users->getRankName(); ?><br />
				Warnings: <?php echo $Users->getWarnings($Session->getSession("username")); ?><br />
				</div>
				
				</li>
				
				
				
				
				
				
					
				</ul>	
			</div>

			<div class="container-fluid" id="content-area">

			<?php 
			
			
			$Users->showNews();

			
			?>
			

			</div>
		</div>
	</div>
	
</body>
</html>