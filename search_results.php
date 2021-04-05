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
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<title>WeatherFit</title>
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
	      	<a id="nav-tab" class="nav-link" href="login.php">Login</a>
	     <?php else: ?>
	      	<div class="p-2 text-white">Hello <?php echo $_SESSION["username"];?>!</div>
	      	<a class="nav-link" href="account_details.php">Account</a>
	      	<a class="nav-link" href="logout.php">Logout</a>
	     <?php endif; ?>
	    </div>
	  </div>
	</nav>

	<form id="results-form" action="" method="GET">
		<div class="form-row results-form-container">
			<div class="form-group input-label">
				<label for="location" class="search-text">WYA?</label>
			</div>
			<!-- <div class="form-group"> -->
				 <input type="hidden" id="temp" name="temp">
			<!-- </div> -->
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" id="location" name="location" placeholder="ex. Los Angeles, CA" value="">
			</div>
			<div class="form-group col-sm-5 weather-display center">
				<img src="" class="icon">
				<span class="desc"></span> Feels like: <span class="feels-like"></span>&#730F.
			</div>
			<div class="form-group validation text-danger"></div>
		</div> <!-- form-row -->
	</form> <!-- form -->

	<div class="clothing-container">
		<div>Hover over the image for more details.</div>
		<div class="col-10 col-sm-5 col-md-3 item">
			<img src="images/westbrook.jpg">
			<div class="item-name">Hey, it's Russell Westbrook. I'll display your clothes here once you enter a location.</div>
			<div class="details">Also, try dragging me.</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="main.js"></script>

    <!-- Draggabilly plugin file (CDN) -->
	<script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.min.js"></script>

	<!-- Initalize Draggabilly plugin -->
	<script>
		var $draggable = $('.item').draggabilly({
			axis: 'both'
		})
	</script>

</body>
</html>