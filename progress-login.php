<?php
	include 'db.php';

	$Username = $_POST['Username'];
	$Password = $_POST['Password'];

	if (empty($Username)) {
		header("Location: index.php?login=UsernameEmpty");
		die();
	} else if (empty($Password)) {
		header("Location: index.php?login=PasswordEmpty");
		die();
	}

	$HashText1 = hash('sha256', "qwogeufge163593uiwnuhnbiowenogiu23y782693hgioew");
	$HashText2 = hash('sha256', "eiwhghwoieht8923y9ty239ut892h3ij32t862t428h844gerh");
	$HashText3 = hash('sha256', "ewuhit892y89t3y892y7gh34g9y273t7fygfuu238ty7gu2327t7ft23g");
	$HashPassword1 = hash('sha256', $Password);
	$HashPassword2 = hash('sha256', $HashPassword1 . $HashText1);
	$HashPassword3 = hash('sha256', $HashPassword2 . $HashText2);
	$HashPasswordReal = hash('sha256', $HashPassword3 . $HashText3);

	$sql = "SELECT * FROM `Users` WHERE `Username`='$Username' AND `Password`='$HashPasswordReal'";
	$result = mysqli_query($conn, $sql);
	if ($result == TRUE) {
		$count = mysqli_num_rows($result);
		if ($count === 1) {
			while ($row = mysqli_fetch_array($result)) {
				session_start();
				$_SESSION['Id'] = $row['Id'];
				$_SESSION['Email'] = $row['Email'];
				$_SESSION['Username'] = $Username;
				header("Location: dashboard.php");
			}
		} else {
			header("Location: index.php?login=WrongInformation");
		}
	} else {
		header("Location: index.php?login=Error");
	}
	
	
?>