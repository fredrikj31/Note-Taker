<?php
	include 'db.php';
	session_start();

	if(!isset($_SESSION['Id'])) {
		header("Location: index.php?login=NotLoggedIn");
	}

	$UserId = $_SESSION['Id'];
	$Email = $_POST['Email'];
	$Username = $_POST['Username'];

	if (empty($Email)) {
		header("Location: profile.php?update=EmailEmpty");
		die();
	} else if (empty($Username)) {
		header("Location: profile.php?update=UsernameEmpty");
		die();
	} else {
		//SUCCESS
		$sql = "SELECT * FROM `Notes` WHERE `Username`=''"
		$sql = "UPDATE `Users` SET `Email`='$Email', `Username`='$Username' WHERE `Id`='$UserId'";
		$result = mysqli_query($conn, $sql);
		if ($result == TRUE) {
			header("Location: profile.php?update=Success");
			die();
		} else {
			header("Location: profile.php?update=Error");
			die();
		}
		
	}
?>