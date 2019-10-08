<html>

<title> UD. ANUGRAH - Print DO  </title>
<body>
   <b>Pilih Nomor DO yang ingin dicetak:</b>
   <br><br>

   <form action="dodisplay.php" method="POST">
      <table border=0 cellpadding=10>
      <tr>
      <td><b><i>DO yang BELUM pernah dicetak: </i></b></td>
      <td><select name="mydo" size="1">
	<option selected value="-">DO Number</option>
	<?php
		include ('connectdb.php');

		$myquery="SELECT * FROM do WHERE status <> \"P\" ";
		$myresult= mysql_query($myquery);

		while ($row=mysql_fetch_array($myresult))
		{
			echo "<option value=\"$row[NO_DO]\">$row[NO_DO]</option>";
		}
	?>
      </td>
      <td><input type="submit" value="Preview"></td>
      </tr>
	</table>
   </form>
 
   <form action="dodisplay.php" method="POST">
      <table border=0 cellpadding=10>
      <tr>
	<td><b><i>DO yang SUDAH pernah dicetak: </i></b></td>
	<td><select name="mydo" size="1">
	<option selected value="-">DO Number</option>
	<?php
		include ('connectdb.php');

		$myquery="SELECT * FROM do WHERE status = \"P\" ";
		$myresult= mysql_query($myquery);

		while ($row=mysql_fetch_array($myresult))
		{
			echo "<option value=\"$row[NO_DO]\">$row[NO_DO]</option>";
		}
	?>
	</td>
	<td><input type="submit" value="Preview"></td>
	</tr>
	</table>
	<br><br><br><br>

   </form>

</body>
</html>

