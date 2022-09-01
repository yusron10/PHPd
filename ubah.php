<?php
session_start();
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'function.php';

// ambil data di url
$id = $_GET["id"];
// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST ["submit"]) ) {
	if ( ubah($_POST) > 0) {
		echo "
		<script>
		alert('data berhasil di ubah');
		document.location.href = 'index.php'
		</script>
		";
	}else {
		echo "Data Gagal";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDIT Data</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>EDIT Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?php echo $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">NAMA : </label>
				<input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>">
			</li>

			<li>
				<label for="nrp">NRP : </label>
				<input type="text" name="nrp" id="nrp" required value="<?php echo $mhs["nrp"]; ?>">
			</li>

			<li>
				<label for="email">Email : </label>
				<input type="text" name="email" id="email" required value="<?php echo $mhs["email"]; ?>">
			</li>

			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar : </label><br>
				<img src="img/<?= $mhs['gambar']; ?>" width="40"><br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<br>
			<li>
				<button type="submit" name="submit">Simpan Data</button>
			</li>
		</ul>
	</form>
</body>
</html>