<?php
	// To logout, remove the SESSION variables
	// To destory a session, must start a session
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout | WeatherFit</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- NavBar -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-color">
	  <a class="navbar-brand" href="search.php"><strong><i>WeatherFit</i></strong></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	    <!-- If the user is not logged in -->
	    <?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) : ?>	
	       	<a class="nav-link" href="create_account.php">Create Account</a>
	      	<a id="nav-tab" class="nav-link active" href="login.php">Login</a>
	     <?php else: ?>
	      	<div class="p-2 text-white">Hello <?php echo $_SESSION["username"];?>!</div>
	      	<a class="nav-link" href="account_details.php">Account</a>
	      	<a class="nav-link" href="logout.php">Logout</a>
	     <?php endif; ?>
	    </div>
	  </div>
	</nav>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Logout</h1>
			<div class="col-12">You are now logged out.</div>
			<div class="col-12 mt-3">You can go to <a href="home.php">home page</a> or <a href="login.php">log in</a> again.</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

</body>
</html>