(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_user = 0;
		var main = "user.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-user").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-user").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-user").load(main);
			}
		});
		
		$('.ubah').live("click", function(){

			var url = "edit_user.php";
			// ambil nilai id dari tombol ubah
			kd_user = this.id;

			$.post(url, {id: kd_user});
		});

		$('.tambah').live("click", function(){

			var url = "add_user.php";
			// ambil nilai id dari tombol ubah
			kd_user = this.id;

			$.post(url);
		});		

		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "user.input.php";
			// ambil nilai id dari tombol hapus
			kd_user = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: kd_user, id: kd_user} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-user").load(main);
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
				$("#data-user").html(data).show();
			});
		});
	});
}) (jQuery);
