<?php
	session_start();

	if(!isset($_SESSION['Id'])) {
		header("Location: index.php?login=NotLoggedIn");
	} else {
		session_destroy();
		header("Location: index.php?login=LoggedOut");
	}
?>