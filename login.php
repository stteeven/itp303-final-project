<?php

session_start();

require 'config/config.php';

// If no user is logged in, do the usual things. Otherwise, redirect user out of this page.
if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {

	// Check if user has entered in username/password
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// User did not enter username/password, it's blank
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			// User did enter username/password but need to check if the username/pw combination is correct
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			// Hash whatever user typed in for password, then compare this to the hashed password in the DB
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM user
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			// echo "<hr>" . $sql . "<hr>";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			// If we get 1 result back, means username/pw combination is correct.
			if($results->num_rows > 0) {
				// Set sesssion variables to remember this user
				$row = $results->fetch_assoc();
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = true;
				$_SESSION["user_id"] = $row["id"];
				$_SESSION["status"] = $row["privilege"];

				// Success! Redirect user to the home page
				header("Location: search_results.php");
			
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
// Redirect logged in user to home
else {
	header("Location: search_results.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Login</title>
</head>
<body>

	<!-- NavBar -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-color">
	  <a class="navbar-brand" href="home.php"><strong><i>WeatherFit</i></strong></a>
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
		<form action="login.php" method="POST">

			<div class="form-group row">
				<h1 class="col-12 mt-4 mb-4">Login</h1>
			</div> <!-- row -->

			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
	
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> <!-- .row -->


			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<div class="col-sm-9 col-md-6">
					<input type="text" class="form-control" id="username-id" name="username">
				</div>
			</div> <!-- form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9 col-md-6">
					<input type="password" class="form-control" id="password-id" name="password">
				</div>
			</div> <!-- form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="search.php" role="button" class="btn btn-light">Cancel</a>
				</div>
			</div> <!-- form-group -->

			<div class="form-group row">
				<div class="col-sm-9 ml-sm-auto">
					Don't have an account yet?
					<a href="create_account.php">Create your account.</a>
				</div>
			</div> <!-- .row -->

		</form>	<!-- form -->

	</div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>