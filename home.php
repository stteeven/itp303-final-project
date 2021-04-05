<?php 

session_start();
?>

<!DOCTYPE html>
<html>
<head>

	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- CSS link -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Icon Library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Home | WeatherFit</title>

</head>
<body>

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
	      	<a id="nav-tab" class="nav-link" href="login.php">Login</a>
	     <?php else: ?>
	      	<div class="p-2 text-white">Hello <?php echo $_SESSION["username"];?>!</div>
	      	<a class="nav-link" href="account_details.php">Account</a>
	      	<a class="nav-link" href="logout.php">Logout</a>
	     <?php endif; ?>
	    </div>
	  </div>
	</nav>

	<div id="header" class="jumbotron jumbotron-fluid">

		<h1 class="display-4 title"><i><strong>WeatherFit</strong></i></h1>

		<p class="lead subhead col-6 center">The most important part of your fit is whether it fits the weather.</p>

		<div class="container vertical-align container-padding">
			</div class="col">
		 		<a href="search_results.php" role="button" class="btn search-btn">Start</a>
		 	</div>

		 	<!-- <div class="col">
		 		<a href="login.php" role="button" class="btn btn-primary">Login</a>
		 	</div>

		 	<div class="col">
		 		<a href="create_account.php" role="button" class="btn btn-primary">Create Account</a>
		 	</div> -->

		</div> 

	</div>

	<footer>
		<hr>
		<p>by Steven Gong</p>
	</footer>	

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="main.js"></script>

</body>
</html>