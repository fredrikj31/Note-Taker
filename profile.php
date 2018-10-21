<?php
	include 'db.php';
	session_start();

	if(!isset($_SESSION['Id'])) {
		header("Location: index.php?login=NotLoggedIn");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Note Taker | Profile</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
		  	<div class="navbar-header">
				<a class="navbar-brand" href="#">Note Taker</a>
		  	</div>
		  	<ul class="nav navbar-nav">
			  	<li><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
				<li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
				<li><a href="stats.php"><span class="glyphicon glyphicon-stats"></span> Stats</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	<!-- WELCOME MESSAGE -->
	<div class="page-header">
		<center>
			<h2>Welcome to your profile <?php echo $_SESSION['Username']; ?>!</h2>
		</center>
	</div>
	<div class="container">
		<?php
			//GRAPPING THE URL
			$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (strpos($fullUrl, "update=EmailEmpty") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Please fill out the email field. Try again!
			  </div>';
			} else if (strpos($fullUrl, "update=UsernameEmpty") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Please fill out the username field. Try again!
			  </div>';
			} else if (strpos($fullUrl, "update=Error") == true) {
				echo '<div class="alert alert-warning alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> There was an error while trying to update your information. Try again!
			  </div>';
			} else if (strpos($fullUrl, "update=Success") == true) {
				echo '<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> Success, your information is now updated!
			  </div>';
			}
		?>
		<h4>Here you can see your information:</h4>
		<br>
		<?php
			//GRAPPING ALL THE INFORMATION ABOUT THE USER
			$OwnerId = $_SESSION['Id'];

			$sql = "SELECT * FROM `Users` WHERE `Id`='$OwnerId'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count == 1) {
				while ($row = mysqli_fetch_array($result)) {
					$UserEmail = $row['Email'];
					$UserName = $row['Username'];
				}
			} else {
				echo "There was an error. Please send a report ticket!";
			}
			
		?>
		<form action="update-profile.php" method="POST">
			<div class="input-group">
				<span class="input-group-addon">Email:</span>
				<input id="email" type="text" class="form-control" name="Email" value="<?php echo $UserEmail;?>" readonly>
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon">Username:</span>
				<input id="username" type="text" class="form-control" name="Username" value="<?php echo $UserName;?>" readonly>
			</div>
			<br>
			<input type="submit" style="float: right;" id="UpdateBtn" class="btn btn-info" value="Update Information">
		</form>
		<br>
		<input type="button" id="EditBtn" class="btn btn-info" value="Edit information" onclick="EditInformation();">
		<br>
		<br>
		<p><b>Hint! </b><i>By editing username & email. You need to logout and login with the new details to see the new information.</i></p>
	</div>
	<script>
		var EditInformationStatus = false;
		document.getElementById('UpdateBtn').style.visibility = 'hidden';

		function EditInformation() {
			if (EditInformationStatus == false) {
				document.getElementById('email').readOnly = false;
				document.getElementById('username').readOnly = false;
				document.getElementById('UpdateBtn').style.visibility = 'visible';
				document.getElementById('EditBtn').value = "Close Editing";
				EditInformationStatus = true;
			} else if (EditInformationStatus == true) {
				document.getElementById('email').readOnly = true;
				document.getElementById('username').readOnly = true;
				document.getElementById('UpdateBtn').style.visibility = 'hidden';
				document.getElementById('EditBtn').value = "Edit Information";
				EditInformationStatus = false;
		}
}
	</script>
</body>
</html>