// $ =  memanggil Jquery
$(document).ready(function() {
	// hilangkan tombol cari
	$('#tombol-cari').hide();
	// event ketika di keyword di tulis
	$('#keyword').on('keyup', function () {
		// munculkan ikon loading
		$('.loader').show();
		// ajax menggunakan load
		// $.get()
		$.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {
			$('#container').html(data);
			$('.loader').hide();
		})
		// $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
	});
});