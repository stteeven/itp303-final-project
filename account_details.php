<?php
	
	session_start();

	require 'config/config.php';

	// If no user is logged in, do the usual things. Otherwise, ask the user to log back in.
	if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {

		// Check if user has entered in username/password
		if ( isset($_POST['username']) && isset($_POST['password']) ) {
			// User did not enter username/password, it's blank
			if ( empty($_POST['username']) || empty($_POST['password']) ) {

				$error = "Please login.";

			}
			else {
				// User did enter username/password but need to check if the username/pw combination is correct
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

				if($mysqli->connect_errno) {
					echo $mysqli->connect_error;
					exit();
				}

				$sql = "SELECT * FROM user WHERE id = " . $_SESSION["user_id"] . ";";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Account Details</title>
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-color">
	  <a class="navbar-brand" href="home.php"><strong><i>WeatherFit</i></strong></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	    <!-- If the user is not logged in -->
	    <?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) : ?>	
	       	<a class="nav-link active" href="create_account.php">Create Account</a>
	      	<a id="nav-tab" class="nav-link" href="login.php">Login</a>
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
				<h1 class="col-12 mt-4 mb-4">Account Details</h1>
			</div> <!-- row -->
		<div class="row mb-3 ml-4">
			<strong>Username</strong>: <?php echo $_SESSION["username"];?>
		</div>

		<div class="row mb-3 ml-4">
			<strong>Status</strong>: <?php echo $_SESSION["status"];?>
		</div>

		<div class="row mb-3 ml-4">
			<a href="account_edit.php">Edit account details</a>
		</div>
		
	</div> <!-- .container -->

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>