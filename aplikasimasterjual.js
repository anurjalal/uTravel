(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_hrgjual = 0;
		var main = "masterjual.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-hargajual").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarianhargajual]').on('input',function(e){
			var v_cari = $('input:text[name=pencarianhargajual]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-hargajual").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-hargajual").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubahhargajual').live("click", function(){

			var url = "edit_hargajual.php";
			// ambil nilai id dari tombol ubah
			id_hrgjual = this.id;

			$.post(url, {id: id_hrgjual});
		});
		$('.tambahhargajual').live("click", function(){

			var url = "add_hargajual.php";
			// ambil nilai id dari tombol ubah
			id_hrgjual = this.id;

			$.post(url);
		});

		// ketika tombol hapus ditekan
		$('.hapushargajual').live("click", function(){
			var url = "masterjual.input.php";
			// ambil nilai id dari tombol hapus
			id_hrgjual = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapushargajual: id_hrgjual,id:id_hrgjual} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-hargajual").load(main);
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
				$("#data-hargajual").html(data).show();
			});
		});
	});
}) (jQuery);
