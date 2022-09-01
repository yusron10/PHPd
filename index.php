<?php
session_start();
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
// Tombol cari di klik

if( isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}

?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Admin</title>
	<style>
		.loader {
			width: 30px;
			position: absolute;
			top: 110px;
			left: 320px;
			z-index:-1 ;
			display: none;
		}
	</style>
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Daftar Mahasiswa</h1>

	<a href="logout.php">Logout</a>
	<a href="create.php">Tambah Data</a>
	<br><br>
	<!-- tombol search -->

	<form action="" method="post">

		<input type="text" name="keyword" placeholder="Searching.." size="40" autofocus autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari</button>
		<img src="img/loader.gif" class="loader">
	</form>
	<br><br>

	<div id="container">

	<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>NRP</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jurusan</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach( $mahasiswa as $row) : ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td>
					<a href="ubah.php?id= <?= $row["id"];?>">Ubah</a> |
					<a href="hapus.php?id=<?= $row["id"]; ?>">Hapus</a>
				</td>
				<td><img src="img/<?= $row["gambar"];  ?>" width="50" alt=""></td>
				<td><?php echo $row["nrp"] ?></td>
				<td><?php echo $row["nama"] ?></td>
				<td><?php echo $row["email"] ?></td>
				<td>TKJ</td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
	</table>
	</div>
</body>
</html>