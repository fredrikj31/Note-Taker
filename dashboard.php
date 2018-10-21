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
	<title>Note Taker | Dashboard</title>
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
					<li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
					<li><a href="stats.php"><span class="glyphicon glyphicon-stats"></span> Stats</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
	<?php
		$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (strpos($fullUrl, "note=SuccessCreate") == true) {
				echo '<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> You have created the note!
			  </div>';
			} else if (strpos($fullUrl, "note=FailedCreate") == true) {
				echo '<div class="alert alert-warning alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Warning!</strong> There was an error trying to create the note!
			  </div>';
			} else if (strpos($fullUrl, "note=NameIsTaken") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You already have an note named that!
			  </div>';
			} else if (strpos($fullUrl, "note=NoNoteFound") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> We could not find any note named that!
			  </div>';
			} else if (strpos($fullUrl, "note=DoNotOwnNote") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You dont own that note!
			  </div>';
			} else if (strpos($fullUrl, "note=NameEmpty") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You need to fill out the name for the note!
			  </div>';
			}
	?>
	</div>
	<!-- WELCOME MESSAGE -->
	<div class="page-header">
		<center>
			<h2>Welcome to your dashboard <?php echo $_SESSION['Username']; ?>!</h2>
		</center>
	</div>
	<div class="container">
		<form class="form-inline" action="progress-note.php" method="POST">
			<div class="form-group">
				<label for="create-note">Create Note:</label>
				<input type="text" class="form-control" name="Note-Name">
			</div>
			<button type="submit" name="NoteCreateSubmit" class="btn btn-primary">Create</button>
		</form>
		<br>
		<br>
		<form class="form-inline" action="/action_page.php">
			<div class="form-group">
				<label for="create-note">Search Note:</label>
				<input type="text" class="form-control" id="myInput" placeholder="Search Note...">
			</div>
		</form>
		<br>
		<div class="table-responsive">  
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Note Name:</th>
						<th>Created On:</th>
						<th>Updated On:</th>
						<th>Actions:</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php
						$UserId = $_SESSION['Id'];
						$UserName = $_SESSION['Username'];

						$sql = "SELECT * FROM `notes` WHERE `OwnerId`='$UserId'";
						$result = mysqli_query($conn, $sql);
						$count = mysqli_num_rows($result);
						if ($count > 0) {
							while ($row = mysqli_fetch_array($result)) {
								echo '<tr>
								<td><a href="note.php?Status=view&Id=' . $row['Id'] . '">' . $row["Name"] . '</a></td>
								<td>' . $row["CreatedAt"] . '</td>
								<td>' . $row["UpdatedAt"] . '</td>
								<td><a href="note.php?Status=view&Id=' . $row['Id'] . '">View</a> - <a href="note.php?Status=edit&Id=' . $row['Id'] . '">Edit</a></td>
								</tr>';
							}
						} else {
							echo '<tr>
							<td>You have not created any notes</td>
							<td>You have not created any notes</td>
							<td>You have not created any notes</td>
							<td>You have not created any notes</td>
							</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- MAKING SO YOU CAN SEARCH NOTES -->
	<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
</body>
</html>