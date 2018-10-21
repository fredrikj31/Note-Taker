<?php
	include 'db.php';
	session_start();

	if(!isset($_SESSION['Id'])) {
		header("Location: index.php?login=NotLoggedIn");
	}

	$Status = $_GET['Status'];

	$noteId = $_GET['Id'];
	$OwnerId = $_SESSION['Id'];
	$OwnerName = $_SESSION['Username'];

	$sql = "SELECT * FROM `notes` WHERE `Id`='$noteId' AND `Owner`='$OwnerName' AND `OwnerId`='$OwnerId'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	if ($count === 1) {
		$sql = "SELECT * FROM `notes` WHERE `Id`='$noteId'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count === 1) {
			while ($row = mysqli_fetch_array($result)) {
				$noteName = $row['Name'];
				$noteCreatedAt = $row['CreatedAt'];
				$noteUpdatedAt = $row['UpdatedAt'];
				$noteText = $row['Text'];
			}
		} else {
			header("Location: dashboard.php?note=NoNoteFound");
		}
	} else {
		header("Location: dashboard.php?note=DoNotOwnNote");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Note Taker | Note</title>
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
			  	<?php
					if ($Status === "edit") {
						echo '<li class="active"><a href="#"><span class="glyphicon glyphicon-pencil"></span> Edit Note</a></li>';
					} else if ($Status === "view") {
						echo '<li class="active"><a href="#"><span class="glyphicon glyphicon-eye-open"></span> View Note</a></li>';
					}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- THIS SHOULD BE REPLACED WITH USERNAME -->
				<li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				<!-- THIS SHOULD BE REPLACED WITH USERNAME -->
			</ul>
		</div>
	</nav>
	<!-- SHOULD ONLY BE VISUABLE IF EDITING NOTE -->
	<div class="container">
		<?php 
			if ($Status === "edit") {
				echo '
						<div class="page-header">   
							<h3>Editing the note: '. $noteName .'</h3>
						</div>
						<form action="/action_page.php">
							<div class="form-group">
								<label for="edit-name">Edit Name:</label>
								<input type="text" class="form-control" name="NewName" placeholder="Name..." value="'. $noteName .'">
							</div>
							<br>
							<div class="form-group">
								<label for="comment">Note:</label>
								<textarea style="resize: none;" maxlength="2500" class="form-control" rows="10" cols="50" name="note">'. $noteText .'</textarea>
							</div>
							<br>
							<br>
							<button type="submit" class="btn btn-primary">Save</button> <button type="submit" form="deleteform" class="btn btn-danger">Delete</button>
						</form>
						<form action="" id="deleteform">
						</form>
					 ';
			} else if ($Status === "view") {
				echo '
						<div class="page-header">   
							<h3>Looking at the note: (note name)...</h3>
						</div>
						<textarea style="resize: none;" maxlength="2500" class="form-control" rows="10" cols="50" readonly><!-- PRINT OUT THE NOTE HERE -->&#13;&#10;Hej</textarea>
						<br>
						<form class="form-inline" action="/action_page.php">
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
					 ';
			}
		?>
	</div>
	<br>
	<br>
	<br>
</body>
</html>