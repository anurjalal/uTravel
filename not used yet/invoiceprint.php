<html>

<title> UD. ANUGRAH - Print Invoice </title>
<body>
   <b>Pilih nomor INVOICE yang ingin dicetak:</b>
   <br><br>
   <form action="invoicedisplay.php" method="POST">
	<table border=0 cellpadding=10>
	<tr>
	<td><b><i>INVOICE yang ingin dicetak:</i></b></td>
      <td><select name="myinvoice" size="1">
	<option selected value="-">Invoice Number</option>
	<?php
		include ('connectdb.php');

		$myquery="SELECT * FROM trjual WHERE status <> \"P\" ";
		$myresult= mysql_query($myquery);

		while ($row=mysql_fetch_array($myresult))
		{
			echo "<option value=\"$row[NO_FAKTUR]\">$row[NO_FAKTUR]</option>";
		}
	?>
      </td>
	<td><input type="submit" value="Preview"></td>
	</tr>
   </form>

</body>
</html>
