<?php
	include 'db.php';

	$Email = $_POST['Email'];
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	$ConfirmPassword = $_POST['Confirm-password'];

	//Checking if the email input is empty
	if (empty($Email)) {
		header("Location: index.php?signup=Email-emptyError");
	} else {
		//Checking if the username input is empty
		if (empty($Username)) {
			header("Location: index.php?signup=Username-emptyError");
		} else {
			//Checking if the password input is empty
			if (empty($Password)) {
				header("Location: index.php?signup=Password-emptyError");
			} else {
				//Checking if the confirm password input is empty
				if (empty($ConfirmPassword)) {
					header("Location: index.php?signup=ConfirmPassword-emptyError");
				} else {
					//Checking if the email is a real email
					if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
						header("Location: index.php?signup=Email-validateError");
					} else {
						//Checking if the email is taken
						$sql = "SELECT * FROM `users` WHERE `Email`='$Email'";
						$result = mysqli_query($conn, $sql);
						$count = mysqli_num_rows($result);
						if ($count > 0) {
							header("Location: index.php?signup=Email-istakenError");
						} else {
							//Checking if the username is taken
							$sql = "SELECT * FROM `users` WHERE `Username`='$Username'";
							$result = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($result);
							if ($count > 0) {
								header("Location: index.php?signup=Username-istakenError");
							} else {
								//Checking if the password and confirm password matches
								if (!$Password === $ConfirmPassword) {
									header("Location: index.php?signup=Password-notmacthingError");
								} else {
									//Done! They are fully signup now
									$HashText1 = hash('sha256', "qwogeufge163593uiwnuhnbiowenogiu23y782693hgioew");
									$HashText2 = hash('sha256', "eiwhghwoieht8923y9ty239ut892h3ij32t862t428h844gerh");
									$HashText3 = hash('sha256', "ewuhit892y89t3y892y7gh34g9y273t7fygfuu238ty7gu2327t7ft23g");
									$HashPassword1 = hash('sha256', $Password);
									$HashPassword2 = hash('sha256', $HashPassword1 . $HashText1);
									$HashPassword3 = hash('sha256', $HashPassword2 . $HashText2);
									$HashPasswordReal = hash('sha256', $HashPassword3 . $HashText3);

									$sql = "INSERT INTO `users` (`Id`, `Email`, `Username`, `Password`) VALUES ('', '$Email', '$Username', '$HashPasswordReal')";
									$result = mysqli_query($conn, $sql);
									if ($result == TRUE) {
										header("Location: index.php?signup=SignedUpSuccess");
									} else {
										header("Location: index.php?signup=SignedUpFailed");
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>
