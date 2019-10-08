(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var no_nota = 0;
		var main = "pesanan.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-pesanan").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-pesanan").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-pesanan").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubah').live("click", function(){

			var url = "view_purchase_edited.php";
			// ambil nilai id dari tombol ubah
			no_nota = this.id;

			$.post(url, {id: no_nota});
		});
		$('.tambah').live("click", function(){

			var url = "add_purchase_edited.php";
			// ambil nilai id dari tombol ubah
			no_nota = this.id;

			$.post(url);
		});
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "pesanan.input.php";
			// ambil nilai id dari tombol hapus
			no_nota = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin menghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: no_nota, id: no_nota} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-pesanan").load(main);
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
				$("#data-pesanan").html(data).show();
			});
		});
		
		// ketika tombol simpan ditekan
	});
}) (jQuery);
