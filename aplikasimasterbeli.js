(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_hrgbeli = 0;
		var main = "masterbeli.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-hargabeli").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarianhargabeli]').on('input',function(e){
			var v_cari = $('input:text[name=pencarianhargabeli]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-hargabeli").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-hargabeli").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubahhargabeli').live("click", function(){

			var url = "edit_hargabeli.php";
			// ambil nilai id dari tombol ubah
			id_hrgbeli = this.id;

			$.post(url, {id: id_hrgbeli});
		});
		$('.tambahhargabeli').live("click", function(){

			var url = "add_hargabeli.php";
			// ambil nilai id dari tombol ubah
			id_hrgbeli = this.id;

			$.post(url);
		});

		// ketika tombol hapus ditekan
		$('.hapushargabeli').live("click", function(){
			var url = "masterbeli.input.php";
			// ambil nilai id dari tombol hapus
			id_hrgbeli = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapushargabeli: id_hrgbeli,id:id_hrgbeli} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-hargabeli").load(main);
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
				$("#data-hargabeli").html(data).show();
			});
		});
	});
}) (jQuery);
