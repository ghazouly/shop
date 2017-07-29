<?php

/*
*		---------------------------------
*		I. Login with rememberMe Cookie.
*		---------------------------------
*/

//creating a session to consume POST request
session_start();

if(!empty($_POST["login"])) {

		//Database connection, quering and fetching loggedIn user.
		$dbConnection = mysqli_connect("localhost", "root", "", "shop");

		$userName = $_POST["userName"];
		$userPassword = md5($_POST["userPassword"]);

		$query = "SELECT * FROM users
				WHERE userName='$userName'
				AND userPassword='$userPassword'";

		$result = mysqli_query($dbConnection,$query);

		$user = mysqli_fetch_assoc($result);


		//validating login request.
		if($user) {
				$_SESSION["id"]	= $user["id"];
				$message = "Successful Login";

				//setting loggedIn user's cookie.
				if(!empty($_POST["remember"])) {
						setcookie ("userLogin",
								$_POST["userName"],
								time()+ (10 * 365 * 24 * 60 * 60));
						setcookie ("userPassword",
								$_POST["userPassword"],
								time()+ (10 * 365 * 24 * 60 * 60));
				}
				//retrieving existing one.
				else {
					if(isset($_COOKIE["userLogin"])) {
						setcookie ("userLogin","");
					}
					if(isset($_COOKIE["userPassword"])) {
						setcookie ("userPassword","");
					}
				}
		}
		//failed request.
		else {
			$message = "Invalid Login";
		}
}
?>

<?php if(empty($_SESSION["userId"])) { ?>
		<h3>I. Login with rememberMe Cookie.</h3>
		<form action="" method="post">
				<div><?php if(isset($message)) { echo $message; } ?></div><br>

				<div><label for="login">userName</label></div>
				<div><input name="userName" type="text"
						value="<?php if(isset($_COOKIE["userLogin"]))	{ echo $_COOKIE["userLogin"]; } ?>"
						class="input-field">

				<div><label for="password">Password</label></div>
				<div><input name="userPassword" type="password"
						value="<?php if(isset($_COOKIE["userPassword"])) { echo $_COOKIE["userPassword"]; } ?>"
						class="input-field">

				<div><input type="checkbox" name="remember"
						<?php if(isset($_COOKIE["userLogin"])) { ?> checked <?php } ?> />
				<label for="remember-me">rememberMe</label>

				<div><input type="submit" name="login" value="Login"></div>
		</form>

<?php } else { ?>
		<h3>I. Login with rememberMe Cookie. <b>You have Successfully logged in!.</b></h3>
<?php } ?>

<br><hr><br>

<?php

/*
*		---------------------------------
*		II. Categories CRUD
*		---------------------------------
*/
