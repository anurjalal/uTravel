<?php
session_start();
if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Administrator'){
include 'base.php'; }
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Sales'){
include 'basesales.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Kasir'){
include 'basekasir.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Finance'){
include 'basefinance.php';}
else if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] =='Warehouse'){
include 'basewarehouse.php';}
?>
<?php startblock('konten') ?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function updateTotaldiskon()
	{
		var counter = $('.pembelian').length;
		//alert(counter);
		var subtotal = 0;
		for (i=1;i<=counter;i=i+1)
			{
				var berat_netto = "#berat_netto"+i;
				var harga_per_ton = "#harga_per_ton"+i;
				var harga_total = "#total_harga"+i;
				var pembulatan_field = "#pembulatan"+i;
				var nominal_yg_dibayar = "#nominal_yg_dibayar"+i;
				var hasil_pembulatan = 0;
				total_harga = parseFloat($(berat_netto).val()*$(harga_per_ton).val());
				$(harga_total).val(total_harga);
				var angka = String(total_harga);
				var angkatotal_harga = angka.substring(angka.length-3);
				var angkatotal_harganum = Number(angkatotal_harga);
				if (angkatotal_harganum>500)
				{
				var pembulatan = (Math.round(Number(total_harga)/1000)*1000) - 1000;
				}
				else
				{
				var pembulatan = (Math.floor(Number(total_harga)/1000)*1000);
				}
				hasil_pembulatan = total_harga - pembulatan;
				$(pembulatan_field).val(hasil_pembulatan);
				$(nominal_yg_dibayar).val(pembulatan.toFixed(2));
				subtotal = subtotal + pembulatan;
			}
		$("#subtotal").val(subtotal.toFixed(2));
		//$("#ppn").val(Math.round(0.1*(Number(subtotal)-Number($("#diskontop").val())-Number($("#diskonprogram").val()))));
		$("#hargatotal").val(Number(subtotal)-Number($("#diskon").val()));
		$("#hargatotalpajak").val(Number(subtotal)-Number($("#diskon").val()));

	}
	function setHargaBarang(nama_barang)
			{
			var counter = nama_barang.id.match(/\d+/);
			var nama_barang_val = document.getElementById("nama_barang"+counter).value;
			var kualitas = document.getElementById("kualitas"+counter).value;

			$.post('check_hrgbeli.php', {nama_barang: nama_barang_val.toUpperCase(),kualitas: kualitas },
				function(data){
					$("#nama_barang"+counter).val(nama_barang_val.toUpperCase());
					$("#harga_per_ton"+counter).val(0);
					$("#harga_per_ton"+counter).val(data.hrg_beli);
					updateTotaldiskon();
				}, 'json');
			}
	function setHarga(no_tiket)
			{
			var counter = no_tiket.id.match(/\d+/);
			var no_tiket_val = document.getElementById("no_tiket"+counter).value;
			var tgl_po_val = document.getElementById("tgl_po").value;
			//var kualitas = document.getElementById("kualitas"+counter).value;

			$.post('check_timbangan_supplier.php', {no_tiket: no_tiket_val,tgl_po: tgl_po_val },
				function(data){
					$("#no_polisi"+counter).val(data.no_polisi);
					$("#nama_supplier").val(data.nama_supplier);
					$("#nama_barang"+counter).val(data.nama_barang.toUpperCase());
					$("#nama_supir"+counter).val(data.nama_supir);
					$("#berat_gross"+counter).val(data.berat_gross);
					$("#berat_tare"+counter).val(data.berat_tare);
					$("#berat_netto"+counter).val(data.berat_netto);
					$("#jam_in"+counter).val(data.jam_in);
					$("#jam_out"+counter).val(data.jam_out);
					$("#tgl_in"+counter).val(data.tgl_in);
					$("#tgl_out"+counter).val(data.tgl_out);
					updateTotaldiskon();
				}, 'json');
			}
	function setHargaKualitas(kualitas)
			{
			var counter = kualitas.id.match(/\d+/);
			var kualitas_val = document.getElementById("kualitas"+counter).value;
			var nama_barang = document.getElementById("nama_barang"+counter).value;
			$.post('check_hrgbeli.php', {nama_barang: nama_barang.toUpperCase(),kualitas: kualitas_val },
				function(data){
					$("#nama_barang"+counter).val(nama_barang.toUpperCase());
					$("#harga_per_ton"+counter).val(0);
					$("#harga_per_ton"+counter).val(data.hrg_beli);
					updateTotaldiskon();
				}, 'json');
			}

	function hitungDiskon(value)
	{
			var subtotal = parseFloat($("#subtotal").val());
			var diskon = parseFloat(value);
			if (diskon)
			{
				diskon = diskon;
			}
			else
			{
				diskon = 0;
			}
			var total_harga = parseFloat(subtotal-diskon);
			var totalvalue = parseFloat(total_harga);
			//$("#ppn").val(Math.round(0.1*(Number(subtotal)-Number($("#diskontop").val())-Number($("#diskonprogram").val()))));
			$(hargatotal).val(0);
			$(hargatotal).val(Math.round(totalvalue.toFixed(2)));
	}
	function hitungPajak(value)
	{
			var subtotal = parseFloat($("#hargatotal").val());
			var pajak = value;
			var denganpajak = 0;
			if (pajak.checked)
			{
				denganpajak = 0.1*subtotal + subtotal;
			}
			else
			{
				denganpajak = subtotal;
			}
			//alert(pajak.checked);
			//$("#ppn").val(Math.round(0.1*(Number(subtotal)-Number($("#diskontop").val())-Number($("#diskonprogram").val()))));
			$("#hargatotalpajak").val(0);
			$("#hargatotalpajak").val(Math.round(denganpajak.toFixed(2)));
	}

</script>
<script type="text/javascript" src="lib/jquery-latest.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function($){
		$("#no_po").focus();
		$('.container .plus').click(function(){
		var counter = $('.pembelian').length + 1;
		var thnvalue = <?php echo date('Y');?>;
        var add_pembelian = $('<p align="center" class="pembelian">'+
						'<table>'+
						  '<tr>'+
	            '<td><div align="left"><strong>No. Tiket</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="no_tiket'+counter+'" class="no_tiket'+counter+'" name="no_tiket[]" type="text" value="" onBlur="setHarga(this)"></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>No. Polisi</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="no_polisi'+counter+'" class="no_polisi'+counter+'" name="no_polisi[]" type="text" value=""></td>'+
						  '</tr>'+
							'<tr>'+
							'<td><div align="left"><strong>Nama Supir</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="nama_supir'+counter+'" class="nama_supir'+counter+'" name="nama_supir[]" type="text" value=""></td>'+
						'</tr>'+
						'<tr>'+
						  '<td><div align="left"><strong>Nama Barang</strong></div></td>'+
						  '<td>'+
						  '<input style="height: 30px;margin-bottom: 0px" type="text" id="nama_barang'+counter+'" class="nama_barang'+counter+'"  name="nama_barang[]" value="" onBlur="setHargaBarang(this)" required>'+
						  '</td>'+
							'<td><div align="left" style="margin-left: 20px"><strong>Kualitas</strong></div></td>'+
							'<td><input style="height: 30px;margin-bottom: 0px" type="text" id="kualitas'+counter+'" class="kualitas'+counter+'"  name="kualitas[]" value="" onBlur="setHargaBarang(this)" required></td>'+
						  '</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'</tr>'+
							'<tr>'+
							'<td><strong>Berat(Kg)</strong></td>'+
						  '</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'</tr>'+
						  '<tr>'+
						  '<td><div align="left"><strong>Gross</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="berat_gross+'+counter+'" class="berat_gross'+counter+'" name="berat_gross[]" type="text" value=""></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>Tare</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="berat_tare'+counter+'" class="berat_tare'+counter+'" name="berat_tare[]" type="text" value=""></td>'+
							'<td><div align="left" style="margin-left: 20px"><strong>Netto</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="berat_netto'+counter+'" class="berat_netto'+counter+'" name="berat_netto[]" type="text" value="" onKeyUp="updateTotaldiskon()"></td>'+
							'</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'</tr>'+
							'<tr>'+
							'<td><strong>Jam</strong></td>'+
						  '</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'</tr>'+
							'<tr>'+
						  '<td><div align="left"><strong>In</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="jam_in'+counter+'" class="jam_in'+counter+'" name="jam_in[]" type="text" value=""></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>Out</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="jam_out'+counter+'" class="jam_out'+counter+'" name="jam_out[]" type="text" value=""></td>'+
							'</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'</tr>'+
							'<tr>'+
							'<td><strong>Tanggal</strong></td>'+
						  '</tr>'+
							'<tr>'+
							'<td>&nbsp;</td>'+
							'<tr>'+
							'</tr>'+
						  '<td><div align="left"><strong>In</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="tgl_in'+counter+'" class="tgl_in'+counter+'" name="tgl_in[]" type="text" value=""></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>Out</strong></div></td>'+
						  '<td><input style="height: 30px;margin-bottom: 0px" id="tgl_out'+counter+'" class="tgl_out'+counter+'" name="tgl_out[]" type="text" value=""></td>'+
							'</tr>'+
							'<tr>'+
	            '<td><div align="left"><strong>Harga per Ton</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="harga_per_ton[]" type="text" id="harga_per_ton'+counter+'" value="0" class="harga_per_ton'+counter+'" onKeyUp="updateTotaldiskon()"></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>Total Harga</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="total_harga[]" type="text" id="total_harga'+counter+'" value="0" class="total_harga'+counter+'" ></td>'+
							'<td><div align="left" style="margin-left: 20px"><strong>Pembulatan</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="pembulatan[]" type="text" id="pembulatan'+counter+'" value="0" class="pembulatan'+counter+'" ></td>'+
							'</tr>'+
							'<tr>'+
	            '<td><div align="left"><strong>Nominal yang dibayar</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="nominal_yg_dibayar[]" type="text" id="nominal_yg_dibayar'+counter+'" value="0" class="nominal_yg_dibayar'+counter+'"></td>'+
						  '<td><div align="left" style="margin-left: 20px"><strong>No. BAPB</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="no_bapb[]" type="text" id="no_bapb'+counter+'" value="" class="no_bapb'+counter+'"></td>'+
							'<td><div align="left" style="margin-left: 20px"><strong>Keterangan</strong></div></td>'+
	            '<td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="keterangan[]" type="text" id="keterangan'+counter+'" value="" class="keterangan'+counter+'"></td>'+
							'</tr>'+
                      '<a class="minus" href="#">[Hapus Item]</a></td>'+
	                      '</tr>'+
						  '</table>'+
							'</p>'
					);
        add_pembelian.hide();
        $('.container p.pembelian:last').after(add_pembelian);
        add_pembelian.fadeIn('slow');
				var picker = new Pikaday({
						field: document.getElementById('tgl_in'+counter),
				format : "DD-MM-YYYY",
				});
				var picker = new Pikaday({
						field: document.getElementById('tgl_out'+counter),
				format : "DD-MM-YYYY",
				});
		updateTotaldiskon();
		document.getElementById("tambahline").innerHTML=(Number(document.getElementById("tambahline").innerHTML)+1)
        return false;
    });
    $('.container').on('click', '.minus', function(){
		var counter = $('.pembelian').length - 1;
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
		updateTotaldiskon();
		document.getElementById("tambahline").innerHTML=(Number(document.getElementById("tambahline").innerHTML)-1)

        });
        return false;
    });
});
</script>

<?php
	if(isset($_POST['no_po']))
		{
			$no_po=mysql_real_escape_string($_POST['no_po']);
			$tgl_po=mysql_real_escape_string($_POST['tgl_po']);
			$nama_supplier=mysql_real_escape_string($_POST['nama_supplier']);
			$tgl_po=strtotime($tgl_po);
			$tgl_po=date('Y-m-d H:i:s', $tgl_po);
			$term_of_payment=$_POST['term_of_payment'][$i];
			$tgl_jatuh_tempo = date('Y-m-d H:i:s', strtotime($tgl_po . ' + ' . $term_of_payment . ' days'));
			$subtotal = mysql_real_escape_string($_POST['subtotal']);
			$diskon = mysql_real_escape_string($_POST['diskon']);
			$sistem_bayar = mysql_real_escape_string($_POST['sistem_bayar']);
			$metodebayar = mysql_real_escape_string($_POST['metodebayar']);
			$dengan_pajak = mysql_real_escape_string($_POST['denganpajak']);
			$hargatotal = mysql_real_escape_string($_POST['hargatotal']);
			$harga_dengan_pajak = mysql_real_escape_string($_POST['hargatotalpajak']);
			$username = $_SESSION['LOGIN_NAME'];
			$kd_beban_hutang = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Hutang Dagang'");
			$kd_beban_kas = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Kas'");
			$kd_beban_bank = $db->queryUniqueValue("select kd_beban from groupbiaya where nm_beban='Bank'");
			$i=0;
			$no_tiket_line=$_POST['no_tiket'];
			$line = 0;
			foreach($no_tiket_line as $no_tikets)
			{
			$no_tiket=$_POST['no_tiket'][$i];
			$no_polisi=$_POST['no_polisi'][$i];
			//$nama_supplier=$_POST['nama_supplier'][$i];
			$nama_barang=$_POST['nama_barang'][$i];
			$kualitas=$_POST['kualitas'][$i];
			$nama_supir=$_POST['nama_supir'][$i];
			$berat_gross=$_POST['berat_gross'][$i];
			$berat_tare=$_POST['berat_tare'][$i];
			$berat_netto=$_POST['berat_netto'][$i];
			$jam_in=$_POST['jam_in'][$i];
			$jam_out=$_POST['jam_out'][$i];
			$tgl_in=mysql_real_escape_string($_POST['tgl_in'][$i]);
			$tgl_in=strtotime($tgl_in);
			$tgl_in=date('Y-m-d', $tgl_in);
			$tgl_out=mysql_real_escape_string($_POST['tgl_out'][$i]);
			$tgl_out=strtotime($tgl_out);
			$tgl_out=date('Y-m-d', $tgl_out);
			$harga_per_ton=$_POST['harga_per_ton'][$i];
			$total_harga=$_POST['total_harga'][$i];
			$pembulatan=$_POST['pembulatan'][$i];
			$nominal_yg_dibayar=$_POST['nominal_yg_dibayar'][$i];
			$no_bapb=$_POST['no_bapb'][$i];
			$keterangan=$_POST['keterangan'][$i];
			//$hargabelicek = $db->queryUniqueValue("select hrg_beli from hrgbeli where nama_barang='$nama_barang' and kualitas='$kualitas' and tgl_akhir>=now() and tgl_awal<=now() order by tgl_awal desc");
			//if ($harga_per_ton!=$hargabelicek)
			//{
			//echo "<div style='background-color:red;'><br><font color=white size=+1 >Maaf Data yang anda masukkan berbeda dengan Master</font></div> ";
			//echo "<script>window.location.assign('masteringpembelian.php');</script>";
			//}
			//else
			//{
				$line = $line + 1;
				$db->query("insert into pembelian_detail (line,no_tiket,no_polisi,nama_supplier,nama_barang,kualitas,no_po,tgl_po,nama_supir,berat_gross,berat_tare,berat_netto,jam_in,jam_out,tgl_in,tgl_out,harga_per_ton,total_harga,pembulatan,nominal_yg_dibayar,no_bapb,keterangan,sistem_bayar,username,tgl_transaksi) values($line,'$no_tiket','$no_polisi','$nama_supplier','$nama_barang','$kualitas','$no_po','$tgl_po','$nama_supir',$berat_gross,$berat_tare,$berat_netto,'$jam_in','$jam_out','$tgl_in','$tgl_out',$harga_per_ton,$total_harga,$pembulatan,$nominal_yg_dibayar,'$no_bapb','$keterangan','$sistem_bayar','$username',NOW())");
				$db->query("insert into persediaan (no_po,tgl_po,nama_barang,debit,username,tgl_transaksi) values('$no_po','$tgl_po','$nama_barang',$nominal_yg_dibayar,'$username',NOW())");
				$db->query("insert into stok(status,no_po,tgl_po,jam_in,tgl_in,nama_barang,berat_netto_in,username,tgl_transaksi) VALUES('IN','$no_po','$tgl_po','$jam_in','$tgl_in','$nama_barang',$berat_netto,'$username',NOW())");
			//}
			$i++;
			}
			//if ($harga_per_ton!=$hargabelicek)
			//{
			//echo "<div style='background-color:red;'><br><font color=white size=+1 >Maaf Data yang anda masukkan berbeda dengan Master</font></div> ";
			//echo "<script>window.location.assign('masteringpembelian.php');</script>";
			//}
			//else
			//{
				if ($sistem_bayar=='CASH')
				{
				$no_hutang = 'H.' . $no_po;
				$db->execute("INSERT INTO hutang(no_hutang,nama_supplier,no_po,tgl_po,subtotal,diskon,hargatotal,harga_dengan_pajak,kredit,username,tgl_transaksi) values ('$no_hutang','$nama_supplier','$no_po','$tgl_po',$subtotal,$diskon,$hargatotal,$harga_dengan_pajak,$harga_dengan_pajak,'$username',NOW())");
				$db->execute("INSERT INTO hutang(no_hutang,nama_supplier,no_po,tgl_po,subtotal,diskon,hargatotal,harga_dengan_pajak,debit,username,tgl_transaksi) values ('$no_hutang','$nama_supplier','$no_po','$tgl_po',$subtotal,$diskon,$hargatotal,$harga_dengan_pajak,$harga_dengan_pajak,'$username',NOW())");
				if ($metodebayar==1)
				{
				$no_kas = 'K.' . $no_po;
				$keterangan = 'Pembelian ' . $nama_barang;
				$db->query("insert into kas (no_kas,no_po,tgl_po,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_po','$tgl_po',NOW(),'$keterangan','$kd_beban_kas',$harga_dengan_pajak,'$username',NOW())");
				}
				elseif ($metodebayar==2)
				{
				$no_kas = 'K.' . $no_po;
				$keterangan = 'Pembelian ' . $nama_barang;
				$db->query("insert into kas (no_kas,no_po,tgl_po,tgl_keluar,keterangan,kd_beban,kredit,username,tgl_transaksi) values('$no_kas','$no_po','$tgl_po',NOW(),'$keterangan','$kd_beban_kas',$harga_dengan_pajak,'$username',NOW())");
				}
				$db->execute("INSERT INTO pembelian(no_po,tgl_po,nama_supplier,subtotal,diskon,hargatotal,dengan_pajak,harga_dengan_pajak,sistem_bayar,username,tgl_transaksi,tgl_lunas) values ('$no_po','$tgl_po','$nama_supplier',$subtotal,$diskon,$hargatotal,'$dengan_pajak',$harga_dengan_pajak,'CASH','$username',NOW(),NOW())");
				echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pembelian dengan No. PO [ $no_po ] Berhasil Ditambahkan</font></div> ";
				echo "<script>window.location.assign('masteringpembelian.php');</script>";
				}
				elseif ($sistem_bayar=='TEMPO')
				{
				$no_hutang = 'H.' . $no_po;
				$db->execute("INSERT INTO hutang(no_hutang,nama_supplier,no_po,tgl_po,term_of_payment,tgl_jatuh_tempo,subtotal,diskon,hargatotal,harga_dengan_pajak,kredit,username,tgl_transaksi) values ('$no_hutang','$nama_supplier','$no_po','$tgl_po','$term_of_payment','$tgl_jatuh_tempo',$subtotal,$diskon,$hargatotal,$harga_dengan_pajak,$harga_dengan_pajak,'$username',NOW())");
				$db->execute("INSERT INTO pembelian(no_po,tgl_po,nama_supplier,subtotal,diskon,hargatotal,dengan_pajak,harga_dengan_pajak,sistem_bayar,username,tgl_transaksi) values ('$no_po','$tgl_po','$nama_supplier',$subtotal,$diskon,$hargatotal,'$dengan_pajak',$harga_dengan_pajak,'TEMPO','$username',NOW())");
				echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pembelian dengan No. PO [ $no_po ] Berhasil Ditambahkan</font></div> ";
				echo "<script>window.location.assign('masteringpembelian.php');</script>";
				}
			//}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="pembelian" method="post" action="">
	<p align="center"><font size="3"><strong>Pencatatan Pembelian</strong></font></p>
	<?php $tambahline = 1;?>
		<p align="center">
		<table>
            <tr>
						<td><div align="left"><strong>Nama Supplier</strong></div></td>
			      <td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_supplier" class="nama_supplier"  name="nama_supplier" value="" onfocus="setSupplier(this)" required></td>
					  <td><div align="left" style="margin-left: 20px"><strong>No. Purchasing</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" name="no_po" type="text" id="no_po" value="<?php $maxterima = $db->queryUniqueValue("select MAX(CAST(no_po AS SIGNED)) as no_po from pembelian"); if ($maxterima == NULL) {$maxterima = 1; echo $maxterima;} else {$maxterimabaru = $maxterima + 1; echo $maxterimabaru;} ?>"></td>
					  <td><div align="left" style="margin-left: 20px"><strong>Tanggal Purchasing</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_po" name="tgl_po" value="<?php echo date('d-m-Y');?>"></td>

						</tr>
						<tr>
						<td><div align="left"><strong>Term of Payment</strong></div></td>
						<td><input style="height: 30px;margin-bottom: 0px" id="term_of_payment" class="term_of_payment" name="term_of_payment" type="text" value=""></td>
						</tr>
            </table>
				   </p>
				  <div class="container">
				  <p align="center" class="pembelian">
					<table>
					  <tr>
            <td><div align="left"><strong>No. Tiket</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="no_tiket1" class="no_tiket1" name="no_tiket[]" type="text" value="" onBlur="setHarga(this)"></td>
					  <td><div align="left" style="margin-left: 20px"><strong>No. Polisi</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="no_polisi1" class="no_polisi1" name="no_polisi[]" type="text" value=""></td>
					  </tr>
						<tr>
						<td><div align="left"><strong>Nama Supir</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="nama_supir1" class="nama_supir1" name="nama_supir[]" type="text" value=""></td>

					</tr>
					<tr>
					  <td><div align="left"><strong>Nama Barang</strong></div></td>
					  <td>
					  <input style="height: 30px;margin-bottom: 0px" type="text" id="nama_barang1" class="nama_barang1"  name="nama_barang[]" value="" onBlur="setHargaBarang(this)" required>
					  </td>
						<td><div align="left" style="margin-left: 20px"><strong>Kualitas</strong></div></td>
						<td><input style="height: 30px;margin-bottom: 0px" type="text" id="kualitas1" class="kualitas1"  name="kualitas[]" value="" onBlur="setHargaKualitas(this)" required></td>
					  </tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td><strong>Berat(Kg)</strong></td>
					  </tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
					  <tr>
					  <td><div align="left"><strong>Gross</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="berat_gross1" class="berat_gross1" name="berat_gross[]" type="text" value=""></td>
					  <td><div align="left" style="margin-left: 20px"><strong>Tare</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="berat_tare1" class="berat_tare1" name="berat_tare[]" type="text" value=""></td>
						<td><div align="left" style="margin-left: 20px"><strong>Netto</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="berat_netto1" class="berat_netto1" name="berat_netto[]" type="text" value="" onKeyUp="updateTotaldiskon()"></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td><strong>Jam</strong></td>
					  </tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
					  <td><div align="left"><strong>In</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="jam_in1" class="jam_in1" name="jam_in[]" type="text" value=""></td>
					  <td><div align="left" style="margin-left: 20px"><strong>Out</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="jam_out1" class="jam_out1" name="jam_out[]" type="text" value=""></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td><strong>Tanggal</strong></td>
					  </tr>
						<tr>
						<td>&nbsp;</td>
						<tr>
						</tr>
					  <td><div align="left"><strong>In</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="tgl_in1" class="tgl_in1" name="tgl_in[]" type="text" value=""></td>
					  <td><div align="left" style="margin-left: 20px"><strong>Out</strong></div></td>
					  <td><input style="height: 30px;margin-bottom: 0px" id="tgl_out1" class="tgl_out1" name="tgl_out[]" type="text" value=""></td>
						</tr>
						<tr>
            <td><div align="left"><strong>Harga per Ton</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="harga_per_ton[]" type="text" id="harga_per_ton1" value="0" class="harga_per_ton1" onKeyUp="updateTotaldiskon()"></td>
					  <td><div align="left" style="margin-left: 20px"><strong>Total Harga</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="total_harga[]" type="text" id="total_harga1" value="0" class="total_harga1" ></td>
						<td><div align="left" style="margin-left: 20px"><strong>Pembulatan</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="pembulatan[]" type="text" id="pembulatan1" value="0" class="pembulatan1" ></td>
						</tr>
						<tr>
            <td><div align="left"><strong>Nominal yang dibayar</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="nominal_yg_dibayar[]" type="text" id="nominal_yg_dibayar1" value="0" class="nominal_yg_dibayar1"></td>
					  <td><div align="left" style="margin-left: 20px"><strong>No. BAPB</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="no_bapb[]" type="text" id="no_bapb1" value="" class="no_bapb1"></td>
						<td><div align="left" style="margin-left: 20px"><strong>Keterangan</strong></div></td>
            <td><input style="height: 30px;margin-bottom: 0px;text-align:right" name="keterangan[]" type="text" id="keterangan1" value="" class="keterangan1"></td>
						</tr>
					  <label id="tambahline"><?php echo $tambahline;?></label>
                      <a class="plus" href="#">[Tambah Item]</a></td>
                      </tr>
					  </table>
					  </p>
					  </div>
					  <p align="center">
					  <table>
						<tr><td><strong>Sistem Bayar</strong></td><td><select style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="sistem_bayar" required><option value="">Tidak ada</option><option value="CASH">Cash</option><option value="TEMPO">Tempo</option></td></tr>
						<tr><td><strong>Pembayaran</strong></td><td><select style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="metodebayar"><option value="">Tidak ada</option><option value=1>Kas</option><option value=2>Bank</option></select></td></tr>
						<tr>
					    <td><strong>Sub Total</strong></td>
					    <td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="subtotal" id="subtotal" type="text" readonly=""></td>
					  </tr>
					  <tr>
					    <td><strong>Diskon</strong></td>
					    <td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="diskon" id="diskon" type="text" onKeyUp="hitungDiskon(this.value)"  value="0"></td>
					  </tr>
						<tr>
					    <td><strong>Dengan Pajak</strong></td>
					    <td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="denganpajak" id="denganpajak" type="checkbox" onChange="hitungPajak(this)"></td>
					  </tr>
					  <tr>
					    <td><strong>Harga Beli Total</strong></td>
					    <td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="hargatotal" id="hargatotal" type="text" readonly=""></td>
					  </tr>
						<tr>
					    <td><strong>Harga Beli dengan Pajak</strong></td>
					    <td><input style="height: 30px;margin-bottom: 0px;margin-left: 20px;text-align:right" name="hargatotalpajak" id="hargatotalpajak" type="text" readonly=""></td>
					  </tr>
					  </table>
					  <br/>
					  <table>
					  <tr>
                        <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringpembelian.php");'></td>
                        <td><input type="button" style="height:50px;width:100px" name="Reset" value="Reset" onclick='window.location.reload(true);'></td>
					    <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
					  </tr>
					</table>
				</form>
			</td>
		</tr>
</table>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
function setSupplier(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_supplier').autocomplete("check_supplier.php", {
	        selectFirst: true});
		}
</script>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_po'),
		format : "DD-MM-YYYY",
    });
		var picker = new Pikaday({
				field: document.getElementById('tgl_in1'),
		format : "DD-MM-YYYY",
		});
		var picker = new Pikaday({
				field: document.getElementById('tgl_out1'),
		format : "DD-MM-YYYY",
		});
</script>
