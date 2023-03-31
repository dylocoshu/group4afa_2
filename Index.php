<?php
	session_start();
	include('includes/config.php');
?>
<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<?php
if(isset($_POST['submit-button'])) {
    $query = urlencode($_POST['email']);
    Header("Location: venues.php?query=$query");
    exit;
}
?>
<?php require("nav.php"); ?>

	<head>
		<title>Access & Inclusion UK</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>

	<body class="is-preload">
	
	
		<!-- Header -->
		<img src="images/logo.png" alt="" />
			<header id="header">
			
				<p>&nbsp &nbsp Looking for somewhere inclusive?<br >
				<strong class="hmm">&nbsp &nbsp Enter a location here...</strong></p>
			</header>

		<!-- Signup Form -->
		<form id="signup-form" method="post" >
			&nbsp &nbsp &nbsp 
				<input type="text" name="email"  placeholder="Search Location" autocomplete="off"/>
				<input type="submit" value="Enter" name="submit-button"  />
			</form>

		<!-- Footer -->
			

		<!-- Scripts -->
			<script src="assets/js/main.js"></script>

	</body>
</html>