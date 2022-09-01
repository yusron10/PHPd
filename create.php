<?php
session_start();
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'function.php';
if( isset($_POST ["submit"]) ) {
	if ( tambah($_POST) > 0) {
		echo "
		<script>
		alert('data berhasil di tambahkan');
		document.location.href = 'index.php'
		</script>
		";
	} else {
		echo "Data Gagal";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tambah Data</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Tambah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">NAMA : </label>
				<input type="text" name="nama" id="nama" required>
			</li>

			<li>
				<label for="nrp">NRP : </label>
				<input type="text" name="nrp" id="nrp" required>
			</li>

			<li>
				<label for="email">Email : </label>
				<input type="text" name="email" id="email" required>
			</li>

			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="gambar">Gambar : </label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<br>
			<li>
				<button type="submit" name="submit">Create Data</button>
			</li>
		</ul>
	</form>
</body>
</html>