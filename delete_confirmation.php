<?php

session_start();

require "config/config.php";

$isDeleted = false;

if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	$error = "Please login first.";
}
else {

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$sql = "DELETE FROM user 
	WHERE id = " . $_SESSION["user_id"] . ";";

	// echo "<hr>" . $sql . "<hr>";

	$results = $mysqli->query($sql);

	if(!$results){
		echo $mysqli->error;
		exit();
	}	

	// Make sure this was succesful
	if($mysqli->affected_rows == 1) {
		$isDeleted = true;
	}


	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete confirmation | WeatherFit</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
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
			<h1 class="col-12 mt-4">Delete confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if ( $isDeleted ) :?>
					<div class="text-success">Your account "<span class="font-italic"><?php echo $_SESSION['username'];?></span>" was successfully deleted.</div>
					<?php session_destroy();?>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="home.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>