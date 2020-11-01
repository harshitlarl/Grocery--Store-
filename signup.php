

<?php require_once("../resources/config.php"); ?>

<?php
		$exists1 = false;
		$exists2 = false;
		if($_SERVER['REQUEST_METHOD'] == "POST"){
				$name = $_POST["name"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				$cpassword = $_POST["cpassword"];
				$phone = $_POST["phone"];
				$sql = "SELECT * FROM `user` WHERE `userid` = '$email' ";
				$result = mysqli_query($con, $sql);
				$num = mysqli_num_rows($result);
				if($num == 1){
					$exists1 = true;
				}
				else if(($password == $cpassword) && $exists1 == false){
					$sql1 = "INSERT INTO `customer`(`cname`, `cemail`, `cphonenumber`) VALUES ('$name', '$email', '$phone')";
					$sql2 = "INSERT INTO `user`(`userid`, `password`) VALUES ('$email','$password')";
					$result1 = mysqli_query($con, $sql1);
					$result2 = mysqli_query($con, $sql2);
					$sql3 = "SELECT * FROM user INNER JOIN customer ON user.userid=customer.cemail WHERE `userid` = '$email' AND `password` = '$password' ";
					$result3 = mysqli_query($con, $sql3);
					session_start();
					$row = mysqli_fetch_assoc($result3);
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $email;
					$_SESSION['cid'] = $row['cid'];
					$_SESSION['cname'] = $row['cname'];
					header("location: index.php");
				}
				else{
					$exists2 = true;
				}
		}
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>E-SHOP HTML Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER AND NAVIGATION -->
	<?php include("nav.php"); ?>
	<!-- /HEADER AND NAVIGATION -->


		<!-- Alert -->
	<?php
	if($exists1){
		echo'
	<div class = "container" style ="margin-top: 10px; ">
			<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="alert alert-danger" role="alert" style = "text-align: center">
		  	User already exists !
			</div>
	  </div>
	</div>';
	}

	if($exists2){
		echo'
	<div class = "container" style ="margin-top: 10px; ">
			<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="alert alert-danger" role="alert" style = "text-align: center">
				Passwords does not match !
			</div>
		</div>
	</div>';
	}
	?>
	<!-- /Alert -->



	<!-- SIGNUP section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<form action = "signup.php" method = "post">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">

							<div class="section-title">
								<h3 class="title">Sign Up</h3>
								<p>Already a customer ? <a href="login.php">Login</a></p>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="name" placeholder="Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="password" name="password" placeholder="Password">
							</div>
							<div class="form-group">
								<input class="input" type="password" name="cpassword" placeholder="Confirm Password">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Phone number">
							</div>
							<div class="pull-right">
								<button class="primary-btn">Sign Up</button>
							</div>
					</div>
					<div class="col-md-3"></div>
				</div>
			</form>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SIGNUP section -->




	<!-- FOOTER -->
	<?php include("footer.php"); ?>
	<!-- /FOOTER -->



	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
