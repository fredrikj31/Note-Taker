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
	<title>Note Taker | Stats</title>
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
				<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
				<li class="active"><a href="#"><span class="glyphicon glyphicon-stats"></span> Stats</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	<!-- WELCOME MESSAGE -->
	<div class="page-header">
		<center>
			<h2>Here is your stats <?php echo $_SESSION['Username']; ?>!</h2>
		</center>
	</div>
	<div class="container">
		<h4>Stats:</h4>
		<div class="panel panel-default">
    		<div class="panel-body"><b>Notes Used:</b></div>
    		<div class="panel-body">
				<?php
					$OwnerId = $_SESSION['Id'];
					$OwnerUsername = $_SESSION['Username'];

					//Grapping all the users notes
					$sql = "SELECT * FROM `Notes` WHERE `OwnerId`='$OwnerId'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);

					$UsedNotes = $count;

					$UsedNotesProcent = 100 / 25 * $UsedNotes;

					$FreeNotes = 25 - $UsedNotes;
					$FreeNotesProcent = 100 - $UsedNotesProcent
				?>
				<p>Used: <b><?php echo $UsedNotes; ?></b> note(s), <b><?php echo $UsedNotesProcent ?>%</b></p>
				<p>Free: <b><?php echo $FreeNotes; ?></b> note(s), <b><?php echo $FreeNotesProcent ?>%</b></p>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo $UsedNotesProcent; ?>%">
						Used
					</div>
					<div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $FreeNotesProcent; ?>%">
						Free
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>
</body>
</html>
