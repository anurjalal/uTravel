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
<?php startblock('konten')?>
<script src="jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	function setHarga(){
						var jumlah = document.getElementById("jumlah").value;
						var jumlahanak = document.getElementById("jumlahanak").value;
						var jumlah_kamar = document.getElementById("jumlah_kamar").value;
						var hargahotel = document.getElementById("hargahotel").value;
						var malam = document.getElementById("malam").value;
						var hargabeli = document.getElementById("hargabeli").value;
						var hargabelireturn = document.getElementById("hargabelireturn").value;
						var hargaanakreturn = document.getElementById("hargaanakreturn").value;
						var hargaanak = document.getElementById("hargaanak").value;
						var hargabagasi = document.getElementById("hargabagasi").value;
						var hargabagasireturn = document.getElementById("hargabagasireturn").value;
						var returnku = document.getElementById("return");
						var extra = document.getElementById("extra");
						var tgl_out = document.getElementById("tgl_out").value;
						var tipe = document.getElementById("tipe").value;
						if(tipe=='pesawat' || tipe == 'kereta'){
							if (returnku.checked == true){
								if(extra.checked == true){
									var total = ((Number(hargabeli)+Number(hargabelireturn)) * Number(jumlah)) + ((Number(hargaanak)+Number(hargaanakreturn))* Number(jumlahanak)) + Number(hargabagasi) + Number(hargabagasireturn);
								}
								else if(extra.checked == false){
									var total = ((Number(hargabeli)+Number(hargabelireturn)) * Number(jumlah)) + ((Number(hargaanak)+Number(hargaanakreturn))* Number(jumlahanak));
								}
								} else if (returnku.checked == false){
								if(extra.checked == true){
									var total = (Number(hargabeli)* Number(jumlah)) + (Number(hargaanak)* Number(jumlahanak)) + Number(hargabagasi);
								}
								else if(extra.checked == false){
									var total = (Number(hargabeli)* Number(jumlah)) + (Number(hargaanak)* Number(jumlahanak));
								}
							}
						$("#hargabelitotal").val(total);
						}

						else if (tipe=='hotel'){
						var total = Number(hargahotel)*Number(jumlah_kamar)*Number(malam);
						$("#hargabelitotal").val(total);
						}
	
}

function runSetHarga(){
 $("#jumlahanak, #jumlah_kamar,#hargahotel, #malam, #hargabeli, #hargabelireturn, #hargaanakreturn, #hargaanak, #hargabagasi, #hargabagasireturn").keyup(function () {
 	setHarga();
					
						});
$("#return, #extra, #tipe").click(function(){
	setHarga();
});
}		
</script>

<?php
if(isset($_POST['no_penjualan']))
	{
		$username = $_SESSION['LOGIN_NAME'];

		$nama_customer=mysql_real_escape_string($_POST['nama_customer']);
		$jumlah_customer = $db->queryUniqueValue("select count(id_customer) from customer where nama_customer='$nama_customer'");
		if ($jumlah_customer==0)
		{
		$db->query("insert into customer (nama_customer) values('$nama_customer')");
		}
		$id_customer = $db->queryUniqueValue("select id_customer from customer where nama_customer='$nama_customer'");
		$no_penjualan=mysql_real_escape_string($_POST['no_penjualan']);
		$no_penjualan_asli=mysql_real_escape_string($_POST['no_penjualan_asli']);
		$tgl_penjualan=mysql_real_escape_string($_POST['tgl_penjualan']);
		$tgl_penjualan=strtotime($tgl_penjualan);
		$tgl_penjualan=date('Y-m-d H:i:s', $tgl_penjualan);
		$tipe=mysql_real_escape_string($_POST['tipe']);
		$jumlah=mysql_real_escape_string($_POST['jumlah']);
		$anak=mysql_real_escape_string($_POST['jumlahanak']);
		$asal=mysql_real_escape_string($_POST['asal']);
		$tujuan=mysql_real_escape_string($_POST['tujuan']);
		$nama_maskapai=mysql_real_escape_string($_POST['nama_maskapai']);
		$kelas=mysql_real_escape_string($_POST['kelas']);
		$nama_hotel=mysql_real_escape_string($_POST['nama_hotel']);
		$malam= mysql_real_escape_string($_POST['malam']);
		$jumlah_kamar = mysql_real_escape_string($_POST['jumlah_kamar']);
		$jenis_kamar = mysql_real_escape_string($_POST['jenis_kamar']);
		$supplier = mysql_real_escape_string($_POST['supplier']);
		$hargabagasi = mysql_real_escape_string($_POST['hargabagasi']);
		$return=(isset($_POST['return']) ? 'y' : 'n');
		$extra=(isset($_POST['extra']) ? 'y' : 'n');
		$hargahotel=mysql_real_escape_string($_POST['hargahotel']);
			$kereta=mysql_real_escape_string($_POST['kereta']);
			$tgl_in=mysql_real_escape_string($_POST['tgl_in']);
	   		$tgl_in=strtotime($tgl_in);
			$tgl_in=date('Y-m-d H:i:s', $tgl_in);
			$jam_in=mysql_real_escape_string($_POST['jam_in']);
	   		$jam_in=strtotime($jam_in);
			$jam_in=date('H:i', $jam_in);
			$hargabelireturn = mysql_real_escape_string($_POST['hargabelireturn']);
			$hargaanakreturn = mysql_real_escape_string($_POST['hargaanakreturn']);
			$hargabagasireturn = mysql_real_escape_string($_POST['hargabagasireturn']);
			if (mysql_real_escape_string($_POST['tgl_out']))
			{
			$tgl_out=mysql_real_escape_string($_POST['tgl_out']);
			$tgl_out=strtotime($tgl_out);
			$tgl_out=date('Y-m-d H:i:s', $tgl_out);
			$jam_out=mysql_real_escape_string($_POST['jam_out']);
	   		$jam_out=strtotime($jam_out);
			$jam_out=date('H:i', $jam_out);
			}
			else
			{
			$tgl_out = "";
			}
		$keterangan=mysql_real_escape_string($_POST['keterangan']);
		$no_po=mysql_real_escape_string($_POST['no_po']);
		$no_po_asli=mysql_real_escape_string($_POST['no_po_asli']);
		$tgl_po=mysql_real_escape_string($_POST['tgl_po']);
		$tgl_po=strtotime($tgl_po);
		$tgl_po=date('Y-m-d H:i:s', $tgl_po);
		$tgl_jatuh_tempo=mysql_real_escape_string($_POST['tgl_jatuh_tempo']);
		$tgl_jatuh_tempo=strtotime($tgl_jatuh_tempo);
		$tgl_jatuh_tempo=date('Y-m-d H:i:s', $tgl_jatuh_tempo);
		$nama_supplier=mysql_real_escape_string($_POST['nama_supplier']);
		$id_supplier = $db->queryUniqueValue("select id_supplier from supplier where nama_supplier='$nama_supplier'");
		$hargabeli=mysql_real_escape_string($_POST['hargabeli']);
		$hargaanak=mysql_real_escape_string($_POST['hargaanak']);
		if ($hargaanak=='')
		{
			$hargaanak = 0;
		}
		$totalan=(isset($_POST['totalan']) ? 'y' : 'n');
		$hargahotel=mysql_real_escape_string($_POST['hargahotel']);
			if ($hargahotel=='')
			{
				$hargahotel = 0;
			}
		$hargabelitotal=mysql_real_escape_string($_POST['hargabelitotal']);
		// $no_invoice=mysql_real_escape_string($_POST['no_invoice']);
		$tgl_invoice=mysql_real_escape_string($_POST['tgl_invoice']);
		$tgl_invoice=strtotime($tgl_invoice);
		$tgl_invoice=date('Y-m-d H:i:s', $tgl_invoice);
		if($tipe=='hotel'){
			$hotel = 'Y';
			$jumlah = '';
			$anak = '';
			$asal = '';
			$tujuan = '';
			$nama_maskapai='';
			$kelas = '';
			$tgl_out = '';
			$return = '';
			$hargabeli = '';
			$hargaanak = '';
			$hargabagasi = '';
			$extra = '';
			}
			else if($tipe == 'pesawat' || $tipe == 'kereta'){
			$nama_hotel = '';
			$malam = '';
			$jumlah_kamar= '';
			$jenis_kamar = '';
			$hargahotel = '';
			if ($return == 'n'){
				$tgl_out = '';
				$jam_out = '';
				$hargabelireturn = '';
			$hargaanakreturn = '';
			$hargabagasireturn = '';

			}
				else{
					$hargabelireturn = mysql_real_escape_string($_POST['hargabelireturn']);
			$hargaanakreturn = mysql_real_escape_string($_POST['hargaanakreturn']);
			$hargabagasireturn = mysql_real_escape_string($_POST['hargabagasireturn']);
					mysql_real_escape_string($_POST['tgl_out']);
				}
			}
		$db->query("delete from penjualan where no_penjualan='$no_penjualan_asli'");
		$db->query("delete from pembelian where no_po='$no_po_asli'");
		$db->query("delete from hutang where no_po='$no_po_asli'");
		$db->execute("INSERT INTO pembelian(no_po,no_penjualan,tgl_po,tgl_jatuh_tempo,hargabeli,hargaanak,hargabagasi,nama_hotel,hargahotel,hargabelitotal,nama_maskapai,id_supplier,nama_supplier,tgl_invoice,hargabelireturn,hargaanakreturn,hargabagasireturn,username,tgl_transaksi) values ('$no_po','$no_penjualan','$tgl_po','$tgl_jatuh_tempo','$hargabeli','$hargaanak','$hargabagasi','$nama_hotel','$hargahotel','$hargabelitotal','$nama_maskapai','$id_supplier','$nama_supplier','$tgl_invoice','$hargabelireturn','$hargaanakreturn','$hargabagasireturn','$username',NOW())");
			$db->execute("INSERT INTO hutang(no_po,tgl_po,id_supplier,nama_supplier,tgl_jatuh_tempo,jml_hutang,kredit,username,tgl_transaksi) values ('$no_po','$tgl_po','$id_supplier','$supplier','$tgl_jatuh_tempo','$hargabelitotal','$hargabelitotal','$username',NOW())");
			$db->execute("INSERT INTO penjualan(no_penjualan,tgl_penjualan,id_customer,nama_customer,tgl_in,tgl_out,jam_in,jam_out,kembali,tipe,jumlah,jumlahanak,asal,tujuan,hotel,nama_hotel,malam,jumlah_kamar,jenis_kamar,nama_maskapai,extra,kelas,no_po,keterangan,hargabelireturn,hargaanakreturn,hargabagasireturn,username,tgl_transaksi) values ('$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer','$tgl_in','$tgl_out','$jam_in','$jam_out','$return','$tipe','$jumlah','$anak','$asal','$tujuan','$hotel','$nama_hotel','$malam','$jumlah_kamar','$jenis_kamar','$nama_maskapai','$extra','$kelas','$no_po','$keterangan','$hargabelireturn','$hargaanakreturn','$hargabagasireturn','$username',NOW())");

		echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pesanan dengan No. Pesanan [ $no_penjualan ] Berhasil Ditambahkan</font></div> ";
		echo "<script>window.location.assign('masteringpesanan.php');</script>";
		//}
	}

?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penjualan" method="post" action="">
	<p align="center"><font size="3"><strong>Memo Pembelian</strong></font></p>
	<?php
	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$line = $db->queryUniqueObject("SELECT * FROM penjualan WHERE no_penjualan='$id'");
	$line2 = $db->queryUniqueObject("SELECT * FROM pembelian WHERE no_penjualan='$id'");
	}

	if ($line->tipe == 'hotel'){
	?>
<style type="text/css">
#nhargabelireturn{display:none;}
#hargabelireturn{display:none;}
#nhargaanakreturn{display:none;}
#hargaanakreturn{display:none;}
#nhargabagasireturn{display:none;}
#hargabagasireturn{display:none;}
#jumlah{display:none;}
#dws{display:none;}
#jumlahanak{display:none;}
#ank{display:none;}
#tglout{display:none;}
#tgl_out{display:none;}
#nama_maskapai{display:none;}
#mskp{display:none;}
#asal{display:none;}
#asl{display:none;}
#tujuan{display:none;}
#tjn{display:none;}
#class{display:none;}
#kelas{display:none;}
#semuareturn{display:none;}
#semuaextra{display:none;}
#hargabeli{display:none;}
#nhargabeli{display:none;}
#hargaanak{display:none;}
#nhargaanak{display:none;}
/*#nama_hotel{display:show;}
#malam{display:show;}
#nhotel{display:show;}
#nmalam{display:show;}
#jk{display:show;}
#jumlah_kamar{display:show;}
#je{display:show;}
#jenis_kamar{display:show;}*/

</style>
<?php
} else if ($line->tipe == 'pesawat' || $line->tipe == 'kereta')
{ 
?>
<style type="text/css">
/*#jumlah{display:none;}
#dws{display:none;}
#jumlahanak{display:none;}
#ank{display:none;}
#tglout{display:none;}
#tgl_out{display:none;}
#nama_maskapai{display:none;}
#mskp{display:none;}
#asal{display:none;}
#asl{display:none;}
#tujuan{display:none;}
#tjn{display:none;}
#class{display:none;}
#kelas{display:none;}
#semuareturn{display:none;}
#semuaextra{display:none;}*/

#nama_hotel{display:none;}
#malam{display:none;}
#nhotel{display:none;}
#nmalam{display:none;}
#jk{display:none;}
#jumlah_kamar{display:none;}
#je{display:none;}
#jenis_kamar{display:none;}
#nhargahotel{display:none;}
#hargahotel{display:none;}

<?php 
if($line->kembali != 'y'){ ?>
#tglout{display:none;}
#tgl_out{display:none;}
#nhargabelireturn{display:none;}
#hargabelireturn{display:none;}
#nhargaanakreturn{display:none;}
#hargaanakreturn{display:none;}
#nhargabagasireturn{display:none;}
#hargabagasireturn{display:none;}
<?php } ?>
</style>
<?php
}
	?>
		<p align="center">
			<table>
			        <tr>
			        <td><div align="left"><strong>Nama Customer</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_customer" class="nama_customer"  name="nama_customer" value="<?php echo $line->nama_customer; ?>" onfocus="setCustomer(this)" ></td>
			        <td><div align="left" style="margin-left: 20px"><strong>No. Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" name="no_penjualan" type="text" id="no_penjualan" value="<?php echo $line->no_penjualan; ?>" readonly></td>
							<input name="no_penjualan_asli" type="hidden" id="no_penjualan_asli" value="<?php echo $line->no_penjualan; ?>">
							<input name="no_po_asli" type="hidden" id="no_po_asli" value="<?php echo $line2->no_po; ?>">
							<td><div align="left" style="margin-left: 20px"><strong>Tanggal Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('d-m-Y',strtotime($line->tgl_penjualan)); ?>" readonly></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Jenis Pembelian</strong></div></td>
			        <td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right" name="tipe" id="tipe" class="tipe" required onload="runSetHarga()" onclick="runSetHarga()">
			        <option value="">Tidak ada</option>
			        <option value="pesawat"<?php if ($line->tipe=='pesawat') {echo "selected";}?>>Pesawat</option>
			        <option value="kereta"<?php if ($line->tipe=='kereta') {echo "selected";}?>>Kereta</option>
			        <option value="hotel"<?php if ($line->tipe=='hotel') {echo "selected";}?>>Hotel</option>
						</select>
			        </td>
					<td><div align="left" style="margin-left: 20px" id="dws"><strong>Dewasa</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jumlah" class="jumlah" name="jumlah" type="text" value="<?php echo $line->jumlah; ?>" onkeyup="setHarga()"></td>

					<td><div align="left" style="margin-left: 20px" id="ank"><strong>Anak</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jumlahanak" class="jumlahanak" name="jumlahanak" type="text" value="<?php echo $line->jumlahanak; ?>" onkeyup="setHarga()"></td>
			        </tr>
				<tr>
					 <td><div align="left"><strong>Tanggal In</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tgl_in" class="tgl_in" name="tgl_in" type="text" value="<?php echo date('d-m-Y', strtotime($line->tgl_in)); ?>"></td>

				<td><div align="left" id="tglout" name="tglout" <?php if ($line->kembali=='y') {echo '';} else {echo 'style="margin-left: 20px;display:none"';}?>><strong>Tanggal Out</strong></div></td>
			        <td><input  id="tgl_out" class="tgl_out" name="tgl_out" type="text" value="<?php if ($line->kembali=='y') {echo date('d-m-Y', strtotime($line->tgl_out));} else { echo date('d-m-Y', strtotime('now'));} ?>"  <?php if ($line->kembali=='y') {echo 'style="height: 30px;margin-bottom: 0px"';} else {echo 'style="display:none;height: 30px;margin-bottom: 0px"';}?>></td>


				<td>
					<div align="left" style="margin-left: 20px" id="mskp"><strong>Maskapai/Kereta</strong></div></td>
					<td><input style="height: 30px;margin-bottom: 0px" id="nama_maskapai" class="nama_maskapai" name="nama_maskapai" type="text" value="<?php echo $line->nama_maskapai?>" onfocus="setMaskapai(this)"></td>
				</tr>
				<tr>
					<!-- jam keberangkatan -->
					 <td><div align="left" id="njam_in" name="njam_in" <?php if ($line->tipe='pesawat' || $line->tipe='kereta') {echo '';} else {echo 'style="margin-left: 20px;display:none"';}?>><strong>Jam Keberangkatan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jam_in" class="jam_in" name="jam_in" type="text" value="<?php echo date('H:i', strtotime($line->jam_in)); ?>"></td>
				<td><div align="left" id="njam_out" name="njam_out" <?php if ($line->kembali=='y') {echo '';} else {echo 'style="margin-left: 20px;display:none"';}?>><strong>Jam Pulang</strong></div></td>
			        <td><input  id="jam_out" class="jam_out" name="jam_out" type="text" value="<?php if ($line->kembali=='y') {echo date('H:i', strtotime($line->jam_out));} else { echo date('H:i', strtotime('now'));} ?>"  <?php if ($line->kembali=='y') {echo 'style="height: 30px;margin-bottom: 0px"';} else {echo 'style="display:none;height: 30px;margin-bottom: 0px"';}?>></td>
				</tr>
				<tr>
				<td><div align="left" id="asl"><strong>Asal</strong></div></td>
			    <td><input style="height: 30px;margin-bottom: 0px" id="asal" class="asal" name="asal" type="text" value="<?php echo $line->asal; ?>" onfocus="setAsal()"></td>
				<td><div align="left" style="margin-left: 20px" id="tjn"><strong>Tujuan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tujuan" class="tujuan" name="tujuan" type="text" value="<?php echo $line->tujuan; ?>" onfocus="setTujuan()"></td>
					<td><div id="class" name="class" align="left" style="margin-left: 20px"><strong>Kelas</strong></div></td>
					<td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right" onchange="setHargaKelas(this)" name="kelas" id="kelas" class="kelas" >
			        <option value="">Tidak ada</option>
			        <option value="1"<?php if ($line->kelas=='1') {echo "selected";}?>>Bisnis</option>
							<option value="2"<?php if ($line->kelas=='2') {echo "selected";}?>>Eksekutif</option>
			        <option value="3"<?php if ($line->kelas=='3') {echo "selected";}?>>Ekonomi</option>
							<option value="4"<?php if ($line->kelas=='4') {echo "selected";}?>>Lainnya</option>

						</select>
			        </td>


				</tr>


					<tr>

					<td><div align="left"><strong>Keterangan</strong></div></td>
					<td>
					<textarea id="txtArea" rows="5" name="keterangan"><?php echo $line->keterangan; ?></textarea>
					</td>
						<td>
				<div class="checkbox">
  <label id="semuareturn"><input style="margin-left: 5px" id="return" name="return" type="checkbox" onload="runSetHarga()" onclick="runSetHarga()" value="1" <?php if ($line->kembali=='y') {echo 'checked';} else {echo '';}?>>Pulang Pergi</label>
</div>
				<div class="checkbox">
  <label id="semuaextra"><input style="margin-left:5px" id="extra" name="extra" type="checkbox" onload="runSetHarga()" onclick="runSetHarga()"  value="1" <?php if ($line->extra=='Y') {echo 'checked';} else {echo '';}?> >Extra Bagasi</label>
</div>	</td>
				</tr>
<!--
				<tr>
					<td>
					<div name="mask" id="mask" align="left" style="display: none;height: 30px;margin-bottom: 0px">
					Maskapai
					<input type="text" id="maskapai" name="maskapai" value="<?php echo $line->maskapai; ?>" onfocus="setMaskapai(this)" />
				</div>
						</td>
						<td>
					<div name="tr" id="tr" align="left" style="display: none;height: 30px;margin-bottom: 0px">
					Kereta
					<input type="text" id="kereta" name="kereta" value="<?php echo $line->kereta; ?>" onfocus="setKereta(this)" />
				</div>
						</td>

					<td><div id="class" name="class" align="left" style="display: none"><strong>Kelas</strong></div></td>
					<td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right;display: none" onchange="setHargaMakanan(this)" name="kelas" id="kelas" class="kelas" >
			        <option value="">Tidak ada</option>
			        <option value="1"<?php if ($line->kelas=='1') {echo "selected";}?>>Bisnis</option>
						<option value="2"<?php if ($line->kelas=='2') {echo "selected";}?>>Eksekutif</option>
			        <option value="3"<?php if ($line->kelas=='3') {echo "selected";}?>>Ekonomi</option>
						</select>
			        </td>


					</tr>
-->
						<tr>
<td><div name="nhotel" id="nhotel" align="left" ><strong>Nama Hotel</strong></div></td>

<td><input type="text" id="nama_hotel" name="nama_hotel" value="<?php echo $line->nama_hotel ?>" onfocus="setHotel(this)" style="height: 30px;margin-bottom: 0px">

<td>
<div name="nmalam" id="nmalam" align="left" style="margin-left: 20px"><strong>Malam</strong></div></td>

<td><input type="text" id="malam" name="malam" value="<?php echo $line->malam?>" style="height: 30px;margin-bottom: 0px"/>

</td></tr>
<tr>
		<td>
<div name="jk" id="jk" align="left"><strong>Jumlah Kamar</strong></div></td>

<td><input type="text" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo $line->jumlah_kamar;?>" style="height: 30px;margin-bottom: 0px" onkeyup="runSetHarga()"/>
</td>

<td><div id="je" name="je" align="left" style="margin-left: 20px"><strong>Jenis Kamar</strong></div></td>
<td>
<select style="height: 30px;margin-bottom: 0px"  onchange="setHargaKamar(this)" name="jenis_kamar" id="jenis_kamar" class="jenis_kamar">
<option value="">Tidak ada</option>
<option value="1"<?php if ($line->jenis_kamar=='1') {echo "selected";}?>>Standard</option>
<option value="2"<?php if ($line->jenis_kamar=='2') {echo "selected";}?>>Deluxe</option>
<option value="3"<?php if ($line->jenis_kamar=='3') {echo "selected";}?>>Suite</option>
<option value="4"<?php if ($line->jenis_kamar=='4') {echo "selected";}?>>Lainnya</option>
</select>
</td>
				</tr>
				
			        <tr>
			        <td><div align="left"><strong>No. Pembelian</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="no_po" name="no_po" value="<?php echo $line2->no_po?>"></td>
					<td><div align="left" style="margin-left: 20px"><strong>Tanggal Pembelian</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tgl_po" class="tgl_po" name="tgl_po" type="text" value="<?php echo date("d-m-Y",strtotime($line2->tgl_po)); ?>"></td>
					<td><div align="left" style="margin-left: 20px"><strong>Tanggal Jatuh Tempo</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tgl_jatuh_tempo" class="tgl_jatuh_tempo" name="tgl_jatuh_tempo" type="text" value="<?php echo date('d-m-Y',strtotime($line2->tgl_jatuh_tempo)); ?>"></td>
					</tr>
					<tr>
						<td><div align="left"><strong>Supplier</strong></div></td>
						<td><input style="height: 30px;margin-bottom: 0px" id="nama_supplier" class="nama_supplier" name="nama_supplier" type="text" onfocus="setSupplier(this)" value="<?php echo $line2->nama_supplier?>"></td>
						<td><div id="nhargahotel" align="left" style="margin-left: 20px"><strong>Harga Hotel</strong></div></td>
							<td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargahotel" name="hargahotel" value="<?php echo $line2->hargahotel?>" onkeyup="setHarga()"></td>
					</tr>
			        <tr>
								<td><div align="left" id = 'nhargabeli'><strong>Harga Dewasa</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargabeli" name="hargabeli" value="<?php echo $line2->hargabeli?>" onkeyup="runSetHarga()"></td>

								<td><div id='nhargaanak' align="left" style="margin-left: 20px"><strong>Harga Anak</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargaanak" name="hargaanak" value="<?php echo $line2->hargaanak?>" onkeyup="runSetHarga()"></td>

								<td><div id="nhargabagasi" align="left" <?php if ($line->extra=='Y') {echo 'style="margin-left: 20px"';} else {echo 'style="display:none;margin-left: 20px"';}?>><strong>Harga Bagasi</strong></div></td>
								<td><input <?php if ($line->extra=='Y') {echo 'style="height: 30px;margin-bottom: 0px"';} else {echo 'style="display:none;height: 30px;margin-bottom: 0px"';}?> type="text" id="hargabagasi" name="hargabagasi" value="<?php echo $line2->hargabagasi; ?>" onkeyup="setHarga()"></td>

</tr>
  <tr>
			         <td><div align="left" id="nhargabelireturn"><strong>Return Dewasa</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargabelireturn" name="hargabelireturn" value="<?php echo $line2->hargabelireturn?>" onchange="setHarga()"></td>

					<td><div align="left" style="margin-left: 20px" id="nhargaanakreturn"><strong>Return Anak</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="hargaanakreturn" name="hargaanakreturn" value="<?php echo $line2->hargaanakreturn?>" oninput="setHarga()"></td>

					<td><div id="nhargabagasireturn" align="left" <?php if ($line->extra=='Y') {echo 'style="margin-left: 20px"';} else {echo 'style="display:none;margin-left: 20px"';}?>><strong>Return Bagasi</strong></div></td>
			        <td><input <?php if ($line->extra=='Y') {echo 'style="height: 30px;margin-bottom: 0px"';} else {echo 'style="display:none;height: 30px;margin-bottom: 0px"';}?> type="text" id="hargabagasireturn" name="hargabagasireturn" value="<?php echo $line2->hargabagasireturn?>" onkeyup="setHarga()"></td>
			        

			        </tr>

								
								<tr>
								<td><div align="left"><strong>Harga Beli Total</strong></div></td>
								<td><input readonly style="height: 30px;margin-bottom: 0px" type="text" id="hargabelitotal" name="hargabelitotal" value="<?php echo $line2->hargabelitotal?>"></td>
								<!-- <td><div align="left" style="margin-left: 20px"><strong>No. Invoice Pembelian</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" type="text" id="no_invoice" name="no_invoice" value="<?php echo $line2->no_invoice?>"></td> -->
								<td><div align="left" style="margin-left: 20px"><strong>Tanggal Invoice</strong></div></td>
								<td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_invoice" name="tgl_invoice" value="<?php echo date("d-m-Y",strtotime($line2->tgl_invoice))?>"></td>
								</tr>
			        </table>
			        <br/>
			        <table>
			        <tr>
			          <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringpesanan.php");'></td>
			          <td><input type="button" style="height:50px;width:100px" name="Reset" value="Reset" onclick='window.location.reload(true);'></td>
			          <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
			        </tr>
			      </table>
			    </form>
			  </td>
			</tr>
			</table>
		</p>
<?php endblock() ?>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
function setCustomer(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_customer').autocomplete("check_customer.php", {
	        selectFirst: true});
		}
		function setSupplier(value)
				{

				//var counter = value.id.match(/\d+/);
				$('#nama_supplier').autocomplete("check_supplier.php", {
			        selectFirst: true});
				}
function setHotel(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_hotel').autocomplete("autohotel.php", {
	        selectFirst: true});
		}
		function setMaskapai(value)
			{
			//var counter = value.id.match(/\d+/);
			var tipe = document.getElementById('tipe').value;
			if (tipe=='pesawat')
			{
			$('#nama_maskapai').autocomplete("autopesawat.php", {
		        selectFirst: true});
			}
			else if (tipe=='kereta')
			{
			$('#nama_maskapai').autocomplete("autokereta.php", {
			        selectFirst: true});
			}
			}
	function setAsal()
				{
				//var counter = value.id.match(/\d+/);
				var tipe = document.getElementById('tipe').value;
				if (tipe=='pesawat')
				{
				$('#asal').autocomplete("autopesawatasal.php", {
							selectFirst: true});
				}
				else if (tipe=='kereta')
				{
				$('#asal').autocomplete("autokeretaasal.php", {
								selectFirst: true});
				}
				}
	function setTujuan()
							{
							//var counter = value.id.match(/\d+/);
							var tipe = document.getElementById('tipe').value;
							if (tipe=='pesawat')
							{
							$('#tujuan').autocomplete("autopesawatasal.php", {
										selectFirst: true});
							}
							else if (tipe=='kereta')
							{
							$('#tujuan').autocomplete("autokeretaasal.php", {
											selectFirst: true});
							}
							}

</script>
<link rel="stylesheet" type="text/css" media="all" href="pikaday.css" />
<link rel="stylesheet" type="text/css" media="all" href="jquery.timepicker.min.css" />
<script type="application/javascript" src="moment.js"></script>
<script src="pikaday.js"></script>
<script src="jquery.timepicker.min.js"></script>
<script>
    var picker = new Pikaday({
        field: document.getElementById('tgl_penjualan'),
		format : "DD-MM-YYYY",
    });
	var picker = new Pikaday({
		field: document.getElementById('tgl_kirim'),
		format : "DD-MM-YYYY",
	});
	var picker = new Pikaday({
		field: document.getElementById('tgl_po'),
		format : "DD-MM-YYYY",
	});
	var picker = new Pikaday({
		field: document.getElementById('tgl_jatuh_tempo'),
		format : "DD-MM-YYYY",
	});
	var picker = new Pikaday({
		field: document.getElementById('tgl_invoice'),
		format : "DD-MM-YYYY",
	});
	var picker = new Pikaday({
		field: document.getElementById('tgl_in'),
		format : "DD-MM-YYYY",
		});
	var picker = new Pikaday({
		field: document.getElementById('tgl_out'),
		format : "DD-MM-YYYY",
		});
	$("#jam_in").timepicker({
    timeFormat: 'HH:mm',
    interval: 5, //will change increments to 15m, default is 1m
});

		$("#jam_out").timepicker({
    timeFormat: 'HH:mm',
    interval: 5, //will change increments to 15m, default is 1m
});
		
			$(function () {
				$("#extra").click(function () {
				if ($(this).is(":checked")) {
				$('#nhargabagasi').show();
			$('#hargabagasi').show();
			if($('#return').is(":checked")){
$('#nhargabagasireturn').show();
	$('#hargabagasireturn').show();
			}
			else{
	$('#nhargabagasireturn').hide();
	$('#hargabagasireturn').hide();
			}
								}
								else {
				 $('#nhargabagasi').hide();
			 $('#hargabagasi').hide();
			 $('#nhargabagasireturn').hide();
	$('#hargabagasireturn').hide();

		 }
						});

			$("#return").click(function () {
            if ($(this).is(":checked")) {
            	if ($('#extra').is(":checked")) {
            $('#nhargabagasi').show();
			$('#hargabagasi').show();
            		$('#nhargabagasireturn').show();
	$('#hargabagasireturn').show();
            	}
            	else{
            $('#nhargabagasi').hide();
			 $('#hargabagasi').hide();
            		$('#nhargabagasireturn').hide();
	$('#hargabagasireturn').hide();

            	}
		
    $('#tgl_out').show();
	$('#tglout').show();
	$("#hargaanakreturn").show();
			$("#nhargaanakreturn").show();
			$("#nhargabelireturn").show();
			$("#hargabelireturn").show();
			$('#njam_out').show();
	$('#jam_out').show();

            } else {
            	if ($('#extra').is(":checked")) {
            $('#nhargabagasi').show();
			$('#hargabagasi').show();
            	}
            	else{
            	
	 $('#nhargabagasi').hide();
			 $('#hargabagasi').hide();

            	}
    $('#tgl_out').hide();
	$('#tglout').hide();
	$('#njam_out').hide();
	$('#jam_out').hide();
		$("#hargaanakreturn").hide();
			$("#nhargaanakreturn").hide();
			$("#nhargabelireturn").hide();
			$("#hargabelireturn").hide();
			$('#nhargabagasireturn').hide();
	$('#hargabagasireturn').hide();

		
            }
        });

$("#tipe").change(function (){
		if($(this).val() == "hotel" ) {
			$("#hargahotel").show();
			$("#nhargahotel").show();
			$("#tgl_out").show();
			$("#tglout").show();
			$('#nama_hotel').show();
			$('#malam').show();
			$('#nhotel').show();
			$('#nmalam').show();
			$('#jk').show();
			$('#jumlah_kamar').show();
			$('#je').show();
			$('#jenis_kamar').show();
			$("#jumlah").hide();
			$("#dws").hide();
			$("#jumlahanak").hide();
			$("#ank").hide();
			$("#nama_maskapai").hide();
			$("#tglout").hide();
			$("#tgl_out").hide();
			$("#nama_maskapai").hide();
			$("#mskp").hide();
			$("#asal").hide();
			$("#asl").hide();
			$("#tujuan").hide();
			$("#tjn").hide();
			$("#kelas").hide();
			$("#class").hide();
			$("#semuareturn").hide();
			$("#semuaextra").hide();
			$("#nhargabeli").hide();
			$("#hargabeli").hide();
			$("#hargaanak").hide();
			$("#nhargaanak").hide();
			$("#nhargabagasi").hide();
			$("#hargabagasi").hide();
			$("#hargaanakreturn").hide();
			$("#nhargaanakreturn").hide();
			$("#nhargabelireturn").hide();
			$("#hargabelireturn").hide();
			$('#nhargabagasireturn').hide();
	$('#hargabagasireturn').hide();


		}
		else if($(this).val() == "pesawat" || $(this).val() == "kereta" ){
   			if($('#extra').is(":checked")){
   			$('#nhargabagasi').show();
			$('#hargabagasi').show();
   			}
   			if($('#return').is(":checked")){
   			$("#tglout").show();
			$("#tgl_out").show();
			$("#hargaanakreturn").show();
			$("#nhargaanakreturn").show();
			$("#nhargabelireturn").show();
			$("#hargabelireturn").show();
		}
		if($('#extra').is(":checked") && $('#return').is(":checked")){
			$('#nhargabagasi').show();
			$('#hargabagasi').show();
			$('#nhargabagasireturn').show();
			$('#hargabagasireturn').show();
			$("#tglout").show();
			$("#tgl_out").show();
			$("#hargaanakreturn").show();
			$("#nhargaanakreturn").show();
			$("#nhargabelireturn").show();
			$("#hargabelireturn").show();
		}
			$("#nhargabeli").show();
			$("#hargabeli").show();
			$("#hargaanak").show();
			$("#nhargaanak").show();
			$("#jumlah").show();
			$("#dws").show();
			$("#jumlahanak").show();
			$("#ank").show();
			$("#nama_maskapai").show();
			$("#mskp").show();
			$("#asal").show();
			$("#asl").show();
			$("#tujuan").show();
			$("#tjn").show();
			$("#kelas").show();
			$("#class").show();
			$("#semuareturn").show();
			$("#semuaextra").show();
			$('#nama_hotel').hide();
			 $('#malam').hide();
			 $('#nhotel').hide();
			 $('#nmalam').hide();
			 $('#jk').hide();
			 $('#jumlah_kamar').hide();
		     $('#je').hide();
			 $('#jenis_kamar').hide();
			 $("#hargahotel").hide();
			$("#nhargahotel").hide();

		}
		
	});


				});
</script>
