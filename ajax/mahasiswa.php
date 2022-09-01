<?php 
sleep(3);
require '../function.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM mahasiswa WHERE 
nama LIKE '%$keyword%' OR
nrp LIKE '%$keyword%' OR
email LIKE '%$keyword%' OR
jurusan LIKE '%$keyword'
";
$mahasiswa = query($query);


?>

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