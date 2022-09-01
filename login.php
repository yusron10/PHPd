<?php 
session_start();
require 'function.php';

// cek cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

// ambil username berdasarkan id

	$result = mysqli_query($db, "SELECT username FROM user WHERE id = $id");
	$row =  mysqli_fetch_assoc($result);

	// cek cookie dan username
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}
if(isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$cek = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

	// CEK USERNAME
	if(mysqli_num_rows($cek) === 1 ) {

		// CEK PASSWORD
		$row = mysqli_fetch_assoc($cek);
		if(password_verify($password, $row["password"]) ) {
			// set SESSION
			$_SESSION["login"] = true;
			// cek remember me
			if (isset($_POST['remember'])) {
				// buat cookie

				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+ 60);
			}
			header("Location: index.php");
			exit;
		}
	}

	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Login</h1>

	<?php if(isset($error)) : ?>
		<p style="color: red; font-style: italic;">username / password Salah</p>
	<?php endif ?>
	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username</label>
				<input type="text" name="username" id="username">
			</li>
			<br>
			<li>
				<label for="password">password</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">Remember me</label>
			</li>
			<li>
				<button type="submit" name="login">Login</button>
			</li>
		</ul>
	</form>
</body>
</html>