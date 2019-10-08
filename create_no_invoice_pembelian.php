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
        
        $no_po = $_GET['no_po'];
		$query = mysql_query("select * from pembelian where no_po = '$no_po'");
		$data = mysql_fetch_array($query);
		$no_invoice = mysql_real_escape_string($_POST['no_invoice']);
		if(isset($_POST['no_invoice'])){
		$action = $db->execute("UPDATE pembelian SET no_invoice = '$no_invoice',tgl_invoice=NOW() where no_po = '$no_po'");
		echo "<div style='background-color:yellow;'><br><font color=green size=+1 >No Invoice Berhasil Ditambahkan</font></div> ";
		echo "<script>window.location.assign('masteringbayarhutangpernopo.php');</script>";
		}

?>
<html>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<form name="isi_invoice" method="post" action="">
		<p align="center" >
			<br>
				<table >
		          
						
							<tr>
							<td><strong>No. PO</strong></td></div>
							<div align="right"><td><input style="height: 30px;margin-bottom: 0px" id="no_po"  name="no_po" type="text" value="<?php echo $data[no_po]; ?>" readonly> </td></div>
							</tr>
                                <tr>
                                <div align="left"><td><strong>Tgl PO</strong></td></div>
							    <div align="right"><td><input   readonly style="height: 30px;margin-bottom: 0px" id="tgl_po"  name="tgl_po" type="text" value="<?php echo date('d-m-Y',strtotime($data['tgl_po'])) ?>" > </td></div>
                                </tr>
                                <tr>
                                <div align="left"><td><strong>Nama Supplier</strong></td></div>
							    <div align="right"><td><input   readonly style="height: 30px;margin-bottom: 0px" id="nama_supplier"  name="nama_supplier" type="text" value="<?php echo $data['nama_supplier'] ?>" > </td></div>
                                </tr>
                                <tr>
                                <div align="left"><td><strong>Jumlah Hutang</strong></td></div>
							    <div align="right"><td><input readonly style="height: 30px;margin-bottom: 0px" id="jumlah_hutang"  name="jumlah_hutang" type="text" value="<?php echo $data['hargabelitotal'] ?>" > </td></div>
                                </tr>    
						</table>
						<br>
						<table>
							 <tr>
                                <div align="left"><td><strong>Isi Nomor Invoice</strong></td></div>
								<div align="right"><td><input style="height: 30px;margin-bottom: 0px" id="no_invoice"  name="no_invoice" type="text"> </td></div>
                             </tr>
						</table>
                        <br>
						<table>
					  <tr>
					  <td><input type="button" style="height:50px;width:100px" name="Back" value="Back" onclick='window.location.assign("masteringbayarhutangpernopo.php");'></td>
					  <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" ></td>
					  </tr>
					</table>
			
</form>
</html>



<?php endblock() ?>