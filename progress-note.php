<?php
	include 'db.php';
	session_start();

	if(!isset($_SESSION['Id'])) {
		header("Location: index.php?login=NotLoggedIn");
	}


	if (isset($_POST['NoteCreateSubmit'])) {
		if (!empty($_POST['Note-Name'])) {
			$NoteName = $_POST['Note-Name'];
			$UserId = $_SESSION['Id'];
			$UserName = $_SESSION['Username'];
			$Date = date("d-m-Y");
	
			$sql = "SELECT * FROM `Notes` WHERE `OwnerId`='$UserId' AND `Owner`='$UserName' AND `Name`='$NoteName'";
			$result = mysqli_query($conn, $sql);
			if ($result == TRUE) {
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					header("Location: dashboard.php?note=NameIsTaken");
				} else {
					$sql = "INSERT INTO `Notes` (`Id`, `Owner`, `OwnerId`, `Name`, `CreatedAt`, `UpdatedAt`, `Text`) VALUES ('', '$UserName', '$UserId', '$NoteName', '$Date', '-', '')";
					$result = mysqli_query($conn, $sql);
					if ($result === true) {
						header("Location: dashboard.php?note=SuccessCreate");
					} else {
						header("Location: dashboard.php?note=FailedCreate");
					}
				}		
			}
		} else {
			header("Location: dashboard.php?note=NameEmpty");
		}
	} else {
		header("Location: dashboard.php?note=FailedCreate");
	}
?>