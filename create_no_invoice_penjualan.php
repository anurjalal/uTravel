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

<?php
        
        $no_penjualan = $_GET['no_penjualan'];
		$query = mysql_query("select * from penjualan where no_penjualan = '$no_penjualan'");
		$data = mysql_fetch_array($query);
		$no_invoice = mysql_real_escape_string($_POST['no_invoice']);
		if(isset($_POST['no_invoice'])){
		$action = $db->execute("UPDATE penjualan SET no_invoice = '$no_invoice',tgl_invoice=NOW() where no_penjualan = '$no_penjualan'");
		echo "<div style='background-color:yellow;'><br><font color=green size=+1 >No Invoice Berhasil Ditambahkan</font></div> ";
		echo "<script>window.location.assign('masteringterimapiutangpernopenjualan.php');</script>";
		}

?>
<html>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="isi_invoice" method="post" action="">
		<p align="center">
			<br>
				<table>	
							<tr>
							<td><strong>No. Penjualan</strong></td></div>
							<div align="right"><td><input style="height: 30px;margin-bottom: 0px" id="no_penjualan"  name="no_penjualan" type="text" value="<?php echo $data[no_penjualan]; ?>" readonly> </td></div>
							</tr>
                            <tr>
                            <div align="left"><td><strong>Tgl Penjualan</strong></td></div>
							<div align="right"><td><input   readonly style="height: 30px;margin-bottom: 0px" id="tgl_penjualan"  name="tgl_penjualan" type="text" value="<?php echo date('d-m-Y',strtotime($data['tgl_penjualan'])) ?>" > </td></div>
                            </tr>
                            <tr>
                            <div align="left"><td><strong>Nama Customer</strong></td></div>
							<div align="right"><td><input   readonly style="height: 30px;margin-bottom: 0px" id="nama_customer"  name="nama_customer" type="text" value="<?php echo $data['nama_customer'] ?>" > </td></div>
                            </tr>
                            <tr>
                            <div align="left"><td><strong>Jumlah Piutang</strong></td></div>
							<div align="right"><td><input   readonly style="height: 30px;margin-bottom: 0px" id="jumlah_piutang"  name="jumlah_piutang" type="text" value="<?php echo $data['hrgjualdgnpajak']?>" > </td></div>
                            </tr>  
						</table>
						<br>
						<table>
							 <tr>
                             <div align="left"><td><strong>Isi Nomor Invoice</strong></td></div>
							 <div align="right"><td><input style="height: 30px;margin-bottom: 0px" id="no_invoice"  name="no_invoice" type="text" > </td></div>
                             </tr>
						</table>
                        <br>
						<table>
					  <tr>
					  <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringterimapiutangpernopenjualan.php");'></td>
					  <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
					  </tr>
					</table>
			
</form>
</html>



<?php endblock() ?>