<?php 
// Koneksi ke Database
$db = mysqli_connect("localhost", "root", "" , "phpdasar");
function query($query) {
	global $db;
	$result =  mysqli_query($db, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc ($result) ) {
		$rows [] = $row;
	}

	return $rows;
}


function tambah($data){
	global $db;
	 // ambil data dari elemen form
	$nama =htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	// upload gambar 
	$gambar = upload();
	if ( !$gambar ) {
		return false;
	}
	// querry insert data
	$query = "INSERT INTO mahasiswa
	VALUES
	('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')
	";
	mysqli_query ($db, $query);

	return mysqli_affected_rows($db);
}

function upload() {
	$namafile= $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];
	// CEK upload gambar atau tidak
	if($error === 4) {
		echo "<script>
		alert('Pilih gambar terlebih dahulu');
		</script>";
		return false;
	}
	// cek apakah yang di upload adalah gambar
	$eksetensigambarvalid = ['jpg','jpeg','png'];
	$eksetensigambar = explode('.', $namafile);
	$eksetensigambar = strtolower(end($eksetensigambar));
	if(!in_array($eksetensigambar, $eksetensigambarvalid) )  {
		echo "<script>
		alert('yg anda upload bukan gambar');
		</script>";
		return false;
	}

	// cek jika tapi ukurannya terlalu besar

	if( $ukuranfile > 3000000) {
		echo "<script>
		alert('ukuran gambar terlalu besar');
		</script>";
		return false;
	}
	

	// jika lolos pengecek kan gambar
	// generate nama baru
	$namafilebaru = uniqid();
	$namafilebaru .='.';
	$namafilebaru .= $eksetensigambar;
	move_uploaded_file($tmpname, 'img/' . $namafilebaru);
	return $namafilebaru;
}

function hapus($id) {
	global $db;
	mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($db);
}

function ubah($data) {
	global $db;
	 // ambil data dari elemen form
	$id = $data["id"];
	$nama =htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarlama =  htmlspecialchars($data["gambarlama"]);
	// CEK apakah user pilih gambar baru
	if( $_FILES['gambar']['error'] === 4) {
		$gambar = $gambarlama;
	}else{
		$gambar = upload();
	}
	// querry insert data
	$query = "UPDATE mahasiswa SET
	nama = '$nama',
	nrp = '$nrp',
	email = '$email',
	jurusan = '$jurusan',
	gambar = '$gambar'
	WHERE id = $id
	";
	mysqli_query ($db, $query);

	return mysqli_affected_rows($db);
}

function cari($keyword) {
	$query = "SELECT * FROM mahasiswa WHERE 
	nama LIKE '%$keyword%' OR
	email = '$keyword'
	";

	return query ($query);
}

function register($data) {
	global $db;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($db, $data["password"]);
	$password2 = mysqli_real_escape_string($db, $data["password2"]);

	// CEK USERNAME ADA ATAU TIDAK
	$cek = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
	if( mysqli_fetch_assoc($cek) ) {
		echo "<script>
		alert ('Username Sudah terdaftar')
		</script>";
		return false;
	}
	// Cek Konfirmasi password
	if ($password !== $password2) {
		echo "<script>
		alert('Password tidak sesuai')
		</script>";
		return false;
	}
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
// tambahkan user baru
	mysqli_query($db, "INSERT INTO user VALUES('','$username','$password')");
	return mysqli_affected_rows($db);

}



?>