(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_gabungan = 0;
		var main = "subgroup.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-subgroup").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencariansubgroup]').on('input',function(e){
			var v_cari = $('input:text[name=pencariansubgroup]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-subgroup").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-subgroup").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubahsubgroup').live("click", function(){

			var url = "edit_subgroup.php";
			// ambil nilai id dari tombol ubah
			kd_gabungan = this.id;

			$.post(url, {id: kd_gabungan});
		});
		$('.tambah').live("click", function(){

			var url = "add_subgroup.php";
			// ambil nilai id dari tombol ubah
			kd_gabungan = this.id;

			$.post(url);
		});
		$('.hapussubgroup').live("click", function(){
			var url = "subgroup.input.php";
			// ambil nilai id dari tombol hapus
			kd_gabungan = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapussubgroup: kd_gabungan,id:kd_gabungan} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-subgroup").load(main);
				});
			}
		});
		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
				// tampilkan data mahasiswa yang sudah di perbaharui
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-subgroup").html(data).show();
			});
		});
	});
}) (jQuery);
