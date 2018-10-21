<!DOCTYPE html>
<html>
<head>
	<title>Note Taker | Home</title>
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
				<li class="active"><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
			</ul>
			<form class="navbar-form navbar-right" action="progress-login.php" method="POST">
      			<div class="form-group">
				  	<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" name="Username" placeholder="Username...">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="text" class="form-control" name="Password" placeholder="Password...">
					</div>
      			</div>  
      			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span></button>
    		</form>
		</div>
	</nav>
	<div class="container">
		<?php
			//GRAPPING THE URL
			$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (strpos($fullUrl, "signup=SignedUpSuccess") == true) {
				echo '<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> You are now signed up!
			  </div>';
			} else if (strpos($fullUrl, "signup=SignedUpFailed") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> There was an error trying to sign you up. Try again!
			  </div>';
			} else if (strpos($fullUrl, "login=UsernameEmpty") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You need to fill out the username field. Try again!
			  </div>';
			} else if (strpos($fullUrl, "login=PasswordEmpty") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You need to fill out the password field. Try again!
			  </div>';
			} else if (strpos($fullUrl, "login=WrongInformation") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You gave some wrong details. Try again!
			  </div>';
			} else if (strpos($fullUrl, "login=NotLoggedIn") == true) {
				echo '<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> You are not logged in!
			  </div>';
			} else if (strpos($fullUrl, "login=LoggedOut") == true) {
				echo '<div class="alert alert-success alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> You are now logged out!
			  </div>';
			} else if (strpos($fullUrl, "login=Error") == true) {
				echo '<div class="alert alert-warning alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Warning!</strong> There was an error trying to log you in! Try again.
			  </div>';
			}
		?>
		<!-- WELCOME MESSAGE -->
		<div class="jumbotron">
			<center>
				<h1>Welcome to Note-Taker</h1>
				<p>This is a web application to help you to remember the things you are willing to forget.</p> 
			</center>
		</div>
		<!-- WHAT YOU WILL GET -->
		<ul class="list-group">
			<li class="list-group-item"><h4><b>What you will get:</b></h4></li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> 25 notes per user. That's alot!</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> A way to share notes with other users.</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> You can also rename the name of the note.</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> Re-edit notes, if you miss something in the note.</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> Delete the notes you dont want it, or dont need it.</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> You can have up to 2500 characters.</li>
			<li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> You don't need to pay. It's free!</li>
		</ul>
		<br>
		<br>
		<br>
		<br>
		<center>
			<div class="jumbotron">
				<h2>Signup!</h2>
				<br>
				<?php
					//GRAPPING THE URL
					$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

					if (strpos($fullUrl, "signup=Email-emptyError") == true) {
						$EmptyEmail = "Yes";
					} else if (strpos($fullUrl, "signup=Username-emptyError") == true) {
						$EmptyUsername = "Yes";
					} else if (strpos($fullUrl, "signup=Password-emptyError") == true) {
						$EmptyPassword = "Yes";
					} else if (strpos($fullUrl, "signup=ConfirmPassword-emptyError") == true) {
						$EmptyConfirmPassword = "Yes";
					} else if (strpos($fullUrl, "signup=Email-validateError") == true) {
						$InvalidEmail = "Yes";
					} else if (strpos($fullUrl, "signup=Email-istakenError") == true) {
						$TakenEmail = "Yes";
					} else if (strpos($fullUrl, "signup=Username-istakenError") == true) {
						$TakenUsername = "Yes";
					} else if (strpos($fullUrl, "signup=Password-notmacthingError") == true) {
						$NotMatchingPassword = "Yes";
					}
				?>
				<!-- SIGNUP FORM -->
				<form action="progress-signup.php" method="POST">
					<?php
						if (!empty($EmptyEmail)) {
							echo ' 	<div class="form-group has-error has-feedback">
									<label for="email">Email address:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
											<input type="text" name="Email" class="form-control" id="inputError" placeholder="Please fill out this field!">
											<span class="glyphicon glyphicon-remove form-control-feedback"></span>
										</div>
						  			</div>';
						} else if (!empty($InvalidEmail)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="email">Email address:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input type="text" name="Email" class="form-control" id="inputError" placeholder="The email you typed is not a email!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else if (!empty($TakenEmail)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="email">Email address:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input type="text" name="Email" class="form-control" id="inputError" placeholder="That email is already taken!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else {
							echo '<div class="form-group">
							<label for="email">Email address:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input type="text" name="Email" class="form-control" placeholder="Email...">
							</div>
							</div>';
						}

						if (!empty($EmptyUsername)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="username">Username:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" name="Username" class="form-control" id="inputError" placeholder="Please fill out this field!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else if (!empty($TakenUsername)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="username">Username:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" name="Username" class="form-control" id="inputError" placeholder="That username is already taken!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else {
							echo '<div class="form-group">
							<label for="username">Username:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" name="Username" class="form-control" placeholder="Username...">
							</div>
							</div>';
						}

						if (!empty($EmptyPassword)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="password">Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" name="Password" class="form-control" id="inputError" placeholder="Please fill out this field!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else if (!empty($NotMatchingPassword)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="password">Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" name="Password" class="form-control" id="inputError" placeholder="The confirm password and this do not match!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else {
							echo '<div class="form-group">
							<label for="password">Password:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="text" name="Password" class="form-control" placeholder="Password...">
							</div>
							</div>';
						}

						if (!empty($EmptyConfirmPassword)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="confirm-password">Confirm Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" name="Confirm-password" class="form-control" id="inputError" placeholder="Please fill out this field!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else if (!empty($NotMatchingPassword)) {
							echo ' 	<div class="form-group has-error has-feedback">
							<label for="confirm-password">Confirm Password:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" name="Confirm-password" class="form-control" id="inputError" placeholder="The password and this do not match!">
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							  </div>';
						} else {
							echo '<div class="form-group">
							<label for="confirm-password">Confirm Password:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="text" name="Confirm-password" class="form-control" placeholder="Confirm Password...">
							</div>
							</div>';
						}
					?>
					<button type="submit" class="btn btn-primary">Signup!</button>
				</form>
			</div>
		</center>
	</div>
</body>
</html>