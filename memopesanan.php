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
			$tgl_penjualan=mysql_real_escape_string($_POST['tgl_penjualan']);
			$tgl_penjualan=strtotime($tgl_penjualan);
			$tgl_penjualan=date('Y-m-d H:i:s', $tgl_penjualan);
			$tipe=mysql_real_escape_string($_POST['tipe']);
			$nama_maskapai=mysql_real_escape_string($_POST['nama_maskapai']);
			$jumlah=mysql_real_escape_string($_POST['jumlah']);
			$anak=mysql_real_escape_string($_POST['jumlahanak']);
			$asal=mysql_real_escape_string($_POST['asal']);
			$tujuan=mysql_real_escape_string($_POST['tujuan']);
			$hotel=(isset($_POST['hotel']) ? 'y' : 'n');
			$extra=(isset($_POST['extra']) ? 'y' : 'n');
			$return=(isset($_POST['return']) ? 'y' : 'n');
			$kelas = mysql_real_escape_string($_POST['kelas']);
			$nama_hotel=mysql_real_escape_string($_POST['nama_hotel']);
			$malam=mysql_real_escape_string($_POST['malam']);
			$jumlah_kamar=mysql_real_escape_string($_POST['jumlah_kamar']);
			$jenis_kamar=mysql_real_escape_string($_POST['jenis_kamar']);
			$tgl_in=mysql_real_escape_string($_POST['tgl_in']);
		 	$tgl_in=strtotime($tgl_in);
			$tgl_in=date('Y-m-d H:i:s', $tgl_in);
			$jam_in=mysql_real_escape_string($_POST['jam_in']);
	   		$jam_in=strtotime($jam_in);
			$jam_in=date('H:i', $jam_in);


			if($tipe=='hotel'){
		$jumlah = '';
		$anak = '';
		$asal = '';
		$tujuan = '';
		$nama_maskapai='';
		$kelas = '';
		$tgl_out = '';
		$return = '';
		$extra = '';
	}
	else if($tipe == 'pesawat' || $tipe == 'kereta'){
		$nama_hotel = '';
		$malam = '';
		$jumlah_kamar= '';
		$jenis_kamar = '';
		if ($return == 'n'){
			$tgl_out = '';
			$jam_out = '';
		}
			else{
				mysql_real_escape_string($_POST['tgl_out']);
			}
		}
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
		$no_penjualan_asli = mysql_real_escape_string($_POST['no_penjualan_asli']);
		$db->query("delete from penjualan where no_penjualan='$no_penjualan_asli'");
			$db->execute("INSERT INTO penjualan(no_penjualan,tgl_penjualan,id_customer,nama_customer,tgl_in,tgl_out,jam_in,jam_out,tipe,jumlah,jumlahanak,asal,tujuan,hotel,nama_hotel,malam,jumlah_kamar,jenis_kamar,nama_maskapai,extra,kembali,kelas,keterangan,username,tgl_transaksi) values ('$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer','$tgl_in','$tgl_out','$jam_in','$jam_out','$tipe','$jumlah','$anak','$asal','$tujuan','$hotel','$nama_hotel','$malam','$jumlah_kamar','$jenis_kamar','$nama_maskapai','$extra','$return','$kelas','$keterangan','$username',NOW())");
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pesanan dengan No. Pesanan [ $no_penjualan ] Berhasil Ditambahkan</font></div> ";
			echo "<script>window.location.assign('masteringpesanan.php');</script>";
			//}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penjualan" method="post" action="">
	<p align="center"><font size="3"><strong>Memo Pesanan</strong></font></p>
	<?php
	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$line = $db->queryUniqueObject("SELECT * FROM penjualan WHERE no_penjualan='$id'");
	}

if ($line->tipe == 'hotel'){
	?>
<style type="text/css">
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
{ ?>
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
<?php 
if($line->kembali != 'y'){ ?>
#tglout{display:none;}
#tgl_out{display:none;}
#njam_out{display:none;}
#jam_out{display:none;}
#nhargabelireturn{display:none;}
#hargabelireturn{display:none;}
#nhargaanakreturn{display:none;}
#hargaanakreturn{display:none;}
#nhargabagasireturn{display:none;}
#hargabagasireturn{display:none;}
<?php } ?>
#nama_hotel{display:none;}
#malam{display:none;}
#nhotel{display:none;}
#nmalam{display:none;}
#jk{display:none;}
#jumlah_kamar{display:none;}
#je{display:none;}
#jenis_kamar{display:none;}
</style>
<?php
}

	?>

		<p align="center">
			<table>
			        <tr>
			        <td><div align="left"><strong>Nama Customer</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_customer" class="nama_customer"  name="nama_customer" value="<?php echo $line->nama_customer; ?>" onfocus="setCustomer(this)" required></td>
			        <td><div align="left" style="margin-left: 20px"><strong>No. Penjualan</strong></div></td>
			        <td><input readonly style="height: 30px;margin-bottom: 0px" name="no_penjualan" type="text" id="no_penjualan" value="<?php echo $line->no_penjualan; ?>"></td>
			        <input name="no_penjualan_asli" type="hidden" id="no_penjualan_asli" value="<?php echo $line->no_penjualan; ?>">
					<td><div align="left" style="margin-left: 20px"><strong>Tanggal Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('d-m-Y', strtotime($line->tgl_penjualan)); ?>"></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Jenis Pesanan</strong></div></td>
			        <td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right" name="tipe" id="tipe" class="tipe" required>
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
  <label id="semuareturn"><input style="margin-left: 5px" id="return" name="return" type="checkbox" value="1" <?php if ($line->kembali=='y') {echo 'checked';} else {echo '';}?>>Pulang Pergi</label>
</div>
				<div class="checkbox">
  <label id="semuaextra"><input style="margin-left:5px" id="extra" name="extra" type="checkbox"  value="1" <?php if ($line->extra=='Y') {echo 'checked';} else {echo '';}?> >Extra Bagasi</label>
</div>
</td>
</tr><tr>
<td><div name="nhotel" id="nhotel" align="left" ><strong>Nama Hotel</strong></div></td>

<td><input type="text" id="nama_hotel" name="nama_hotel" value="<?php echo $line->nama_hotel ?>" onfocus="setHotel(this)" style="height: 30px;margin-bottom: 0px">

<td>
<div name="nmalam" id="nmalam" align="left" style="margin-left: 20px"><strong>Malam</strong></div></td>

<td><input type="text" id="malam" name="malam" value="<?php echo $line->malam?>" style="height: 30px;margin-bottom: 0px"/>

</td></tr>
<tr>
		<td>
<div name="jk" id="jk" align="left"><strong>Jumlah Kamar</strong></div></td>

<td><input type="text" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo $line->jumlah_kamar?>" style="height: 30px;margin-bottom: 0px"/>
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
	function setHotel(value)
		{
		//var counter = value.id.match(/\d+/);
		$('#nama_hotel').autocomplete("autohotel.php", {
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
$("#return").click(function () {
            if ($(this).is(":checked")) {
    $('#tgl_out').show();
	$('#tglout').show();
	 $('#njam_out').show();
	$('#jam_out').show();
            } else {
    $('#tgl_out').hide();
	$('#tglout').hide();
	 $('#njam_out').hide();
	$('#jam_out').hide();
            }
        });

$("#tipe").change(function (){
		if($(this).val() == "hotel" ) {
			$('#nama_hotel').show();
			$('#malam').show();
			$('#nhotel').show();
			$('#nmalam').show();
			$('#jk').show();
			$('#jumlah_kamar').show();
			$('#je').show();
			$('#jenis_kamar').show();
			$("#tgl_out").hide();
			$("#tglout").hide();
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
		}
		else if($(this).val() == "pesawat" || $(this).val() == "kereta" ){
			     if ($('#return').is(":checked")) {
    $('#tgl_out').show();
	$('#tglout').show();
            } else {
    $('#tgl_out').hide();
	$('#tglout').hide();
            }
			$("#dws").show();
			$("#jumlah").show();
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
		}
		
	});

    });

</script>