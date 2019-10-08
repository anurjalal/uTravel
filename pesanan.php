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
			$jumlah=mysql_real_escape_string($_POST['jumlah']);
			$anak=mysql_real_escape_string($_POST['jumlahanak']);
			$asal=mysql_real_escape_string($_POST['asal']);
			$tujuan=mysql_real_escape_string($_POST['tujuan']);
			$nama_hotel=mysql_real_escape_string($_POST['nama_hotel']);
			$malam=mysql_real_escape_string($_POST['malam']);
			$jumlah_kamar=mysql_real_escape_string($_POST['jumlah_kamar']);
			$jenis_kamar=mysql_real_escape_string($_POST['jenis_kamar']);
			$nama_maskapai=mysql_real_escape_string($_POST['nama_maskapai']);
			$hotel=(isset($_POST['hotel']) ? 'y' : 'n');
			$kelas=mysql_real_escape_string($_POST['kelas']);
			$extra=(isset($_POST['extra']) ? 'y' : 'n');
			$return=(isset($_POST['return']) ? 'y' : 'n');
			$kereta=mysql_real_escape_string($_POST['kereta']);
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
	}
	else if($tipe == 'pesawat' || $tipe == 'kereta'){
		$nama_hotel = '';
		$malam = '';
		$jumlah_kamar= '';
		$jenis_kamar = '';
		if ($return == 'n'){
			$tgl_out = '';}
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
			$db->execute("INSERT INTO penjualan(no_penjualan,tgl_penjualan,id_customer,nama_customer,tgl_in,tgl_out,jam_in,jam_out,tipe,jumlah,jumlahanak,asal,tujuan,hotel,nama_hotel,malam,jumlah_kamar,jenis_kamar,nama_maskapai,extra,kembali,kelas,keterangan,username,tgl_transaksi) values ('$no_penjualan','$tgl_penjualan','$id_customer','$nama_customer','$tgl_in','$tgl_out','$jam_in','$jam_out','$tipe','$jumlah','$anak','$asal','$tujuan','$hotel','$nama_hotel','$malam','$jumlah_kamar','$jenis_kamar','$nama_maskapai','$extra','$return','$kelas','$keterangan','$username',NOW())");
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >Pesanan dengan No. Pesanan [ $no_penjualan ] Berhasil Ditambahkan</font></div> ";
			echo "<script>window.location.assign('masteringpesanan.php');</script>";
			//}
		}
?>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="penjualan" method="post" action="">
	<p align="center"><font size="3"><strong>Pencatatan Pesanan</strong></font></p>
		<p align="center">
			<table>
			        <tr>
			        <td><div align="left"><strong>Nama Customer</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="nama_customer" class="nama_customer"  name="nama_customer" value="" onfocus="setCustomer(this)" required></td>
			        <td><div align="left" style="margin-left: 20px"><strong>No. Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" name="no_penjualan" type="text" id="no_penjualan" value="<?php $maxterima = $db->queryUniqueValue("select MAX(CAST(no_penjualan AS SIGNED)) as no_penjualan from penjualan"); if ($maxterima == NULL) {$maxterima = 1; echo $maxterima;} else {$maxterimabaru = $maxterima + 1; echo $maxterimabaru;} ?>"></td>
			        <td><div align="left" style="margin-left: 20px"><strong>Tanggal Penjualan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" type="text" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('d-m-Y');?>"></td>
			        </tr>
			        <tr>
			        <td><div align="left"><strong>Jenis Pesanan</strong></div></td>
			        <td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right" name="tipe" id="tipe" class="tipe" required>
			        <option value="">Tidak ada</option>
			        <option value="pesawat">Pesawat</option>
			        <option value="kereta">Kereta</option>
			        <option value="hotel">Hotel</option>
						</select>
			        </td>
					<td><div align="left" style="margin-left: 20px" id="dws"><strong>Dewasa</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jumlah" class="jumlah" name="jumlah" type="text" value="" onkeyup="setHarga()"></td>

					<td><div align="left" style="margin-left: 20px" id="ank"><strong>Anak</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jumlahanak" class="jumlahanak" name="jumlahanak" type="text" value="" onkeyup="setHarga()"></td>
			        </tr>
				<tr>
					 <td><div align="left"><strong>Tanggal In</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tgl_in" class="tgl_in" name="tgl_in" type="text" value=""></td>

				<td><div align="left" style="margin-left: 20px ; display: none" id="tglout" name="tglout"><strong>Tanggal Out</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px; display: none" id="tgl_out" class="tgl_out" name="tgl_out" type="text" value=""></td>
				<td>
					<div align="left" style="margin-left: 20px" id="mskp"><strong>Maskapai/Kereta</strong></div></td>
					<td><input style="height: 30px;margin-bottom: 0px" id="nama_maskapai" class="nama_maskapai" name="nama_maskapai" type="text" value="" onfocus="setMaskapai(this)"></td>

				</tr>
				<tr>
					<!-- jam keberangkatan -->
					 <td><div align="left" id="njam_in" name="njam_in" ><strong>Jam Keberangkatan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="jam_in" class="jam_in" name="jam_in" type="text" value=""></td>
				<td><div align="left" id="njam_out" name="njam_out" style="display:none"><strong>Jam Pulang</strong></div></td>
			        <td><input  id="jam_out" class="jam_out" name="jam_out" type="text" style="display:none;height: 30px;margin-bottom: 0px" value=""></td>
				</tr>
				<tr>
				<td><div align="left" id="asl"><strong>Asal</strong></div></td>
			    <td><input style="height: 30px;margin-bottom: 0px" id="asal" class="asal" name="asal" type="text" value="" onfocus="setAsal()"></td>

				<td><div align="left" style="margin-left: 20px" id="tjn"><strong>Tujuan</strong></div></td>
			        <td><input style="height: 30px;margin-bottom: 0px" id="tujuan" class="tujuan" name="tujuan" type="text" value="" onfocus="setTujuan()"></td>


					<td><div id="class" name="class" align="left" style="margin-left: 20px"><strong>Kelas</strong></div></td>
					<td>
			        <select style="height: 30px;margin-bottom: 0px;text-align:right;" onchange="setHargaKelas(this)" name="kelas" id="kelas" class="kelas">
			        <option value="">Tidak ada</option>
			        <option value="1">Bisnis</option>
							<option value="2">Eksekutif</option>
			        <option value="3">Ekonomi</option>
							<option value="4">Lainnya</option>
							</select>
			    </td>
				  </tr>
					<tr>
					<td><div align="left"><strong>Keterangan</strong></div></td>
					<td>
					<textarea id="txtArea" rows="5" name="keterangan"></textarea>
					</td>
					<td>
				<div class="checkbox">
  <label id="semuareturn"><input style="margin-left: 5px" id="return" name="return" type="checkbox" value="1">Pulang Pergi</label>
</div>
				<div class="checkbox">
  <label id="semuaextra"><input style="margin-left: 5px" id="extra" name="extra" type="checkbox" value="1">Extra Bagasi</label>
</div>
	</td>

<!--
						<td>
					<div name="tr" id="tr" align="left" style="display: none;height: 30px;margin-bottom: 0px">
					Kereta
					<input type="text" id="kereta" name="kereta" value="" onfocus="setKereta(this)" />
				</div>
						</td>
-->


					</tr>

					<tr>

				<td>
		<div name="nhotel" id="nhotel" align="left" style="display:none"><strong>Nama Hotel</strong></div></td>

		<td><input type="text" id="nama_hotel" name="nama_hotel" value="" onfocus="setHotel(this)" style="display:none;height: 30px;margin-bottom: 0px"/>

						</td>
						<td>
		<div name="nmalam" id="nmalam" align="left" style="margin-left: 20px;display:none"><strong>Malam</strong></div></td>

		<td><input type="text" id="malam" name="malam" value="" style="display:none;height: 30px;margin-bottom: 0px"/>

						</td>
						<td>
		<div name="jk" id="jk" align="left" style="margin-left: 20px;display:none"><strong>Jumlah Kamar</strong></div></td>

		<td><input type="text" id="jumlah_kamar" name="jumlah_kamar" value="" style="display:none;height: 30px;margin-bottom: 0px"/>

						</td></tr>
				<tr>

					<td><div id="je" name="je" align="left" style="display:none"><strong>Jenis Kamar</strong></div></td>
					<td>
			        <select style="display:none;height: 30px;margin-bottom: 0px;text-align:right;" onchange="setHargaKamar(this)" name="jenis_kamar" id="jenis_kamar" class="jenis_kamar" >
			        <option value="">Tidak ada</option>
			        <option value="1">Standard</option>
							<option value="2">Deluxe</option>
			        <option value="3">Suite</option>
							<option value="4">Lainnya</option>
						</select>
			        </td>

<!--
						<td>
						<div id="nmalam" style="display: none">
					Malam
					<input type="text" id="malam" name="malam" />
				</div>
						</td>
-->

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
//	function setKereta(value)
//		{
//		//var counter = value.id.match(/\d+/);
//		$('#kereta').autocomplete("autokereta.php", {
//	        selectFirst: true});
//		}

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
